<?php

/**
 * @api {get} /passageiro Passageiro List
 * @apiName GetPassageiros
 * @apiGroup Passageiro
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} passageiros with a list of passageiros object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Listagem feita com sucesso"
 *          "passageiros": [{
 *              "id_passageiro": "5",
 *              "id_carona": "5",
 *              "id_usuario": "5",
 *              "created_at": "2014-11-14 00:00:00",
 *              "updated_at": "2014-11-14 00:00:00"
 *          },
 *          {
 *              "id_passageiro": "5",
 *              "id_carona": "5",
 *              "id_usuario": "5",
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
 *       "message": "Erro ao recuperar os passageiros"
 *     }
 */
$app->get('/', function () use ($app) {
    $response = array();

    $passageiros = Passageiro::all();
    if ($passageiros) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Listagem feita com sucesso';
        $response['passageiros'] = $passageiros->toArray();
    } else {
        $code = 500;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar os passageiros';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {get} /passageiro/:id Passageiro Get
 * @apiName GetPassageiro
 * @apiGroup Passageiro
 *
 * @apiParam {String} id The id of the passageiro
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} passageiro with the passageiro object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Passageiro obtido com sucesso"
 *          "passageiro": {
 *              "id_passageiro": "5",
 *              "id_carona": "5",
 *              "id_usuario": "5",
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
 *       "message": "Erro ao recuperar o passageiro"
 *     }
 */
$app->get('/:id', function ($id) use ($app) {
    $response = array();

    $usuario = Passageiro::find($id);
    if ($usuario) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Passageiro obtido com sucesso';
        $response['passageiro'] = $usuario->toArray();
    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar o passageiro';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {post} /passageiro Passageiro Register
 * @apiName NewPassageiro
 * @apiGroup Passageiro
 *
 * @apiParam {String} id_carona The ID of the carona
 * @apiParam {String} id_usuario The ID of the usuario
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} passageiro with passageiro object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 201 Created
 *      {
 *          "error": false,
 *          "message": "Registro feito com sucesso"
 *          "passageiro": {
 *              "id_passageiro": "5",
 *              "id_carona": "5",
 *              "id_usuario": "5",
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
 *       "message": "Campo obrigatório id_carona, id_usuario faltando ou vazio"
 *     }
 */
$app->post('/', function () use ($app) {
    $response = array();
    $code = 201;

    // check for required params
    Validators::verifyRequiredParams(array(
        'id_usuario',
        'id_carona',
    ));

    // create a new usuario
    $passageiro = new \Passageiro(array(
        'id_usuario' => $app->request->post('id_usuario'),
        'id_carona' => $app->request->post('id_carona'),
    ));

    $res = $passageiro->save();

    if ($res) {
        $code = 201;
        $response['error'] = false;
        $response['message'] = 'Registro feito com sucesso';
        $response['passageiro'] = $passageiro->toArray();
    } elseif (!$res) {
        $code = 500;
        $response['error'] = true;
        $response['message'] = 'Oops! Um erro ocorreu durante o registro';
    }
    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {put} /passageiro/:id Passageiro Alter
 * @apiName AlterPassageiro
 * @apiGroup Passageiro
 *
 * @apiParam {String} id The id of the passageiro
 *
 * @apiParam {String} id_carona The ID of the carona
 * @apiParam {String} id_usuario The ID of the usuario
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} passageiro with passageiro object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Registro alterado com sucesso"
 *          "passageiro": {
 *              "id_passageiro": "5",
 *              "id_carona": "5",
 *              "id_usuario": "5",
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
 *       "message": "Desculpe, esse passageiro nao esta no sistema"
 *     }
 */
$app->put('/:id', function ($id) use ($app) {
    $response = array();
    $code = 200;

    $passageiro = Passageiro::find($id);

    if ($passageiro) {
        // check for required params
        Validators::verifyRequiredParams(array(
            'id_usuario',
            'id_carona',
        ));

        // edit passageiro
        $passageiro->id_usuario = $app->request->post('id_usuario');
        $passageiro->id_carona = $app->request->post('id_carona');

        $res = $passageiro->save();

        if ($res) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Registro alterado com sucesso';
            $response['usuario'] = $passageiro->toArray();
        } elseif (!$res) {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Um erro ocorreu durante o registro';
        }

    }
    else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Desculpe, esse passageiro nao esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {delete} /passageiro/:id Passageiro Delete
 * @apiName DeletePassageiro
 * @apiGroup Passageiro
 *
 * @apiParam {String} id The id of the passageiro
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Passageiro deletado com sucesso"
 *      }
 *
 * @apiError {Boolean} error true when there is an error, and false otherwise.
 * @apiError {String} message An error message explaining the error.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 500 Server Error
 *     {
 *       "error": true,
 *       "message": "Oops! Ocorreu um erro ao tentar remover o passageiro"
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": true,
 *       "message": "Desculpe, esse passageiro nao esta no sistema"
 *     }
 */
$app->delete('/:id', function ($id) use ($app) {
    $response = array();

    $passageiro = Passageiro::find($id);

    if ($passageiro) {
        $return = $passageiro->delete();
        if ($return) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Passageiro deletado com sucesso';
        } else {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Ocorreu um erro ao tentar remover o passageiro';
        }


    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Desculpe, esse passageiro nao esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});