<?php

if (!$user->handlePanelPageLoad('admincp.badges.assign')) {
    require_once ROOT_PATH . '/403.php';
    die();
}

const PAGE = 'panel';
const PARENT_PAGE = 'badges';
const PANEL_PAGE = 'badges_bulk';
$page_title = $badges_language->get('badges', 'bulk_assign');
require_once ROOT_PATH . '/core/templates/backend_init.php';

Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $staffcp_nav], $widgets, $template);

if (Input::exists()) {
    if (!Token::check()) {
        Session::flash('badges_error', $language->get('general', 'invalid_token'));
        Redirect::to(URL::build('/panel/badges/bulk'));
    }

    if (is_numeric(Input::get('badge_id'))) {
        $users = BadgesManager::resolveUsers((string) Input::get('users'));

        if (!count($users)) {
            Session::flash('badges_error', $badges_language->get('badges', 'no_users_found'));
            Redirect::to(URL::build('/panel/badges/bulk'));
        }

        foreach ($users as $target_user) {
            BadgesManager::assign((int) $target_user->id, (int) Input::get('badge_id'), (int) $user->data()->id, Output::getClean(Input::get('note')));
        }

        Session::flash('badges_success', $badges_language->get('badges', 'bulk_complete', ['count' => count($users)]));
        Redirect::to(URL::build('/panel/badges/bulk'));
    }
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

$template->getEngine()->addVariables([
    'PARENT_PAGE' => PARENT_PAGE,
    'PAGE' => PANEL_PAGE,
    'DASHBOARD' => $language->get('admin', 'dashboard'),
    'BADGES' => $badges_language->get('badges', 'badges'),
    'BULK_ASSIGN' => $badges_language->get('badges', 'bulk_assign'),
    'BADGE' => $badges_language->get('badges', 'badge'),
    'BULK_USERS' => $badges_language->get('badges', 'bulk_users'),
    'BULK_USERS_HELP' => $badges_language->get('badges', 'bulk_users_help'),
    'DESCRIPTION' => $badges_language->get('badges', 'description'),
    'TOKEN' => Token::get(),
    'SUBMIT' => $language->get('general', 'submit'),
    'BADGES_LIST' => BadgesManager::getAll(false),
    'BADGES_LINK' => URL::build('/panel/badges'),
]);

$template->onPageLoad();

require ROOT_PATH . '/core/templates/panel_navbar.php';

$template->displayTemplate('badges/bulk');
