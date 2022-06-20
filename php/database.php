<?php
class Database{
	private $dbh;
	function __construct(){

		$env = include 'env.php';

		$dsn = "mysql:host=" . $env['host'] . ";dbname=". $env['database'] .";charset=utf8mb4";
		$options = [
			PDO::ATTR_EMULATE_PREPARES   => false,
			PDO::ATTR_EMULATE_PREPARES => true,
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		];

		try {
			$this->dbh = new PDO($dsn, $env['user'],  $env['password'], $options);
		}
		catch(PDOException $e) {
			//header('Content-Type', 'application/json');
			echo json(
				[
					'status' => 'error',
					'data' => null,
					'message' => 'No se pudo establecer conexión, intentelo más tarde.'
				]
			, 500);
			die();
		}
	}


	function Select($q){
		try{
			$sth = $this->dbh->prepare($q);
			$sth->execute();
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$result = $sth->fetchAll();
			//$this->dbh = null;
			$result = json_encode($result);
			$obj = json_decode($result, true);
			return $obj;

		}
		catch(PDOException $e){
			error_log('PDOException - ' . $e->getMessage(), 0);
			http_response_code(500);
			die($e->getMessage());
		}
	}

	function SelectOne($q){
		try{
			$sth = $this->dbh->prepare($q);
			$sth->execute();
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$result = $sth->fetch();
			//$this->dbh = null;
			$result = json_encode($result);
			$obj = json_decode($result, true);
			return $obj;

		}
		catch(PDOException $e){
			error_log('PDOException - ' . $e->getMessage(), 0);
			http_response_code(500);
			die($e->getMessage());
		}
	}

	function SelectNoClose($q){
		try{
			$sth = $this->dbh->prepare($q);
			$sth->execute();
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$result = $sth->fetchAll();
			return $result;
		}
		catch(PDOException $e){
			error_log('PDOException - ' . $e->getMessage(), 0);
			http_response_code(500);
			die($e->getMessage());
		}
	}

	function ExecuteQuery($q, $parametros){
		try	{
			$sth = $this->dbh->prepare($q);
			$sth->execute($parametros);
			return $sth->rowCount() > 0;
			/*if($sth->rowCount() > 0)
			{
				return true;
			}
			else 
			{
				return false;
			}*/
			//$this->dbh = null;
		}
		catch(PDOException $e){
			
			error_log('PDOException - ' . $e->getMessage(), 0);
			http_response_code(500);
			if ($e->errorInfo[1] == 1062) {
				echo json_encode(["status" => "error", "error" => $e->getMessage(), "type"=>"duplicate"]);
				die();
			} else {
				throw $e;
			}
			return false;
		
		}
	}

	function lastInsertId()
	{
		$id = $this->dbh->lastInsertId();
		return $id;
	}


	function existsData($table, $column, $value, $differentTo = null){

		try{
		
			if($differentTo){
				$sth = $this->dbh->prepare("SELECT * FROM " . $table . " WHERE " . $column . " = " . " '$value' and id != '$differentTo' ");

			}
			else{
				$sth = $this->dbh->prepare("SELECT * FROM " . $table . " WHERE " . $column . " = " . " '$value' ");
			}
			$sth->execute();
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$count= count($sth->fetchAll());
			return $count > 0;
			
		}
		catch(PDOException $e){
			error_log('PDOException - ' . $e->getMessage(), 0);
			http_response_code(500);
			die($e->getMessage());
		}
	}
}
?>
