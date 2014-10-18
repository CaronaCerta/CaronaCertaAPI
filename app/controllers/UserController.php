<?php

/**
 * ----------- METHODS WITHOUT AUTHENTICATION ---------------------------------
 */
/**
 * User Registration
 * url - /register
 * method - POST
 * params - name, email, password
 */
$app->post('/register', function () use ($app) {
    // check for required params
    Validators::verifyRequiredParams(array('name', 'email', 'password'));

    $response = array();

    // reading post params
    $name = $app->request->post('name');
    $email = $app->request->post('email');
    $password = $app->request->post('password');

    // validating email address
    Validators::validateEmail($email);

    $userModel = new User();
    $res = $userModel->createUser($name, $email, $password);

    if ($res == USER_CREATED_SUCCESSFULLY) {
        $response["error"] = false;
        $response["message"] = "Registro feito com sucesso";
    } else if ($res == USER_CREATE_FAILED) {
        $response["error"] = true;
        $response["message"] = "Oops! Um erro ocorreu durante o registro";
    } else if ($res == USER_ALREADY_EXISTS) {
        $response["error"] = true;
        $response["message"] = "Desculpe, esse e-mail já esta no sistema";
    }
    // echo json response
    Response::echoRespnse(201, $response);
});

/**
 * User Login
 * url - /login
 * method - POST
 * params - email, password
 */
$app->post('/login', function () use ($app) {
    // check for required params
    Validators::verifyRequiredParams(array('email', 'password'));

    // reading post params
    $email = $app->request()->post('email');
    $password = $app->request()->post('password');
    $response = array();

    $userModel = new User();
    // check for correct email and password
    if ($userModel->checkLogin($email, $password)) {
        // get the user by email
        $user = $userModel->getUserByEmail($email);

        if ($user != NULL) {
            $response["error"] = false;
            $response['name'] = $user['name'];
            $response['email'] = $user['email'];
        } else {
            // unknown error occurred
            $response['error'] = true;
            $response['message'] = "Um erro ocorreu, por favor tente novamente.";
        }
    } else {
        // user credentials are wrong
        $response['error'] = true;
        $response['message'] = 'Login falhou. Credenciais incorretas';
    }

    Response::echoRespnse(200, $response);
});