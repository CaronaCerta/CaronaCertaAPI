<?php
/**
 * Database configuration
 */
define('DB_USERNAME', isset($OPENSHIFT_MYSQL_DB_USERNAME) ? $OPENSHIFT_MYSQL_DB_USERNAME : 'root');
define('DB_PASSWORD', isset($OPENSHIFT_MYSQL_DB_PASSWORD) ? $OPENSHIFT_MYSQL_DB_PASSWORD : '');
define('DB_HOST', isset($OPENSHIFT_MYSQL_DB_HOST) ? $OPENSHIFT_MYSQL_DB_HOST : 'localhost');
define('DB_NAME', 'task_manager');
define('DB_PORT', isset($OPENSHIFT_MYSQL_DB_PORT) ? $OPENSHIFT_MYSQL_DB_PORT : 3306);

define('USER_CREATED_SUCCESSFULLY', 0);
define('USER_CREATE_FAILED', 1);
define('USER_ALREADY_EXISTS', 2);
