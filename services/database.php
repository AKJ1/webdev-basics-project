<?php

namespace Services;
class Database
{
	private static $db = null;
	
	function __construct()
	{
		$host = DB_HOST;
		$username = DB_USERNAME;
		$password = DB_PASSWORD;
		$databse = DB_DATABASE;

		$this->db = new \mysqli($host,$username,$password,$database);
	}

	public function get_instance(){
		static $instance = null;

		if (null === $instance) {
			$instance = new static();
		}
		return $instance;
	}

	public function get_db(){
		return this::$db;
	}
}
?>