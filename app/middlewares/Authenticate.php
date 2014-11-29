<?php

/**
 * Adding Middle Layer to authenticate every request
 * Checking if the request has valid api key in the 'Authorization' header
 */
class Authenticate
{
    public function call(\Slim\Route $route)
    {
        // Getting request headers
        $response = array();
        $app = \Slim\Slim::getInstance();
        $headers = $app->request->headers();

        // Verifying Authorization Header
        if (isset($headers['X-Auth-Token'])) {
            // get the api key
            $key = $headers['X-Auth-Token'];

            $session = Session::where('key', '=', $key)->first();
            // validating api key
            if (!$session) {
                // api key is not present in users table
                $response['error'] = true;
                $response['message'] = 'Access Denied. Invalid key';
                Response::echoResponse(401, $response);
                $app->stop();
            } else {
                global $user_id;

                $session->save();

                // get user primary key id
                $user_id = $session->usuario->id_usuario;
            }
        } else {
            // api key is missing in header
            $response['error'] = true;
            $response['message'] = 'Key is missing';
            Response::echoResponse(400, $response);
            $app->stop();
        }
    }
}