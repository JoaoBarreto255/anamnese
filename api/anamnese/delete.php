<?php 
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/anamnese.php';

$db = new Database();
$anamn = new Anamnese($db->getConnection());

$data = file_get_contents("php://input");

$anamn->fromRaw($data);
if($anamn->delete()){
	echo json_encode(
		array('mensagem' => "Anamnese removida com sucesso!"),
		JSON_PRETTY_PRINT
	);
	http_response_code(200);
}elseif ($anamn->checkExists()) {
	echo json_encode(
		array('mensagem' => "Erro no servidor: Serviço indisponível!"),
		JSON_PRETTY_PRINT
	);
	http_response_code(503);
}else{
	echo json_encode(
		array('mensagem' => "Erro: Anamnese não existe!"),
		JSON_PRETTY_PRINT
	);
	http_response_code(404);
}
?>