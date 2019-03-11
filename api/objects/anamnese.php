<?php

class Anamnese{
	private $conn;

	public $id = null;
	public $anamnese = null;
	public $resposta = null;

	function __construct($connection){
		$this->conn = $connection;
	}
	/**
	* Trata os caracteres provindos da entrada.
	*/
	function sanitizeData(){
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->anamnese = htmlspecialchars(strip_tags($this->anamnese));
		$this->resposta = htmlspecialchars(strip_tags($this->resposta));
	}

	function fromRaw($data){
		$d = json_decode($data);
		$this->id = isset($d->id)?$d->id:null;
		$this->anamnese = isset($d->anamnese)?$d->anamnese:null;
		$this->resposta = isset($d->resposta)?$d->resposta:null;
		return !is_null($this->id) || 
			   (!is_null($this->anamnese) && 
			   	!is_null($this->resposta));
	}

	function read(){
		$query = "SELECT * FROM anamneses";

		$stmt = $this->conn->prepare($query);

		$stmt->execute();

		$result = array();

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($result, $row);
		}
		return $result;
	}

	function create(){
		$this->sanitizeData();

		$query = "INSERT INTO anamneses (anamnese, resposta)
					VALUES (:anam,:resposta)";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(":anam", $this->anamnese);
		$stmt->bindParam(":resposta", $this->resposta);
		return $stmt->execute();
	}

	function update(){
		$this->sanitizeData();
		$query = "UPDATE anamneses 
					SET anamnese=:anam, resposta=:resp 
					WHERE id=:id";

		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(":anam", $this->anamnese);
		$stmt->bindParam(":resp", $this->resposta);
		$stmt->bindParam(":id", $this->id);

		return $stmt->execute();
	}

	function delete(){
		$this->sanitizeData();

		$query = "DELETE FROM anamneses WHERE id=:id";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":id", $this->id);

		return $stmt->execute();
	}

	function readOne(){
		$this->sanitizeData();

		$query = "SELECT * FROM anamneses WHERE id=:id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam("id",$this->id);

		return $stmt->execute();
	}

	function checkExists(){
		$this->sanitizeData();

		$query = "SELECT * FROM anamneses WHERE id=:id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(":id",$this->id);
		$stmt->execute();

		return $stmt->rowCount();
	}

}


?>