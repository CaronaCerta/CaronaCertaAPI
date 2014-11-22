<?php

/**
 * @api {get} /usuario User List
 * @apiName GetUsuarios
 * @apiGroup Usuario
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} usuarios with a list of usuarios object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Listagem feita com sucesso"
 *          "usuarios": [{
 *              "id_usuario": "5",
 *              "email": "test@test.com",
 *              "nome": "test",
 *              "data_nascimento": "1990-10-10",
 *              "telefone": "3333-3333",
 *              "endereco": "test",
 *              "cidade": "test",
 *              "created_at": "2014-11-14 00:00:00",
 *              "updated_at": "2014-11-14 00:00:00"
 *          },
 *          {
 *              "id_usuario": "5",
 *              "email": "test@test.com",
 *              "nome": "test",
 *              "data_nascimento": "1990-10-10",
 *              "telefone": "3333-3333",
 *              "endereco": "test",
 *              "cidade": "test",
 *              "created_at": "2014-11-14 00:00:00",
 *              "updated_at": "2014-11-14 00:00:00"
 *          }]
 *      }
 *
 * @apiError {Boolean} error true when there is an error, and false otherwise.
 * @apiError {String} message An error message explaining the error.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 500 Server Error
 *     {
 *       "error": true,
 *       "message": "Erro ao recuperar os usuarios"
 *     }
 */
$app->get('/', function () use ($app) {
    $response = array();

    $usuarios = Usuario::all();
    if ($usuarios) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Listagem feita com sucesso';
        $response['usuarios'] = $usuarios->toArray();
    } else {
        $code = 500;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar os usuarios';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {get} /usuario/:id User Get
 * @apiName GetUsuario
 * @apiGroup Usuario
 *
 * @apiParam {String} id The id of the usuario
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} usuario with the usuario object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Usuario obtido com sucesso"
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
 *     HTTP/1.1 500 Server Error
 *     {
 *       "error": true,
 *       "message": "Erro ao recuperar o usuario"
 *     }
 */
$app->get('/:id', function ($id) use ($app) {
    $response = array();

    $usuario = Usuario::find($id);
    if ($usuario) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Usuario obtido com sucesso';
        $response['usuario'] = $usuario->toArray();
    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar o usuario';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {post} /usuario User Register
 * @apiName NewUsuario
 * @apiGroup Usuario
 *
 * @apiParam {String} email The email of the usuario
 * @apiParam {String} senha The senha of the usuario
 * @apiParam {String} nome The nome of the usuario
 * @apiParam {String} data_nascimento The data de nascimento of the usuario
 * @apiParam {String} telefone The telefone of the usuario
 * @apiParam {String} endereco The endereço of the usuario
 * @apiParam {String} cidade The cidade of the usuario
 *
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} session with session object.
 * @apiSuccess {Array} usuario with usuario object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 201 Created
 *      {
 *          "error": false,
 *          "message": "Registro feito com sucesso"
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
 *     HTTP/1.1 500 Server Error
 *     {
 *       "error": true,
 *       "message": "Oops! Um erro ocorreu durante o registro"
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "error": true,
 *       "message": "Desculpe, esse e-mail ja esta no sistema"
 *     }
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "error": true,
 *       "message": "Campo obrigatório email, senha, nome, data_nascimento, telefone, endereco, cidade faltando ou vazio"
 *     }
 */
$app->post('/', function () use ($app) {
    $response = array();
    $code = 201;

    // check for required params
    Validators::verifyRequiredParams(array(
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

    if ($usuario_email_count == 0) {
        $res = $usuario->save();

        if ($res) {
            $session = new \Session(array(
                'key' => Session::generateKey(),
                'id_usuario' => $usuario->id_usuario,
            ));
            $session->save();

            $code = 201;
            $response['error'] = false;
            $response['message'] = 'Registro feito com sucesso';
            $response['session'] = $session->toArray();
            $response['usuario'] = $usuario->toArray();
        } elseif (!$res) {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Um erro ocorreu durante o registro';
        }
    } elseif ($usuario_email_count > 0) {
        $code = 200;
        $response['error'] = true;
        $response['message'] = 'Desculpe, esse e-mail ja esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {put} /usuario/:id User Alter
 * @apiName AlterUsuario
 * @apiGroup Usuario
 *
 * @apiParam {String} id The id of the usuario
 * 
 * @apiParam {String} email The email of the usuario
 * @apiParam {String} senha The senha of the usuario
 * @apiParam {String} nome The nome of the usuario
 * @apiParam {String} data_nascimento The data de nascimento of the usuario
 * @apiParam {String} telefone The telefone of the usuario
 * @apiParam {String} endereco The endereço of the usuario
 * @apiParam {String} cidade The cidade of the usuario
 *
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} usuario with usuario object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Registro alterado com sucesso"
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
 *     HTTP/1.1 500 Server Error
 *     {
 *       "error": true,
 *       "message": "Oops! Um erro ocorreu durante o registro"
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": true,
 *       "message": "Desculpe, esse usuario nao esta no sistema"
 *     }
 */
$app->put('/:id', function ($id) use ($app) {
    $response = array();
    $code = 200;

    $usuario = Usuario::find($id);

    if ($usuario) {
        // check for required params
        Validators::verifyRequiredParams(array(
            'email',
            'senha',
            'nome',
            'data_nascimento',
            'telefone',
            'endereco',
            'cidade',
        ));

        // edit usuario
        $usuario->email = $app->request->post('email');
        $usuario->senha = $app->request->post('senha');
        $usuario->nome = $app->request->post('nome');
        $usuario->data_nascimento = $app->request->post('data_nascimento');
        $usuario->telefone = $app->request->post('telefone');
        $usuario->endereco = $app->request->post('endereco');
        $usuario->cidade = $app->request->post('cidade');

        // validating email address
        Validators::validateEmail($usuario->email);

        $res = $usuario->save();

        if ($res) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Registro alterado com sucesso';
            $response['usuario'] = $usuario->toArray();
        } elseif (!$res) {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Um erro ocorreu durante o registro';
        }

    }
    else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Desculpe, esse usuario nao esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {delete} /usuario/:id User Delete
 * @apiName DeleteUsuario
 * @apiGroup Usuario
 *
 * @apiParam {String} id The id of the usuario
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Usuario deletado com sucesso"
 *      }
 *
 * @apiError {Boolean} error true when there is an error, and false otherwise.
 * @apiError {String} message An error message explaining the error.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 500 Server Error
 *     {
 *       "error": true,
 *       "message": "Oops! Ocorreu um erro ao tentar remover o usuario"
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": true,
 *       "message": "Desculpe, esse usuario nao esta no sistema"
 *     }
 */
$app->delete('/:id', function ($id) use ($app) {
    $response = array();

    $usuario = Usuario::find($id);

    if ($usuario) {
        $return = $usuario->delete();
        if ($return) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Usuario deletado com sucesso';
        } else {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Ocorreu um erro ao tentar remover o usuario';
        }


    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Desculpe, esse usuario nao esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});