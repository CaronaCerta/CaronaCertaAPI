<?php

$app->post('/submit', function () use ($app) {
	// check for required params
	Validators::verifyRequiredParams(array('userId', 'password', 'otherUserId', 'otherUserFunction', 'caracteristica', 'rating'));
	
	// reading post params
	$email = $app->request()->post('userId');
	$password = $app->request()->post('password');
	$otherUserId = $app->request()->post('otherUserId');
	$otherUserFunction = $app->request()->post('otherUserFunction');
	$caracteristica = $app->request()->post('caracteristica');
	$rating = $app->request()->post('rating');
	
	Validators::validateEmail($email);
	Validators::validateFunction($otherUserFunction);
	
	$userModel = new User();
	// check for correct email and password
	if ($userModel->checkLogin($email, $password)) {
		
		$avaliacao = new Avaliacao();
		$res = $avaliacao->createAvaliacao($email, $otherUserId, $otherUserFunction, $caracteristica, $rating);
		
		if ($res == AVAL_CREATED_SUCCESSFULLY) {
			$response["error"] = false;
			$response["message"] = "Avaliacao feita com sucesso";
		} else if ($res == USER_CREATE_FAILED) {
			$response["error"] = true;
			$response["message"] = "Oops! Um erro ocorreu durante o registro";
		} 
	} else {
		// user credentials are wrong
		$response['error'] = true;
		$response['message'] = 'Bad Credentials';
	}
	
	// echo json response
	Response::echoRespnse(201, $response);
		
}