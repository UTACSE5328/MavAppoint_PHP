<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/13
 * Time: 22:12
 */
namespace Models\Command;
use Models\Login as login;

class CreateUser extends SQLCmd {
	private $user;

	function __construct(login\LoginUser $user) {
		$this->user = $user;
	}

	function queryDB() {
		$email    = $this->user->getEmail();
		$password = md5($this->user->getPassword());
		$role     = $this->user->getRole();

		$query = "INSERT INTO user (email,password,role) values('$email','$password','$role')";
		$res   = $this->conn->query($query);




		if ($res == true) {
			$cmd          = new GetUserIdByEmail($email);
			$id           = ($cmd->execute());


			$majors = $this->user->getMajors();


            $query = "INSERT INTO major_user (name, userId) VALUE ('$majors','$id')";
            $this->conn->query($query);

			$departments = $this->user->getDepartments();
            $query = "INSERT INTO department_user (name, userId) VALUES ('$departments','$id')";
            $this->conn->query($query);

            $this->result = $id;

		}
	}

	function processResult() {
		return $this->result;
	}
}