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

		$query = "SELECT User_Student.student_id,User_Student.degree_type,User_Student.phone_num,User_Student.last_name_initial,
                      User_Student.notification,password,validated
                      FROM User,User_Student
                      WHERE USER.userId='$id' and User_Student.userId='$id'";

		$this->result = $this->conn->query($query)->fetch_assoc();
	}

	function processResult() {
	    $set = new StudentUser();
	    $set->setStudentId($this->result["student_id"]);
        $set->setDegType($this->result["degree_type"]);
        $set->setPhoneNumber($this->result["phone_num"]);
        $set->setLastNameInitial($this->result["last_name_initial"]);
        $set->setNotification($this->result["notification"]);
        $set->setPassword($this->result["password"]);
        $set->setValidated($this->result["validated"]);

		return ($set);
	}
}