<?php

return [
  'mysql' => [
    'host' => 'db',
    'port' => '3306',
    'username' => 'nameless',
    'password' => '20702b367453150e7d30b345a4d94fb8f74e53aad982a8ebb8236019e48da4f1',
    'db' => 'nameless',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'initialise_charset' => true,
    'initialise_collation' => true,
  ],
  'remember' => [
    'cookie_name' => 'nl2',
    'cookie_expiry' => 2629800,
  ],
  'session' => [
    'session_name' => '2user',
    'admin_name' => '2admin',
    'token_name' => '2token',
  ],
  'core' => [
    'hostname' => 'johnfries.net',
    'path' => '',
    'friendly' => true,
    'force_https' => false,
    'force_www' => false,
    'captcha' => false,
    'date_format' => 'd M Y, H:i',
    'trustedProxies' => NULL,
    'installed' => true,
  ],
];