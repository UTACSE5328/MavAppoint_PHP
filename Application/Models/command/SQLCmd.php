<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/13
 * Time: 3:54
 */

abstract class SQLCmd {
	public $conn;
	public $result;

	function execute() {
		try {
			$this->connectDB();
			$this->queryDB();
			$this->result = $this->processResult();
			$this->disconnect();
		} catch (Exception $e) {
			$this->disconnect();
		}

		return $this->result;
	}

	function connectDB() {
		$this->conn = new mysqli(
			"localhost",
			"CSE5328Spring16",
			"er1ja@18xs@3",
			"mavappointdb2s");
		//mysqli_select_db($this->conn, "mavappointdb2s");
	}

	abstract function queryDB();

	abstract function processResult();

	function disconnect() {
		$this->conn->close();
	}
}