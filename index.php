<?php

require 'vendor/autoload.php';

require './include/DbHandler.php';
require './include/PassHash.php';
require './include/Response.php';
//require './include/appache_request_headers.php';

require './app/middlewares/Authenticate.php';

require './app/models/Task.php';
require './app/models/User.php';
require './app/models/UserTask.php';

require './app/validators/Validators.php';

$app = new \Slim\Slim();

// User id from db - Global Variable
$user_id = NULL;

$app->group('/users', function () use ($app) {
    require './app/controllers/UserController.php';
});
$app->group('/tasks', array(new Authenticate(), 'call'), function () use ($app) {
    require './app/controllers/TaskController.php';
});


$app->run();