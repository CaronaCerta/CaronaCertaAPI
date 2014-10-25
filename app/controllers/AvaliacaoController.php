<?php

use Swagger\Annotations as SWG;

$app->post('/submit', function () use ($app) {
	// check for required params
	Validators::verifyRequiredParams(array(
		'id_carona',
		'id_usuario_avaliador', 
		'senha', 
		'id_usuario_avaliado', 
		'papel', 
		'id_atributo', 
		'nota'
	));


	Validators::validateEmail($email);
	Validators::validateFunction($role);
	
	// create a new avaliacao
	$avaliacao = new \Avaliacao(array(
			'id_carona' => $app->request->post('id_carona'),
			'id_usuario_avaliador' => $app->request->post('id_usuario_avaliador'),
			'senha' => $app->request->post('senha'),
			'id_usuario_avaliado' => $app->request->post('id_usuario_avaliado'),
			'papel' => $app->request->post('papel'),
			'id_atributo' => $app->request->post('id_atributo'),
			'nota' => $app->request->post('nota')
	));
	
	$userModel = new Usuario();
	// TODO: check if user session is active
	if (1==1) {
		
		// verifying if both user exists
		$usuario_avaliador_count = Usuario::where('email', '=', $avaliacao->id_usuario_avaliador)->count();
		$usuario_avaliado_count = Usuario::where('email', '=', $avaliacao->id_usuario_avaliado)->count();
		if ($usuario_avaliador_count == 1 && $usuario_avaliado_count == 1){
			$res = $avaliacao->save();
			
			if ($res) {
				$code = 201;
				$response['error'] = false;
				$response['message'] = 'Avaliação feita com sucesso';
			} elseif (!$res) {
				$code = 200;
				$response['error'] = true;
				$response['message'] = 'Oops! Avaliação não registrada';
			}
		}
		else{
			$response["error"] = true;
			$response["message"] = "Oops! Avalição de usuário inválida";
		}
	} else {
		// user credentials are wrong
		$response['error'] = true;
		$response['message'] = 'Bad Credentials';
	}
	
	// echo json response
	Response::echoResponse($code, $response);
		
});