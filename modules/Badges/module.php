<?php
/**
 * FriesNet Badges Module
 *
 * @author FriesNet
 * @version 1.0.0
 * @license MIT
 */

class Badges_Module extends Module
{
    private Language $_language;
    private Language $_badges_language;

    public function __construct(Language $language, Language $badges_language, Pages $pages)
    {
        $this->_language = $language;
        $this->_badges_language = $badges_language;

        parent::__construct(
            $this,
            'Badges',
            '<a href="https://x.com/john_fries_" target="_blank" rel="nofollow noopener">FriesNet</a>',
            '1.0.0',
            '2.2.5'
        );

        $pages->add('Badges', '/panel/badges', 'pages/panel/badges.php');
        $pages->add('Badges', '/panel/badges/user', 'pages/panel/user.php');
        $pages->add('Badges', '/panel/badges/bulk', 'pages/panel/bulk.php');
    }

    public function onInstall()
    {
        BadgesManager::ensureTables();
    }

    public function onUninstall()
    {
        DB::getInstance()->query('DROP TABLE IF EXISTS nl2_users_badges');
        DB::getInstance()->query('DROP TABLE IF EXISTS nl2_badges');
    }

    public function onEnable()
    {
        BadgesManager::ensureTables();
    }

    public function onDisable()
    {
        // No action required.
    }

    public function onPageLoad(User $user, Pages $pages, Cache $cache, $smarty, iterable $navs, Widgets $widgets, TemplateBase $template)
    {
        BadgesManager::ensureTables();

        PermissionHandler::registerPermissions($this->_language->get('moderator', 'staff_cp'), [
            'admincp.badges' => $this->_badges_language->get('badges', 'manage_badges'),
            'admincp.badges.assign' => $this->_badges_language->get('badges', 'assign_badges'),
        ]);

        if (defined('FRONT_END') && defined('PAGE')) {
            if (PAGE === 'profile') {
                $this->assignProfileBadges($user, $template);
            }

            if (PAGE === 'user_query') {
                $this->assignUserPopoverBadges($template);
            }
        }

        if (defined('BACK_END')) {
            $this->addPanelNavigation($user, $cache, $navs);
            $this->assignPanelUserBadges($template);

            if ($user->hasPermission('admincp.badges.assign')) {
                Core_Module::addUserAction($this->_badges_language->get('badges', 'badges'), URL::build('/panel/badges/user', 'id={id}'));
            }
        }
    }

    public function getDebugInfo(): array
    {
        return [
            'badges' => [
                'count' => count(BadgesManager::getAll()),
            ],
        ];
    }

    private function addPanelNavigation(User $user, Cache $cache, iterable $navs): void
    {
        if (!$user->hasPermission('admincp.badges') && !$user->hasPermission('admincp.badges.assign')) {
            return;
        }

        $cache->setCache('panel_sidebar');

        if (!$cache->isCached('badges_order')) {
            $order = 11.7;
            $cache->store('badges_order', $order);
        } else {
            $order = $cache->retrieve('badges_order');
        }

        if (!$cache->isCached('badges_icon')) {
            $icon = '<i class="nav-icon fas fa-certificate"></i>';
            $cache->store('badges_icon', $icon);
        } else {
            $icon = $cache->retrieve('badges_icon');
        }

        $navs[2]->addDropdown('badges', $this->_badges_language->get('badges', 'badges'), 'top', $order, $icon);

        if ($user->hasPermission('admincp.badges')) {
            $navs[2]->addItemToDropdown(
                'badges',
                'badges_manage',
                $this->_badges_language->get('badges', 'manage_badges'),
                URL::build('/panel/badges'),
                'top',
                null,
                '<i class="nav-icon fas fa-award"></i>',
                $order + 0.1
            );
        }

        if ($user->hasPermission('admincp.badges.assign')) {
            $navs[2]->addItemToDropdown(
                'badges',
                'badges_bulk',
                $this->_badges_language->get('badges', 'bulk_assign'),
                URL::build('/panel/badges/bulk'),
                'top',
                null,
                '<i class="nav-icon fas fa-users"></i>',
                $order + 0.2
            );
        }
    }

    private function assignProfileBadges(User $viewer, TemplateBase $template): void
    {
        $route = explode('/', rtrim($_GET['route'] ?? '', '/'));
        $username = $route[count($route) - 1] ?? '';

        if ($username === '' || $username === 'profile' || isset($_GET['error'])) {
            return;
        }

        $profile_user = new User($username, 'username');
        if (!$profile_user->exists()) {
            return;
        }

        $template->getEngine()->addVariable('PROFILE_BADGES', BadgesManager::getUserBadges((int) $profile_user->data()->id));

        if ($viewer->isLoggedIn() && $viewer->hasPermission('admincp.badges.assign')) {
            $template->getEngine()->addVariable(
                'BADGE_EDIT_LINK',
                URL::build('/panel/badges/user', 'id=' . urlencode($profile_user->data()->id))
            );
        }
    }

    private function assignPanelUserBadges(TemplateBase $template): void
    {
        if (!defined('PAGE') || PAGE !== 'panel' || !defined('PANEL_PAGE') || PANEL_PAGE !== 'users') {
            return;
        }

        $route_parts = explode('/', rtrim($_GET['route'] ?? '', '/'));
        $last = $route_parts[count($route_parts) - 1] ?? '';
        $id_parts = explode('-', $last);

        if (!isset($id_parts[0]) || !is_numeric($id_parts[0])) {
            return;
        }

        $template->getEngine()->addVariables([
            'PANEL_USER_BADGES' => BadgesManager::getPanelUserBadges((int) $id_parts[0]),
            'PANEL_USER_BADGES_LINK' => URL::build('/panel/badges/user', 'id=' . urlencode($id_parts[0])),
            'PANEL_USER_BADGES_TITLE' => $this->_badges_language->get('badges', 'badges'),
            'PANEL_USER_BADGES_MANAGE' => $this->_badges_language->get('badges', 'manage_user_badges'),
            'PANEL_USER_BADGES_EMPTY' => $this->_badges_language->get('badges', 'no_user_badges'),
        ]);
    }

    private function assignUserPopoverBadges(TemplateBase $template): void
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            return;
        }

        $template->getEngine()->addVariable('USER_POPUP_BADGES', BadgesManager::getUserBadges((int) $_GET['id']));
    }
}
