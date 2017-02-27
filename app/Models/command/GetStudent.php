<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 7:15
 */
class GetStudent extends SQLCmd {
	private $email;

	function __construct($email) {
		$this->email = $email;
	}

	function queryDB() {
		$cmd = new GetUserIdByEmail($this->email);
		$id  = $cmd->execute();

		$query = "SELECT User_Student.student_id,User_Student.degree_type,User_Student.phone_num,User_Student.last_name_initial,
                      User_Student.notification,password,validated
                      FROM User,User_Student
                      WHERE USER.userId='$id' and User_Student.userId='$id'";

		$this->result = $this->conn->query($query)->fetch_assoc();
	}

	function processResult() {
		return $this->result;
	}
}