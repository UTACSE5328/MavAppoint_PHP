<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/13
 * Time: 22:12
 */
include_once dirname(dirname(__FILE__))."/login/LoginUser.php";
include_once dirname(dirname(__FILE__))."/command/GetUserIdByEmail.php";

class CreateUser extends SQLCmd {
	private $user;

	function __construct(LoginUser $user) {
		$this->user = $user;
	}

	function queryDB() {
		$email    = $this->user->getEmail();
		$password = $this->user->getPassword();
		$role     = $this->user->getRole();

		$query = "INSERT INTO user (email,password,role) values('$email','$password','$role')";
		$res   = $this->conn->query($query);

		if ($res == true) {
			$this->result = true;
			$cmd          = new GetUserIdByEmail($email);
			$id           = ($cmd->execute());

			$majors = $this->user->getMajors();
			$num    = count($majors);
			for ($i = 0; $i < $num; ++$i) {
				$major = $majors[$i];
				$query = "INSERT INTO major_user (name, userId) VALUE ('$major','$id')";
				$this->conn->query($query);
			}

			$departments = $this->user->getDepartments();
			$num         = count($departments);
			for ($i = 0; $i < $num; ++$i) {
				$dep   = $departments[$i];
				$query = "INSERT INTO department_user (name, userId) VALUES ('$dep','$id')";
				$this->conn->query($query);
			}
		} else {

			$this->result = false;
		}
	}

	function processResult() {
		return $this->result;
	}
}