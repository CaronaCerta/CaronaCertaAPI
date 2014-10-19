<?php
// Error/success codes
define('USER_CREATED_SUCCESSFULLY', 0);
define('USER_CREATE_FAILED', 1);
define('USER_ALREADY_EXISTS', 2);
define('USER_NOT_EXISTS', 3);
define('AVAIL_CREATED_SUCCESSFULLY', 0);
define('AVAIL_CREATE_FAILED', 1);

// Openshift environment variables
$OPENSHIFT_MYSQL_DB_USERNAME = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
$OPENSHIFT_MYSQL_DB_PASSWORD = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
$OPENSHIFT_MYSQL_DB_HOST = getenv('OPENSHIFT_MYSQL_DB_HOST');
$OPENSHIFT_MYSQL_DB_PORT = getenv('OPENSHIFT_MYSQL_DB_PORT');

/**
 * Database configuration
 */
global $db_settings;
$db_settings = array(
    'driver' => 'mysql',
    'host' => ($OPENSHIFT_MYSQL_DB_HOST) ? $OPENSHIFT_MYSQL_DB_HOST : 'localhost',
    'port' => ($OPENSHIFT_MYSQL_DB_PORT) ? $OPENSHIFT_MYSQL_DB_PORT : 3306,
    'database' => 'carona_certa',
    'username' => ($OPENSHIFT_MYSQL_DB_USERNAME) ? $OPENSHIFT_MYSQL_DB_USERNAME : 'root',
    'password' => ($OPENSHIFT_MYSQL_DB_PASSWORD) ? $OPENSHIFT_MYSQL_DB_PASSWORD : '',
    'charset' => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix' => '',
);