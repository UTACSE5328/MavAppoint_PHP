<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 7:15
 */
use Models\login\StudentUser;

class GetStudent extends SQLCmd {
	private $email;

	function __construct($email) {
		$this->email = $email;
	}

	function queryDB() {
		$cmd = new GetUserIdByEmail($this->email);
		$id  = $cmd->execute();

		$query = "SELECT User.*,User_Student.*
                      FROM User,User_Student
                      WHERE USER.userId='$id' and User_Student.userId='$id'";

		$this->result = $this->conn->query($query)->fetch_assoc();
	}

	function processResult() {
	    $set = new StudentUser();
	    $set->setEmail($this->result["email"]);
        $set->setPassword($this->result["password"]);
        $set->setValidated($this->result["validated"]);
        $set->setRole($this->result["role"]);

	    $set->setUserId($this->result["userId"]);
	    $set->setStudentId($this->result["student_Id"]);
        $set->setDegType($this->result["degree_type"]);
        $set->setPhoneNumber($this->result["phone_num"]);
        $set->setLastNameInitial($this->result["last_name_initial"]);
        $set->setNotification($this->result["notification"]);
        $set->setPassword($this->result["password"]);
        $set->setValidated($this->result["validated"]);

		return ($set);
	}
}