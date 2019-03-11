<?php 
class Database {
	private $host = "127.0.0.1";
	private $name = "anamneses";
	private $user = "root";
	private $pass = "";
	public $conn;

	function getConnection(){
		$this->conn = null;
		try{
			$this->conn = new PDO("mysql:host={$this->host};dbname={$this->name}",$this->user,$this->pass);
		}catch(PDOException $e){
			echo "Connection Error ".$e->getMessage();
		}

		return  $this->conn;
	}
}
?>