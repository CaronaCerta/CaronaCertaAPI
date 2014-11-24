<?php

/**
 * Carona List
 * url - /Carona
 * method - GET
 * params - none
 */
$app->get('/', function () use ($app) {
    $response = array();

    $caronas = Carona::all();
    if ($caronas) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Listagem feita com sucesso';
        $response['caronas'] = $caronas->toArray();
    } else {
        $code = 500;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar as caronas';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * User Get
 * url - /caronas
 * method - GET
 * params - id
 */
$app->get('/:id', function ($id) use ($app) {
    $response = array();

    $carona = Carona::find($id);
    if ($carona) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Carona obtida com sucesso';
        $response['carona'] = $carona->toArray();
    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar a carona';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * User Registration
 * url - /usuario
 * method - POST
 * params - email, senha, nome, data_nascimento, telefone, endereco, cidade
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
 * User Edition
 * url - /usuario
 * method - POST
 * params - email, senha, nome, data_nascimento, telefone, endereco, cidade
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
 * User Deletion
 * url - /usuario
 * method - DELETE
 * params - id
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
            $response['message'] = 'Usuario nao removido';
        }


    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar o usuario';
    }

    // echo json response
    Response::echoResponse($code, $response);
});