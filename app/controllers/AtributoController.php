<?php

/**
 * @api {get} /atributo Atributo List
 * @apiName GetAtributos
 * @apiGroup Atributo
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
 * @apiSuccess {Array} atributos with a list of atributos object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Listagem feita com sucesso"
 *          "atributos": [{
 *              "id_atributo": "5",
 *              "nome": "test",
 *              "created_at": "2014-11-14 00:00:00",
 *              "updated_at": "2014-11-14 00:00:00"
 *          },
 *          {
 *              "id_atributo": "5",
 *              "nome": "test",
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
 *       "message": "Erro ao recuperar os atributos"
 *     }
 */
$app->get('/', function () use ($app) {
    $response = array();

    $query = Atributo::query();
    SortParameters::applySort($query, $app);
    FilterParameters::applyFilter($query, $app);

    try {
        $atributos = $query->get();
    } catch (\Illuminate\Database\QueryException $e) {
        // Ignore the exception. It will be handled below
    }

    if (isset($atributos)) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Listagem feita com sucesso';
        $response['atributos'] = $atributos->toArray();
    } else {
        $code = 500;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar os atributos';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {get} /atributo/:id Atributo Get
 * @apiName GetAtributo
 * @apiGroup Atributo
 *
 * @apiParam {String} id The id of the atributo
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} atributo with the atributo object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Atributo obtido com sucesso"
 *          "atributo": {
 *              "id_atributo": "5",
 *              "nome": "test",
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
 *       "message": "Erro ao recuperar o atributo"
 *     }
 */
$app->get('/:id', function ($id) use ($app) {
    $response = array();

    $atributo = Atributo::find($id);
    if ($atributo) {
        $code = 200;
        $response['error'] = false;
        $response['message'] = 'Atributo obtido com sucesso';
        $response['atributo'] = $atributo->toArray();
    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Erro ao recuperar o atributo';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {post} /atributo Atributo Register
 * @apiName NewAtributo
 * @apiGroup Atributo
 *
 * @apiParam {String} nome The nome of the atributo
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} atributo with atributo object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 201 Created
 *      {
 *          "error": false,
 *          "message": "Registro feito com sucesso"
 *          "atributo": {
 *              "id_atributo": "5",
 *              "nome": "test",
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
 *       "message": "Campo obrigatório nome faltando ou vazio"
 *     }
 */
$app->post('/', function () use ($app) {
    $response = array();
    $code = 201;

    // check for required params
    Validators::verifyRequiredParams(array(
        'nome',
    ));

    // create a new atributo
    $atributo = new \Atributo(array(
        'nome' => $app->request->post('nome'),
    ));

    $res = $atributo->save();

    if ($res) {
        $code = 201;
        $response['error'] = false;
        $response['message'] = 'Registro feito com sucesso';
        $response['atributo'] = $atributo->toArray();
    } elseif (!$res) {
        $code = 500;
        $response['error'] = true;
        $response['message'] = 'Oops! Um erro ocorreu durante o registro';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {put} /atributo/:id Atributo Alter
 * @apiName AlterAtributo
 * @apiGroup Atributo
 *
 * @apiParam {String} id The id of the atributo
 *
 * @apiParam {String} nome The nome of the atributo
 *
 * @apiHeader {String} X-Auth-Token Authorization key
 *
 * @apiHeaderExample Header-Example:
 *      "X-Auth-Token": "77ff482feb2f76e6f0d1d393945b0892"
 *
 * @apiSuccess {Boolean} error true when there is an error, and false otherwise.
 * @apiSuccess {String} message An success message explaining the result.
 * @apiSuccess {Array} atributo with atributo object.
 *
 * @apiSuccessExample Success-Response:
 *      HTTP/1.1 200 OK
 *      {
 *          "error": false,
 *          "message": "Registro alterado com sucesso"
 *          "atributo": {
 *              "id_atributo": "5",
 *              "nome": "test",
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
 *       "message": "Desculpe, esse atributo nao esta no sistema"
 *     }
 */
$app->put('/:id', array(new Authenticate(), 'call'), function ($id) use ($app) {
    $response = array();
    $code = 200;

    $atributo = Atributo::find($id);

    if ($atributo) {
        // check for required params
        Validators::verifyRequiredParams(array(
            'nome',
        ));

        // edit atributo
        $atributo->nome = $app->request->post('nome');

        $res = $atributo->save();

        if ($res) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Registro alterado com sucesso';
            $response['atributo'] = $atributo->toArray();
        } elseif (!$res) {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Um erro ocorreu durante o registro';
        }
    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Desculpe, esse atributo nao esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});

/**
 * @api {delete} /atributo/:id Atributo Delete
 * @apiName DeleteAtributo
 * @apiGroup Atributo
 *
 * @apiParam {String} id The id of the atributo
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
 *          "message": "Atributo deletado com sucesso"
 *      }
 *
 * @apiError {Boolean} error true when there is an error, and false otherwise.
 * @apiError {String} message An error message explaining the error.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 500 Server Error
 *     {
 *       "error": true,
 *       "message": "Oops! Ocorreu um erro ao tentar remover o atributo"
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": true,
 *       "message": "Desculpe, esse atributo nao esta no sistema"
 *     }
 */
$app->delete('/:id', array(new Authenticate(), 'call'), function ($id) use ($app) {
    $response = array();

    $atributo = Atributo::find($id);

    if ($atributo) {
        $return = $atributo->delete();
        if ($return) {
            $code = 200;
            $response['error'] = false;
            $response['message'] = 'Atributo deletado com sucesso';
        } else {
            $code = 500;
            $response['error'] = true;
            $response['message'] = 'Oops! Ocorreu um erro ao tentar remover o atributo';
        }
    } else {
        $code = 404;
        $response['error'] = true;
        $response['message'] = 'Desculpe, esse atributo nao esta no sistema';
    }

    // echo json response
    Response::echoResponse($code, $response);
});