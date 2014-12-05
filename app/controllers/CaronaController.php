<?php

/**
 * @api {get} /carona Carona List
 * @apiName GetCaronas
 * @apiGroup Carona
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiParam {String} Sort List of fields separated by comma for sorting the results (default is in ascending order. For decreasing order, put "-" in front of the field)
 * @apiParam {Array} Fields List of fields to apply the filter
 *
 * @apiParamExample {String} Request-Example:
 *      sort=-field1,field2
 * @apiParamExample {String} Request-Example:
 *      field1=value1&field2=value2&field3=value3
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} caronas with a list of caronas object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Listagem feita com sucesso"
 *          "caronas": [{
 *              "id_carona": "5",
 *              "id_carro": "6",
 *              "data": "1990-10-10",
 *              "lugar_saida": "test",
 *              "lugar_destino": "test",
 *              "lugares_disponiveis": "3",
 *              "observacoes": "test",
 *              "created_at": "2014-11-14 00:00:00",
 *              "updated_at": "2014-11-14 00:00:00"
 *          },
 *          {
 *              "id_carona": "5",
 *              "id_carro": "6",
 *              "data": "1990-10-10",
 *              "lugar_saida": "test",
 *              "lugar_destino": "test",
 *              "lugares_disponiveis": "3",
 *              "observacoes": "test",
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
 *       "message": "Erro ao recuperar as caronas"
 *     }
 */
$app->get('/', function () use ($app) {
    $response = array();

    $query = Carona::query();
    SortParameters::applySort($query, $app);
    FilterParameters::applyFilter($query, $app);

    try {
        $caronas = $query->get();
    } catch (\Illuminate\Database\QueryException $e) {
        // Ignore the exception. It will be handled below
    }

    if (isset($caronas)) {
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
 * @api {get} /carona/:id Carona Get
 * @apiName GetCarona
 * @apiGroup Carona
 *
 * @apiParam {String} id The id of the carona
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} carona with the carona object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Carona obtido com sucesso"
 *          "carona": {
 *              "id_carona": "5",
 *              "id_carro": "6",
 *              "data": "1990-10-10",
 *              "lugar_saida": "test",
 *              "lugar_destino": "test",
 *              "lugares_disponiveis": "3",
 *              "observacoes": "test",
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
 *       "message": "Erro ao recuperar a carona"
 *     }
 */
$app->get('/:id', function ($id) use ($app) {
    $response = array();

    $carona = Carona::find($id);
    if ($carona) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Carona obtido com sucesso';
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
 * @api {post} /carona Carona Register
 * @apiName NewCarona
 * @apiGroup Carona
 *
 * @apiParam {String} id_carro The id of the carro
 * @apiParam {String} data The data of the carona
 * @apiParam {String} lugar_saida The lugar de saida of the carona
 * @apiParam {String} lugar_destino The lugar destino of the carona
 * @apiParam {String} lugares_disponiveis Lugares disponiveis in the carona
 * @apiParam {String} observacoes Observações of the carona
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} carona with carona object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 201 Created
 *      {
 *          "error": false,
 *          "message": "Registro feito com sucesso"
 *          "carona": {
 *              "id_carona": "5",
 *              "id_carro": "6",
 *              "data": "1990-10-10",
 *              "lugar_saida": "test",
 *              "lugar_destino": "test",
 *              "lugares_disponiveis": "3",
 *              "observacoes": "test",
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
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "error": true,
 *       "message": "Campo obrigatório id_carro, data, lugar_saida, lugar_destino, lugares_disponiveis faltando ou vazio"
 *     }
 */
$app->post('/', function () use ($app) {
    $response = array();
    $code = 201;

    // check for required params
    Validators::verifyRequiredParams(array(
        'id_carro',
        'data',
        'lugar_saida',
        'lugar_destino',
        'lugares_disponiveis',
    ));

    // create a new carona
    $carona = new \Carona(array(
        'id_carro' => $app->request->post('id_carro'),
        'data' => $app->request->post('data'),
        'lugar_saida' => $app->request->post('lugar_saida'),
        'lugar_destino' => $app->request->post('lugar_destino'),
        'lugares_disponiveis' => $app->request->post('lugares_disponiveis'),
        'observacoes' => $app->request->post('observacoes'),
    ));

    $res = $carona->save();

    if ($res) {
        $code = 201;
        $response['error'] = false;
        $response['message'] = 'Registro feito com sucesso';
        $response['carona'] = $carona->toArray();
    } elseif (!$res) {
        $code = 500;
        $response['error'] = true;
        $response['message'] = 'Oops! Um erro ocorreu durante o registro';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {put} /carona/:id Carona Alter
 * @apiName AlterCarona
 * @apiGroup Carona
 *
 * @apiParam {String} id The id of the carona
 *
 * @apiParam {String} id_carro The id of the carro
 * @apiParam {String} data The data of the carona
 * @apiParam {String} lugar_saida The lugar de saida of the carona
 * @apiParam {String} lugar_destino The lugar destino of the carona
 * @apiParam {String} lugares_disponiveis Lugares disponiveis in the carona
 * @apiParam {String} observacoes Observações of the carona
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} carona with carona object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Registro alterado com sucesso"
 *          "carona": {
 *              "id_carona": "5",
 *              "id_carro": "6",
 *              "data": "1990-10-10",
 *              "lugar_saida": "test",
 *              "lugar_destino": "test",
 *              "lugares_disponiveis": "3",
 *              "observacoes": "test",
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
 *       "message": "Desculpe, esse carona nao esta no sistema"
 *     }
 */
$app->put('/:id', function ($id) use ($app) {
    $response = array();
    $code = 200;

    $carona = Carona::find($id);

    if ($carona) {
        // check for required params
        Validators::verifyRequiredParams(array(
            'id_carro',
            'data',
            'lugar_saida',
            'lugar_destino',
            'lugares_disponiveis',
        ));

        // edit carona
        $carona->id_carro = $app->request->post('id_carro');
        $carona->data = $app->request->post('data');
        $carona->lugar_saida = $app->request->post('lugar_saida');
        $carona->lugar_destino = $app->request->post('lugar_destino');
        $carona->lugares_disponiveis = $app->request->post('lugares_disponiveis');
        $carona->observacoes = $app->request->post('observacoes');

        $res = $carona->save();

        if ($res) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Registro alterado com sucesso';
            $response['carona'] = $carona->toArray();
        } elseif (!$res) {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Um erro ocorreu durante o registro';
        }
    }
    else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Desculpe, esse carona nao esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {delete} /carona/:id Carona Delete
 * @apiName DeleteCarona
 * @apiGroup Carona
 *
 * @apiParam {String} id The id of the carona
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
 *          "message": "Carona deletada com sucesso"
 *      }
 *
 * @apiError {Boolean} error true when there is an error, and false otherwise.
 * @apiError {String} message An error message explaining the error.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 500 Server Error
 *     {
 *       "error": true,
 *       "message": "Oops! Ocorreu um erro ao tentar remover a carona"
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": true,
 *       "message": "Desculpe, esse carona nao esta no sistema"
 *     }
 */
$app->delete('/:id', function ($id) use ($app) {
    $response = array();

    $carona = Carona::find($id);

    if ($carona) {
        $return = $carona->delete();
        if ($return) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Carona deletada com sucesso';
        } else {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Ocorreu um erro ao tentar remover a carona';
        }


    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Desculpe, esse carona nao esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});