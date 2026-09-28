<?php
/**
 * Staff page
 *
 * @var Cache $cache
 * @var FakeSmarty $smarty
 * @var Language $language
 * @var Navigation $cc_nav
 * @var Navigation $navigation
 * @var Navigation $staffcp_nav
 * @var Pages $pages
 * @var TemplateBase $template
 * @var User $user
 * @var Widgets $widgets
 */

const PAGE = 'staff';
$page_title = 'Staff';
require_once ROOT_PATH . '/core/templates/frontend_init.php';

$template->getEngine()->addVariable('PAGE_DESCRIPTION', 'Meet the FriesNet staff team and find the people keeping the community running.');

$staff_rows = DB::getInstance()->query('
    SELECT u.id, u.username, MIN(main_group.`order`) AS rank_order
    FROM nl2_users u
    INNER JOIN nl2_users_groups staff_ug ON u.id = staff_ug.user_id
    INNER JOIN nl2_groups staff_group ON staff_ug.group_id = staff_group.id
    INNER JOIN nl2_users_groups main_ug ON u.id = main_ug.user_id
    INNER JOIN nl2_groups main_group ON main_ug.group_id = main_group.id
    WHERE staff_group.staff = 1
      AND staff_group.deleted = 0
      AND main_group.deleted = 0
      AND u.isbanned = 0
    GROUP BY u.id, u.username
    ORDER BY rank_order ASC, u.username ASC
')->results();

$rank_sections = [];
foreach ($staff_rows as $row) {
    $staff_user = new User((int) $row->id);
    if (!$staff_user->exists()) {
        continue;
    }

    $main_group = $staff_user->getMainGroup();
    $rank_key = (string) $main_group->id;

    if (!isset($rank_sections[$rank_key])) {
        $rank_name = Output::getClean($main_group->name);
        $rank_html = trim((string) $main_group->group_html);

        $rank_sections[$rank_key] = [
            'name' => $rank_name,
            'html' => $rank_html !== '' ? $rank_html : '<span class="ui label">' . $rank_name . '</span>',
            'order' => $main_group->order,
            'members' => [],
        ];
    }

    $rank_sections[$rank_key]['members'][] = [
        'avatar' => $staff_user->getAvatar(180),
        'displayname' => Output::getClean($staff_user->getDisplayname(true)),
        'username_style' => $staff_user->getGroupStyle(),
        'profile' => $staff_user->getProfileURL(),
    ];
}

uasort($rank_sections, static function (array $a, array $b): int {
    return $a['order'] <=> $b['order'];
});

$template->getEngine()->addVariables([
    'STAFF_TITLE' => 'Staff',
    'STAFF_SUBTITLE' => 'Meet the FriesNet team.',
    'STAFF_SECTIONS' => array_values($rank_sections),
    'NO_STAFF' => 'No staff members found.',
]);

Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $staffcp_nav], $widgets, $template);

$template->onPageLoad();

require ROOT_PATH . '/core/templates/navbar.php';
require ROOT_PATH . '/core/templates/footer.php';

$template->displayTemplate('staff');
