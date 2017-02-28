<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/13
 * Time: 3:54
 */

abstract class SQLCmd {

	/**
	 * @var \mysqli
	 */
	public $conn;
	public $result;

	function execute() {
		try {
			$this->connectDB();
			$this->queryDB();
			$this->result = $this->processResult();
			$this->disconnect();
		} catch (\Exception $e) {
			$this->disconnect();
		}

		return $this->result;
	}

	function connectDB() {
		$this->conn = new \mysqli(
			env("DB_HOST"),
			env("DB_USERNAME"),
			env("DB_PASSWORD"),
			env("DB_DATABASE"));
	}

	abstract function queryDB();

	abstract function processResult();

	function disconnect() {
		$this->conn->close();
	}
}