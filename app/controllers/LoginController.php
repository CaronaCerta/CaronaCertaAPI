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
            $code = 200;
            $response['error'] = true;
            $response['message'] = 'Login falhou. Credenciais incorretas';
        }
    } else {
        // user mail is incorrect
        $code = 200;
        $response['error'] = true;
        $response['message'] = 'Login falhou. Credenciais incorretas';
    }

    Response::echoResponse($code, $response);
});