<?php


class Database
{
	private $host="localhost";
	private $dbuser="root";
	private $dbpass="";
	private $dbname="carparking";
	public $pdo;
	public function __construct()
	{
		if (!isset($this->pdo)) {
			try{
				$link=new pdo("mysql:host=".$this->host.";dbname=".$this->dbname,$this->dbuser
					,$this->dbpass);
				$link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$link->exec("SET CHARACTER SET utf8");
				$this->pdo=$link;

			}
			catch(PDOException $e){
				die("Failed to connect with database".$e->getMessage());

			}
		}
	}
}

?>