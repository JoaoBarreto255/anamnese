<?php 
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/anamnese.php';

$db = new Database();
$anamn = new Anamnese($db->getConnection());

$data = file_get_contents("php://input");


if ($anamn->fromRaw($data)){
	if ($anamn->create()) {
		echo json_encode(
			array("mensagem" => "Anamnese cadastrado com sucesso!"), 
			JSON_PRETTY_PRINT
		);
		//Sucesso ao criar.
		http_response_code(201);
	}else{
		echo json_encode(
			array("mensagem" => "Serviço indisponível!"),
			JSON_PRETTY_PRINT
		);
		http_response_code(503);
	}
}else{
	echo json_encode(
		array("mensagem" => "Entrada incompleta!"),
		JSON_PRETTY_PRINT
	);
	// Bad Request: continua
	http_response_code(400);
}
?>