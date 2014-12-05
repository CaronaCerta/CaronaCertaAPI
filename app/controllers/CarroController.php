<?php

/**
 * @api {get} /carro Carro List
 * @apiName GetCarros
 * @apiGroup Carro
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
 * @apiSuccess {Array} carros with a list of carros object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Listagem feita com sucesso"
 *          "carros": [{
 *              "id_carro": "5",
 *              "modelo": "Test",
 *              "descricao": "test",
 *              "id_motorista": "20",
 *              "created_at": "2014-11-14 00:00:00",
 *              "updated_at": "2014-11-14 00:00:00"
 *          },
 *          {
 *              "id_carro": "5",
 *              "modelo": "Test",
 *              "descricao": "test",
 *              "id_motorista": "20",
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
 *       "message": "Erro ao recuperar os carros"
 *     }
 */
$app->get('/', function () use ($app) {
    $response = array();

    $query = Carro::query();
    SortParameters::applySort($query, $app);
    FilterParameters::applyFilter($query, $app);

    try {
        $carros = $query->get();
    } catch (\Illuminate\Database\QueryException $e) {
        // Ignore the exception. It will be handled below
    }

    if (isset($carros)) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Listagem feita com sucesso';
        $response['carros'] = $carros->toArray();
    } else {
        $code = 500;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar os usuarios';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {get} /carro/:id Carro Get
 * @apiName GetCarro
 * @apiGroup Carro
 *
 * @apiParam {String} id The id of the carro
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} carro with the carro object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Carro obtido com sucesso"
 *          "carro": {
 *              "id_carro": "5",
 *              "modelo": "Test",
 *              "descricao": "test",
 *              "id_motorista": "20",
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
 *       "message": "Erro ao recuperar o carro"
 *     }
 */
$app->get('/:id', function ($id) use ($app) {
    $response = array();

    $usuario = Carro::find($id);
    if ($usuario) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Carro obtido com sucesso';
        $response['carro'] = $usuario->toArray();
    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar o carro';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {post} /carro Carro Register
 * @apiName NewCarro
 * @apiGroup Carro
 *
 * @apiParam {String} modelo The modelo of the carro
 * @apiParam {String} descricao The descricao of the carro
 * @apiParam {String} id_motorista The ID of the motorista
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} carro with carro object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 201 Created
 *      {
 *          "error": false,
 *          "message": "Registro feito com sucesso"
 *          "carro": {
 *              "id_carro": "5",
 *              "modelo": "Test",
 *              "descricao": "test",
 *              "id_motorista": "20",
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
 *       "message": "Campo obrigatório modelo, descricao e id_motorista faltando ou vazio"
 *     }
 */
$app->post('/', function () use ($app) {
    $response = array();
    $code = 201;

    // check for required params
    Validators::verifyRequiredParams(array(
        'modelo',
        'descricao',
        'id_motorista',
    ));

    // create a new usuario
    $carro = new \Carro(array(
        'modelo' => $app->request->post('modelo'),
        'descricao' => $app->request->post('descricao'),
        'id_motorista' => $app->request->post('id_motorista'),
    ));

    $res = $carro->save();

    if ($res) {
        $code = 201;
        $response['error'] = false;
        $response['message'] = 'Registro feito com sucesso';
        $response['carro'] = $carro->toArray();
    } elseif (!$res) {
        $code = 500;
        $response['error'] = true;
        $response['message'] = 'Oops! Um erro ocorreu durante o registro';
    }
    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {put} /carro/:id Carro Alter
 * @apiName AlterCarro
 * @apiGroup Carro
 *
 * @apiParam {String} id The id of the carro
 *
 * @apiParam {String} modelo The modelo of the carro
 * @apiParam {String} descricao The descricao of the carro
 * @apiParam {String} id_motorista The ID of the motorista
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} carro with carro object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Registro alterado com sucesso"
 *          "carro": {
 *              "id_carro": "5",
 *              "modelo": "Test",
 *              "descricao": "test",
 *              "id_motorista": 20,
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
 *       "message": "Desculpe, esse carro nao esta no sistema"
 *     }
 */
$app->put('/:id', function ($id) use ($app) {
    $response = array();
    $code = 200;

    $carro = Carro::find($id);

    if ($carro) {
        // check for required params
        Validators::verifyRequiredParams(array(
            'modelo',
            'descricao',
            'id_motorista',
        ));

        // edit carro
        $carro->modelo = $app->request->post('modelo');
        $carro->descricao = $app->request->post('descricao');
        $carro->id_motorista = $app->request->post('id_motorista');

        $res = $carro->save();

        if ($res) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Registro alterado com sucesso';
            $response['usuario'] = $carro->toArray();
        } elseif (!$res) {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Um erro ocorreu durante o registro';
        }

    }
    else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Desculpe, esse carro nao esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {delete} /carro/:id Carro Delete
 * @apiName DeleteCarro
 * @apiGroup Carro
 *
 * @apiParam {String} id The id of the carro
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
 *          "message": "Carro deletado com sucesso"
 *      }
 *
 * @apiError {Boolean} error true when there is an error, and false otherwise.
 * @apiError {String} message An error message explaining the error.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 500 Server Error
 *     {
 *       "error": true,
 *       "message": "Oops! Ocorreu um erro ao tentar remover o carro"
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": true,
 *       "message": "Desculpe, esse carro nao esta no sistema"
 *     }
 */
$app->delete('/:id', function ($id) use ($app) {
    $response = array();

    $carro = Carro::find($id);

    if ($carro) {
        $return = $carro->delete();
        if ($return) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Carro deletado com sucesso';
        } else {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Ocorreu um erro ao tentar remover o carro';
        }


    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Desculpe, esse carro nao esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});