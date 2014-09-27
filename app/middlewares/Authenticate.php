<?php

/**
 * Adding Middle Layer to authenticate every request
 * Checking if the request has valid api key in the 'Authorization' header
 */
class Authenticate {
    public function call(\Slim\Route $route) {
        // Getting request headers
        $response = array();
        $app = \Slim\Slim::getInstance();
        $headers = $app->request->headers();

        // Verifying Authorization Header
        if (isset($headers['Authorization'])) {
            $userModel = new User();

            // get the api key
            $api_key = $headers['Authorization'];
            // validating api key
            if (!$userModel->isValidApiKey($api_key)) {
                // api key is not present in users table
                $response['error'] = true;
                $response['message'] = "Access Denied. Invalid Api key";
                Response::echoRespnse(401, $response);
                $app->stop();
            } else {
                global $user_id;
                // get user primary key id
                $user_id = $userModel->getUserId($api_key);
            }
        } else {
            // api key is missing in header
            $response['error'] = true;
            $response['message'] = "Api key is misssing";
            Response::echoRespnse(400, $response);
            $app->stop();
        }
    }
}