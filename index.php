<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim();

// User id from db - Global Variable
$user_id = NULL;

use Swagger\Annotations as SWG;

$app->group('/usuario', function () use ($app) {
    require './app/controllers/UsuarioController.php';
});
$app->group('/login', function () use ($app) {
    require './app/controllers/LoginController.php';
});
$app->group('/avaliacao', array(new Authenticate(), 'call'), function () use ($app) {
    require './app/controllers/AvaliacaoController.php';
});

$app->run();