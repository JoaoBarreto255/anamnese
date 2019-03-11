<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/anamnese.php';

$db = new Database();
$conn = $db->getConnection();

$anamn = new Anamnese($conn);
$result = $anamn->read();

if($result){
	echo json_encode(
		$result,
		JSON_PRETTY_PRINT
	);
	http_response_code(200);
}else{
	echo json_encode(
		array('mensagem' => "Nenhuma Anamnese listada!"), 
		JSON_PRETTY_PRINT
	);
	http_response_code(404);
}
?>