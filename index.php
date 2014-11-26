<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim();

// User id from db - Global Variable
$user_id = NULL;

$app->group('/usuario', function () use ($app) {
    require './app/controllers/UsuarioController.php';
});
$app->group('/login', function () use ($app) {
    require './app/controllers/LoginController.php';
});
$app->group('/avaliacao', array(new Authenticate(), 'call'), function () use ($app) {
    require './app/controllers/AvaliacaoController.php';
});
$app->group('/carona', array(new Authenticate(), 'call'), function () use ($app) {
	require './app/controllers/CaronaController.php';
});
$app->group('/carro', array(new Authenticate(), 'call'), function () use ($app) {
    require './app/controllers/CarroController.php';
});
$app->group('/motorista', array(new Authenticate(), 'call'), function () use ($app) {
    require './app/controllers/MotoristaController.php';
});
$app->group('/atributo', array(new Authenticate(), 'call'), function () use ($app) {
    require './app/controllers/AtributoController.php';
});
/*
$app->group('/passageiro', array(new Authenticate(), 'call'), function () use ($app) {
	require './app/controllers/PassageiroController.php';
});
*/

$app->run();