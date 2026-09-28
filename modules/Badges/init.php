<?php

require_once ROOT_PATH . '/modules/Badges/classes/BadgesManager.php';
require_once ROOT_PATH . '/modules/Badges/module.php';

$badges_language = new Language(ROOT_PATH . '/modules/Badges/language');

$module = new Badges_Module($language, $badges_language, $pages);
