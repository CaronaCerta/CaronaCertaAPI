<?php

/**
 * User Login
 * url - /login
 * method - POST
 * params - email, senha
 */
$app->post('/', function () use ($app) {
    $code = 200;
    $response = array();

    // check for required params
    Validators::verifyRequiredParams(array(
        'email',
        'senha',
    ));

    // reading post params
    $email = $app->request()->post('email');
    $senha = $app->request()->post('senha');

    $usuario = Usuario::where('email', '=', $email)->first();

    if ($usuario) {
        // User password is correct
        if (PassHash::check_password($senha, $usuario->senha)) {
            $session = new \Session(array(
                'key' => Session::generateKey(),
                'id_usuario' => $usuario->id_usuario,
            ));
            $session->save();

            $code = 200;
            $response['error'] = false;
            $response['session'] = $session->toArray();
            $response['usuario'] = $usuario->toArray();
        } else {
            $code = 404;
            $response['error'] = true;
            $response['message'] = 'Login falhou. Credenciais incorretas';
        }
    } else {
        // user mail is incorrect
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Login falhou. Credenciais incorretas';
    }

    Response::echoResponse($code, $response);
});

/**
 * User logout
 * url - /login
 * method - DELETE
 * params - id
 */
$app->delete('/:id', function ($id) use ($app) {
    $response = array();

    $session = Session::find($id);

    if ($session) {
        $return = $session->delete();
        if ($return) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Logout feito com sucesso';
        } else {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Erro ao realizar o logout';
        }


    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Sessão não contrada';
    }

    // echo json response
    Response::echoResponse($code, $response);
});