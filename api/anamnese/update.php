<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/anamnese.php';

$data = file_get_contents("php://input");

$db = new Database();
$anamn = new Anamnese($db->getConnection());

$anamn->fromRaw($data);

if($anamn->update()){
	echo json_encode(
		array("mensagem" => "Atualização bem sucedida!"),
		JSON_PRETTY_PRINT
	);
	http_response_code(200);
}else{
	$msg = "Anamnese não existe!";
	$code = 404;
	if($anamn->checkExists()){
		$msg = "Error no servidor!";
		$code = 503;
	}
	echo json_encode(
		array('mensagem' => "Erro durante a Atualização: ".$msg),
		JSON_PRETTY_PRINT
	);
	http_response_code($code);
}
?>