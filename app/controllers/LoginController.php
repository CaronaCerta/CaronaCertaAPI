<?php

/**
 * @api {get} /login User Login
 * @apiName Login
 * @apiGroup Login
 *
 * @apiParam {String} email Email do usuario
 * @apiParam {String} senha Senha do usuario
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {Array} session with session object.
 * @apiSuccess {Array} usuario with usuario object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "session": {
 *              "key": "52940b45d3a70139e0e45221e7d753c4",
 *              "id_usuario": "5",
 *              "updated_at": "2014-11-14 22:24:16",
 *              "created_at": "2014-11-14 22:24:16",
 *              "id_session": 7
 *          },
 *          "usuario": {
 *              "id_usuario": "5",
 *              "email": "test@test.com",
 *              "nome": "test",
 *              "data_nascimento": "1990-10-10",
 *              "telefone": "3333-3333",
 *              "endereco": "test",
 *              "cidade": "test",
 *              "created_at": "2014-11-14 00:00:00",
 *              "updated_at": "2014-11-14 00:00:00"
 *          }
 *      }
 *
 * @apiError {Boolean} error true when there is an error, and false otherwise.
 * @apiError {String} message An error message explaining the error.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": true,
 *       "message": "Login falhou. Credenciais incorretas"
 *     }
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
 * @api {delete} /login User logout
 * @apiName Logout
 * @apiGroup Login
 *
 * @apiParam {String} key The session key
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An error message explaining the error.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Logout feito com sucesso"
 *      }
 *
 * @apiError {Boolean} error true when there is an error, and false otherwise.
 * @apiError {String} message An error message explaining the error.
 *
 * @apiErrorExample Error-Response:
 *      HTTP/1.1 404 Not Found
 *      {
 *          "error": true,
 *          "message": "Sessão não contrada"
 *      }
 */
$app->delete('/:id', function ($key) use ($app) {
    $response = array();

    $session = Session::where('key', '=', $key)->first();

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