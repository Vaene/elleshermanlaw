<?php

/**
 * DDEV database settings.
 */
$databases['default']['default'] = [
  'database' => 'db',
  'username' => 'db',
  'password' => 'db',
  'prefix' => '',
  'host' => 'db',
  'port' => '3306',
  'driver' => 'mysql',
  'namespace' => 'Drupal\\mysql\\Driver\\Database\\mysql',
  'autoload' => 'core/modules/mysql/src/Driver/Database/mysql/',
];

$settings['skip_permissions_hardening'] = TRUE;
$settings['trusted_host_patterns'] = ['^.+\.ddev\.site$', '^127\.0\.0\.1$', '^localhost$'];
