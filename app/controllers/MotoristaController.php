<?php

/**
 * @api {get} /motorista Motorista List
 * @apiName GetMotoristas
 * @apiGroup Motorista
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
 * @apiSuccess {Array} motoristas with a list of motoristas object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Listagem feita com sucesso"
 *          "motoristas": [{
 *              "id_motorista": "5",
 *              "numero_habilitacao": "123445671234",
 *              "data_habilitacao": "2014-11-14 00:00:00",
 *              "created_at": "2014-11-14 00:00:00",
 *              "updated_at": "2014-11-14 00:00:00"
 *          },
 *          {
 *              "id_motorista": "5",
 *              "numero_habilitacao": "123445671234",
 *              "data_habilitacao": "2014-11-14 00:00:00",
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
 *       "message": "Erro ao recuperar os motoristas"
 *     }
 */
$app->get('/', function () use ($app) {
    $response = array();

    $query = Motorista::query();
    SortParameters::applySort($query, $app);
    FilterParameters::applyFilter($query, $app);

    try {
        $motoristas = $query->get();
    } catch (\Illuminate\Database\QueryException $e) {
        // Ignore the exception. It will be handled below
    }

    if (isset($motoristas)) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Listagem feita com sucesso';
        $response['motoristas'] = $motoristas->toArray();
    } else {
        $code = 500;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar os motoristas';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {get} /motorista/:id Motorista Get
 * @apiName GetMotorista
 * @apiGroup Motorista
 *
 * @apiParam {String} id The id of the motorista
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} motorista with the motorista object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Motorista obtido com sucesso"
 *          "motorista": {
 *              "id_motorista": "5",
 *              "numero_habilitacao": "123445671234",
 *              "data_habilitacao": "2014-11-14 00:00:00",
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
 *       "message": "Erro ao recuperar o motorista"
 *     }
 */
$app->get('/:id', function ($id) use ($app) {
    $response = array();

    $motorista = Motorista::find($id);
    if ($motorista) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Motorista obtido com sucesso';
        $response['motorista'] = $motorista->toArray();
    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar o motorista';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {post} /motorista Motorista Register
 * @apiName NewMotorista
 * @apiGroup Motorista
 *
 * @apiParam {String} id_usuario The id of the usuario
 * @apiParam {String} numero_habilitacao The numero de hatilitação of the motorista
 * @apiParam {String} data_habilitacao The data de habilitacao of the motorista
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} motorista with motorista object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 201 Created
 *      {
 *          "error": false,
 *          "message": "Registro feito com sucesso"
 *          "motorista": {
 *              "id_motorista": "5",
 *              "numero_habilitacao": "123445671234",
 *              "data_habilitacao": "2014-11-14 00:00:00",
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
 *       "message": "Campo obrigatório id_usuario, numero_habilitacao, data_habilitacao faltando ou vazio"
 *     }
 */
$app->post('/', function () use ($app) {
    $response = array();
    $code = 201;

    // check for required params
    Validators::verifyRequiredParams(array(
        'id_usuario',
        'numero_habilitacao',
        'data_habilitacao',
    ));

    // create a new motorista
    $motorista = new \Motorista(array(
        'id_usuario' => $app->request->post('id_usuario'),
        'numero_habilitacao' => $app->request->post('numero_habilitacao'),
        'data_habilitacao' => $app->request->post('data_habilitacao'),
    ));

    $res = $motorista->save();

    if ($res) {
        $code = 201;
        $response['error'] = false;
        $response['message'] = 'Registro feito com sucesso';
        $response['motorista'] = $motorista->toArray();
    } elseif (!$res) {
        $code = 500;
        $response['error'] = true;
        $response['message'] = 'Oops! Um erro ocorreu durante o registro';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {put} /motorista/:id Motorista Alter
 * @apiName AlterMotorista
 * @apiGroup Motorista
 *
 * @apiParam {String} id The id of the motorista
 *
 * @apiParam {String} id_usuario The id of the usuario
 * @apiParam {String} numero_habilitacao The numero de hatilitação of the motorista
 * @apiParam {String} data_habilitacao The data de habilitacao of the motorista
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} motorista with motorista object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Registro alterado com sucesso"
 *          "motorista": {
 *              "id_motorista": "5",
 *              "id_usuario": "5",
 *              "numero_habilitacao": "123445671234",
 *              "data_habilitacao": "2014-11-14 00:00:00",
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
 *       "message": "Desculpe, esse motorista nao esta no sistema"
 *     }
 */
$app->put('/:id', function ($id) use ($app) {
    $response = array();
    $code = 200;

    $motorista = Motorista::find($id);

    if ($motorista) {
        // check for required params
        Validators::verifyRequiredParams(array(
            'id_usuario',
            'numero_habilitacao',
            'data_habilitacao',
        ));

        // edit motorista
        $motorista->id_usuario = $app->request->post('id_usuario');
        $motorista->numero_habilitacao = $app->request->post('numero_habilitacao');
        $motorista->data_habilitacao = $app->request->post('data_habilitacao');

        $res = $motorista->save();

        if ($res) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Registro alterado com sucesso';
            $response['motorista'] = $motorista->toArray();
        } elseif (!$res) {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Um erro ocorreu durante o registro';
        }

    }
    else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Desculpe, esse motorista nao esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {delete} /motorista/:id Motorista Delete
 * @apiName DeleteMotorista
 * @apiGroup Motorista
 *
 * @apiParam {String} id The id of the motorista
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
 *          "message": "Motorista deletado com sucesso"
 *      }
 *
 * @apiError {Boolean} error true when there is an error, and false otherwise.
 * @apiError {String} message An error message explaining the error.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 500 Server Error
 *     {
 *       "error": true,
 *       "message": "Oops! Ocorreu um erro ao tentar remover o motorista"
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": true,
 *       "message": "Desculpe, esse motorista nao esta no sistema"
 *     }
 */
$app->delete('/:id', function ($id) use ($app) {
    $response = array();

    $motorista = Motorista::find($id);

    if ($motorista) {
        $return = $motorista->delete();
        if ($return) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Motorista deletado com sucesso';
        } else {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Ocorreu um erro ao tentar remover o motorista';
        }


    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Desculpe, esse motorista nao esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});