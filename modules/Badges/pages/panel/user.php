<?php

if (!$user->handlePanelPageLoad('admincp.badges.assign')) {
    require_once ROOT_PATH . '/403.php';
    die();
}

$user_id = Input::get('id');
if (!is_numeric($user_id)) {
    Redirect::to(URL::build('/panel/badges'));
}

$view_user = new User((int) $user_id);
if (!$view_user->exists()) {
    Redirect::to(URL::build('/panel/badges'));
}

const PAGE = 'panel';
const PARENT_PAGE = 'badges';
const PANEL_PAGE = 'badges_user';
$page_title = $badges_language->get('badges', 'assign_badges');
require_once ROOT_PATH . '/core/templates/backend_init.php';

Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $staffcp_nav], $widgets, $template);

if (Input::exists()) {
    if (!Token::check()) {
        Session::flash('badges_error', $language->get('general', 'invalid_token'));
        Redirect::to(URL::build('/panel/badges/user', 'id=' . urlencode($user_id)));
    }

    if (Input::get('action') === 'assign' && is_numeric(Input::get('badge_id'))) {
        BadgesManager::assign((int) $user_id, (int) Input::get('badge_id'), (int) $user->data()->id, Output::getClean(Input::get('note')));
        Session::flash('badges_success', $badges_language->get('badges', 'assigned'));
    }

    if (Input::get('action') === 'remove' && is_numeric(Input::get('badge_id'))) {
        BadgesManager::remove((int) $user_id, (int) Input::get('badge_id'));
        Session::flash('badges_success', $badges_language->get('badges', 'removed'));
    }

    Redirect::to(URL::build('/panel/badges/user', 'id=' . urlencode($user_id)));
}

if (Session::exists('badges_success')) {
    $template->getEngine()->addVariables([
        'SUCCESS' => Session::flash('badges_success'),
        'SUCCESS_TITLE' => $language->get('general', 'success'),
    ]);
}

if (Session::exists('badges_error')) {
    $template->getEngine()->addVariables([
        'ERRORS' => [Session::flash('badges_error')],
        'ERRORS_TITLE' => $language->get('general', 'error'),
    ]);
}

$current_badges = BadgesManager::getPanelUserBadges((int) $user_id);
$current_ids = [];
foreach ($current_badges as $badge) {
    $current_ids[] = (int) $badge->id;
}

$template->getEngine()->addVariables([
    'PARENT_PAGE' => PARENT_PAGE,
    'PAGE' => PANEL_PAGE,
    'DASHBOARD' => $language->get('admin', 'dashboard'),
    'BADGES' => $badges_language->get('badges', 'badges'),
    'ASSIGN_BADGES' => $badges_language->get('badges', 'assign_badges'),
    'CURRENT_BADGES' => $badges_language->get('badges', 'current_badges'),
    'AVAILABLE_BADGES' => $badges_language->get('badges', 'available_badges'),
    'NO_USER_BADGES' => $badges_language->get('badges', 'no_user_badges'),
    'BADGE' => $badges_language->get('badges', 'badge'),
    'DESCRIPTION' => $badges_language->get('badges', 'description'),
    'TOKEN' => Token::get(),
    'SUBMIT' => $language->get('general', 'submit'),
    'REMOVE' => $language->get('general', 'delete'),
    'BACK' => $language->get('general', 'back'),
    'USER_ID' => $view_user->data()->id,
    'USERNAME' => $view_user->getDisplayname(true),
    'NICKNAME' => $view_user->getDisplayname(),
    'AVATAR' => $view_user->getAvatar(128),
    'USER_STYLE' => $view_user->getGroupStyle(),
    'BADGES_LIST' => BadgesManager::getAll(false),
    'USER_BADGES' => $current_badges,
    'USER_BADGE_IDS' => $current_ids,
    'BADGES_LINK' => URL::build('/panel/badges'),
]);

$template->onPageLoad();

require ROOT_PATH . '/core/templates/panel_navbar.php';

$template->displayTemplate('badges/user');
