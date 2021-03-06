<?php

class Validators
{
    /**
     * Verifying required params posted or not
     */
    public static function verifyRequiredParams($required_fields)
    {
        $error = false;
        $error_fields = "";
        $request_params = array();
        $request_params = $_REQUEST;
        // Handling PUT request params
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $app = \Slim\Slim::getInstance();
            parse_str($app->request()->getBody(), $request_params);
        }
        foreach ($required_fields as $field) {
            if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
                $error = true;
                $error_fields .= $field . ', ';
            }
        }

        if ($error) {
            // Required field(s) are missing or empty
            // echo error json and stop the app
            $response = array();
            $app = \Slim\Slim::getInstance();
            $response['error'] = true;
            $response['message'] = 'Campo obrigat�rio' . substr($error_fields, 0, -2) . ' faltando ou vazio';
            Response::echoResponse(400, $response);
            $app->stop();
        }
    }

    /**
     * Validating email address
     */
    public static function validateEmail($email)
    {
        $app = \Slim\Slim::getInstance();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['error'] = true;
            $response['message'] = 'Endere�o de e-mail inv�lido';
            Response::echoResponse(400, $response);
            $app->stop();
        }
    }

    public static function validateRole($role)
    {
        $app = \Slim\Slim::getInstance();
        if (!filter_var($role, FILTER_VALIDATE_BOOLEAN) === NULL) {
            $response['error'] = true;
            $response['message'] = 'Função de usuário inválida';
            Response::echoResponse(400, $response);
            $app->stop();
        }
    }
} 
