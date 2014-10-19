<?php

use Illuminate\Database\Capsule\Manager as Capsule;

global $db_settings;

/**
 * Configure the database and boot Eloquent
 */
$capsule = new Capsule;

$capsule->addConnection($db_settings);

$capsule->setAsGlobal();

$capsule->bootEloquent();

// set timezone for timestamps etc
date_default_timezone_set('UTC');