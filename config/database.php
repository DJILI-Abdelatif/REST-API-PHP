<?php 


	/**
	 * 
	 */
	class Database 
	{
		// Database Params
		private $host = "localhsot";
		private $dbname = "restapi";
		private $username = "root";
		private $password = "";
		private $option = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		);

		private $connect;
		
		// Database connect
		public function connect() {
			$this->connect = null;
			try {
				$this->connect = new PDO("mysql: host=". $this->host .";dbname=". $this->dbname ."", 
					$this->username, $this->password, $this->option);
				$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				echo "Faild To Connect :". $e->getMessage();
			}
			return $this->connect;
		}

	}

?>