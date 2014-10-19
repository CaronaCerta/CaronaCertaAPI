<?php

use Swagger\Annotations as SWG;

/**
 * User Registration
 * url - /usuario
 * method - POST
 * params - username, email, senha, nome, data_nascimento, telefone, endereco, cidade
 */
$app->post('/', function () use ($app) {
    $response = array();
    $code = 201;

    // check for required params
    Validators::verifyRequiredParams(array(
        'username',
        'email',
        'senha',
        'nome',
        'data_nascimento',
        'telefone',
        'endereco',
        'cidade',
    ));

    // create a new usuario
    $usuario = new \Usuario(array(
        'username' => $app->request->post('username'),
        'email' => $app->request->post('email'),
        'senha' => PassHash::hash($app->request->post('senha')),
        'nome' => $app->request->post('nome'),
        'data_nascimento' => $app->request->post('data_nascimento'),
        'telefone' => $app->request->post('telefone'),
        'endereco' => $app->request->post('endereco'),
        'cidade' => $app->request->post('cidade'),
    ));

    // validating email address
    Validators::validateEmail($usuario->email);

    // verifying if user exists
    $usuario_email_count = Usuario::where('email', '=', $usuario->email)->count();

    $usuario_username_count = Usuario::where('username', '=', $usuario->username)->count();

    if ($usuario_email_count == 0 && $usuario_username_count == 0) {
        $res = $usuario->save();

        if ($res) {
            $session = new \Session(array(
                'key' => Session::generateKey(),
                'id_usuario' => $usuario->id,
            ));
            $session->save();

            $code = 201;
            $response['error'] = false;
            $response['message'] = 'Registro feito com sucesso';
            $response['session'] = $session->toArray();
            $response['usuario'] = $usuario->toArray();
        } elseif (!$res) {
            $code = 200;
            $response['error'] = true;
            $response['message'] = 'Oops! Um erro ocorreu durante o registro';
        }
    } elseif ($usuario_email_count > 0) {
        $code = 200;
        $response["error"] = true;
        $response["message"] = 'Desculpe, esse e-mail ja esta no sistema';
    } elseif ($usuario_username_count > 0) {
        $code = 200;
        $response["error"] = true;
        $response["message"] = 'Desculpe, esse username ja esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});