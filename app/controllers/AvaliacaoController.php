<?php

/**
 * @api {get} /avaliacao Avaliacao List
 * @apiName GetAvaliacaos
 * @apiGroup Avaliacao
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} avaliacoes with a list of avaliacoes object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Listagem feita com sucesso"
 *          "avaliacoes": [{
 *              "id_avaliacao": "5",
 *              "id_atributo": "20",
 *              "id_carona": "20",
 *              "id_usuario_avaliador": "20",
 *              "id_usuario_avaliado": "20",
 *              "papel": "0",
 *              "nota": "5",
 *              "created_at": "2014-11-14 00:00:00",
 *              "updated_at": "2014-11-14 00:00:00"
 *          },
 *          {
 *              "id_avaliacao": "5",
 *              "id_atributo": "20",
 *              "id_carona": "20",
 *              "id_usuario_avaliador": "20",
 *              "id_usuario_avaliado": "20",
 *              "papel": "0",
 *              "nota": "5",
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
 *       "message": "Erro ao recuperar as avaliacoes"
 *     }
 */
$app->get('/', function () use ($app) {
    $response = array();

    // @todo get avaliacoes by user
    //$avaliacoes = Avaliacao::where('id_usuario_avaliado', '=', $app->request->post('id_usuario'));

    $avaliacoes = Avaliacao::all();
    if ($avaliacoes) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Listagem feita com sucesso';
        $response['avaliacoes'] = $avaliacoes->toArray();
    } else {
        $code = 500;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar as avaliacoes';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {get} /avaliacao/:id Avaliacao Get
 * @apiName GetAvaliacao
 * @apiGroup Avaliacao
 *
 * @apiParam {String} id The id of the avaliacao
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} avaliacao with the avaliacao object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Avaliacao obtido com sucesso"
 *          "avaliacao": {
 *              "id_avaliacao": "5",
 *              "id_atributo": "20",
 *              "id_carona": "20",
 *              "id_usuario_avaliador": "20",
 *              "id_usuario_avaliado": "20",
 *              "papel": "0",
 *              "nota": "5",
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
 *       "message": "Erro ao recuperar a avaliacao"
 *     }
 */
$app->get('/:id', function ($id) use ($app) {
    $response = array();

    $avaliacao = Avaliacao::find($id);
    if ($avaliacao) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Avaliacao obtido com sucesso';
        $response['avaliacao'] = $avaliacao->toArray();
    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar a avaliacao';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {post} /avaliacao Avaliacao Register
 * @apiName NewAvaliacao
 * @apiGroup Avaliacao
 *
 * @apiParam {String} id_atributo The ID of the atributo
 * @apiParam {String} id_motorista The ID of the carona
 * @apiParam {String} id_usuario_avaliador The ID of the usuario avaliador
 * @apiParam {String} id_usuario_avaliado The ID of the usuario avaliado
 * @apiParam {String} papel The papel of the avaliacao (0=motorista, 1=passageiro)
 * @apiParam {String} nota The nota of the avaliacao (0 to 5)
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} avaliacao with avaliacao object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 201 Created
 *      {
 *          "error": false,
 *          "message": "Registro feito com sucesso"
 *          "avaliacao": {
 *              "id_avaliacao": "5",
 *              "id_atributo": "20",
 *              "id_carona": "20",
 *              "id_usuario_avaliador": "20",
 *              "id_usuario_avaliado": "20",
 *              "papel": "0",
 *              "nota": "5",
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
 *       "message": "Campo obrigatório id_atributo, id_carona, id_usuario_avaliador, id_usuario_avaliado, papel, nota faltando ou vazio"
 *     }
 */
$app->post('/', function () use ($app) {
    $response = array();
    $code = 201;

    // check for required params
    Validators::verifyRequiredParams(array(
        'id_atributo',
        'id_carona',
        'id_usuario_avaliador',
        'id_usuario_avaliado',
        'papel',
        'nota',
    ));

    // create a new avaliacao
    $avaliacao = new \Avaliacao(array(
        'id_atributo' => $app->request->post('id_atributo'),
        'id_carona' => $app->request->post('id_carona'),
        'id_usuario_avaliador' => $app->request->post('id_usuario_avaliador'),
        'id_usuario_avaliado' => $app->request->post('id_usuario_avaliado'),
        'papel' => $app->request->post('papel'),
        'nota' => $app->request->post('nota'),
    ));

    // validating role
    Validators::validateRole($avaliacao->papel);

    // @todo verify if users exist
    // verifying if both user exists
    // $usuario_avaliador_count = Usuario::where('email', '=', $avaliacao->id_usuario_avaliador)->count();
    // $usuario_avaliado_count = Usuario::where('email', '=', $avaliacao->id_usuario_avaliado)->count();

    $res = $avaliacao->save();

    if ($res) {
        $code = 201;
        $response['error'] = false;
        $response['message'] = 'Registro feito com sucesso';
        $response['avaliacao'] = $avaliacao->toArray();
    } elseif (!$res) {
        $code = 500;
        $response['error'] = true;
        $response['message'] = 'Oops! Um erro ocorreu durante o registro';
    }
    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {put} /avaliacao/:id Avaliacao Alter
 * @apiName AlterAvaliacao
 * @apiGroup Avaliacao
 *
 * @apiParam {String} id The id of the avaliacao
 *
 * @apiParam {String} id_atributo The ID of the atributo
 * @apiParam {String} id_motorista The ID of the carona
 * @apiParam {String} id_usuario_avaliador The ID of the usuario avaliador
 * @apiParam {String} id_usuario_avaliado The ID of the usuario avaliado
 * @apiParam {String} papel The papel of the avaliacao (0=motorista, 1=passageiro)
 * @apiParam {String} nota The nota of the avaliacao (0 to 5)
 * 
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} avaliacao with avaliacao object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Registro alterado com sucesso"
 *          "avaliacao": {
 *              "id_avaliacao": "5",
 *              "id_atributo": "20",
 *              "id_carona": "20",
 *              "id_usuario_avaliador": "20",
 *              "id_usuario_avaliado": "20",
 *              "papel": "0",
 *              "nota": "5",
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
 *       "message": "Desculpe, essa avaliacao nao esta no sistema"
 *     }
 */
$app->put('/:id', function ($id) use ($app) {
    $response = array();
    $code = 200;

    $avaliacao = Avaliacao::find($id);

    if ($avaliacao) {
        // check for required params
        Validators::verifyRequiredParams(array(
            'id_atributo',
            'id_carona',
            'id_usuario_avaliador',
            'id_usuario_avaliado',
            'papel',
            'nota',
        ));

        // edit avaliacao
        $avaliacao->id_atributo = $app->request->post('id_atributo');
        $avaliacao->id_carona = $app->request->post('id_carona');
        $avaliacao->id_usuario_avaliador = $app->request->post('id_usuario_avaliador');
        $avaliacao->id_usuario_avaliado = $app->request->post('id_usuario_avaliado');
        $avaliacao->papel = $app->request->post('papel');
        $avaliacao->nota = $app->request->post('nota');

        // validating role
        Validators::validateRole($avaliacao->papel);

        // @todo verify if users exist
        // verifying if both user exists
        // $usuario_avaliador_count = Usuario::where('email', '=', $avaliacao->id_usuario_avaliador)->count();
        // $usuario_avaliado_count = Usuario::where('email', '=', $avaliacao->id_usuario_avaliado)->count();

        $res = $avaliacao->save();

        if ($res) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Registro alterado com sucesso';
            $response['avaliacao'] = $avaliacao->toArray();
        } elseif (!$res) {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Um erro ocorreu durante o registro';
        }

    }
    else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Desculpe, essa avaliacao nao esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {delete} /avaliacao/:id Avaliacao Delete
 * @apiName DeleteAvaliacao
 * @apiGroup Avaliacao
 *
 * @apiParam {String} id The id of the avaliacao
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
 *          "message": "Avaliacao deletada com sucesso"
 *      }
 *
 * @apiError {Boolean} error true when there is an error, and false otherwise.
 * @apiError {String} message An error message explaining the error.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 500 Server Error
 *     {
 *       "error": true,
 *       "message": "Oops! Ocorreu um erro ao tentar remover a avaliacao"
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": true,
 *       "message": "Desculpe, esse avaliacao nao esta no sistema"
 *     }
 */
$app->delete('/:id', function ($id) use ($app) {
    $response = array();

    $avaliacao = Avaliacao::find($id);

    if ($avaliacao) {
        $return = $avaliacao->delete();
        if ($return) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Avaliacao deletada com sucesso';
        } else {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Ocorreu um erro ao tentar remover a avaliacao';
        }


    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Desculpe, esse avaliacao nao esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});