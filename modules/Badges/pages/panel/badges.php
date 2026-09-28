<?php

if (!$user->handlePanelPageLoad('admincp.badges')) {
    require_once ROOT_PATH . '/403.php';
    die();
}

const PAGE = 'panel';
const PARENT_PAGE = 'badges';
const PANEL_PAGE = 'badges_manage';
$page_title = $badges_language->get('badges', 'manage_badges');
require_once ROOT_PATH . '/core/templates/backend_init.php';

// Load modules + template
Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $staffcp_nav], $widgets, $template);

if (Input::exists()) {
    if (!Token::check()) {
        Session::flash('badges_error', $language->get('general', 'invalid_token'));
        Redirect::to(URL::build('/panel/badges'));
    }

    $action = Input::get('action');

    if ($action === 'delete' && is_numeric(Input::get('badge_id'))) {
        BadgesManager::delete((int) Input::get('badge_id'));
        Session::flash('badges_success', $badges_language->get('badges', 'deleted'));
        Redirect::to(URL::build('/panel/badges'));
    }

    if ($action === 'save') {
        $data = BadgesManager::normaliseFormData();

        if ($data['name'] === '') {
            Session::flash('badges_error', $language->get('admin', 'name_required'));
            Redirect::to(URL::build('/panel/badges'));
        }

        if (is_numeric(Input::get('badge_id')) && (int) Input::get('badge_id') > 0) {
            BadgesManager::update((int) Input::get('badge_id'), $data, $_FILES['image'] ?? null);
        } else {
            BadgesManager::create($data, $_FILES['image'] ?? null);
        }

        Session::flash('badges_success', $badges_language->get('badges', 'saved'));
        Redirect::to(URL::build('/panel/badges'));
    }
}

$editing_badge = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $editing_badge = BadgesManager::getById((int) $_GET['edit']);
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
    'MANAGE_BADGES' => $badges_language->get('badges', 'manage_badges'),
    'CREATE_BADGE' => $badges_language->get('badges', 'create_badge'),
    'EDIT_BADGE' => $badges_language->get('badges', 'edit_badge'),
    'BADGE_NAME' => $badges_language->get('badges', 'badge_name'),
    'DESCRIPTION' => $badges_language->get('badges', 'description'),
    'ICON' => $badges_language->get('badges', 'icon'),
    'ICON_HELP' => $badges_language->get('badges', 'icon_help'),
    'IMAGE' => $badges_language->get('badges', 'image'),
    'COLOUR' => $badges_language->get('badges', 'colour'),
    'DISPLAY_ORDER' => $badges_language->get('badges', 'display_order'),
    'ENABLED' => $badges_language->get('badges', 'enabled'),
    'NO_BADGES' => $badges_language->get('badges', 'no_badges'),
    'TOKEN' => Token::get(),
    'SUBMIT' => $language->get('general', 'submit'),
    'DELETE' => $language->get('general', 'delete'),
    'EDIT' => $language->get('general', 'edit'),
    'CANCEL' => $language->get('general', 'cancel'),
    'ARE_YOU_SURE' => $language->get('general', 'are_you_sure'),
    'BADGES_LIST' => BadgesManager::getAll(),
    'EDITING_BADGE' => $editing_badge,
    'BULK_ASSIGN_LINK' => URL::build('/panel/badges/bulk'),
    'BULK_ASSIGN' => $badges_language->get('badges', 'bulk_assign'),
]);

$template->onPageLoad();

require ROOT_PATH . '/core/templates/panel_navbar.php';

$template->displayTemplate('badges/badges');
