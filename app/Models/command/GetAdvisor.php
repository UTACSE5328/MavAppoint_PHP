<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/13
 * Time: 17:06
 */
//include_once dirname(dirname(__FILE__))."/login/AdvisorUser.php";
//include_once dirname(dirname(__FILE__))."/command/GetUserIdByEmail.php";

class GetAdvisor extends SQLCmd {
	private $email;

	function __construct($email) {
		$this->email = $email;
	}

	function queryDB() {
		$cmd = new GetUserIdByEmail($this->email);
		$id  = $cmd->execute();

		$query = "SELECT password,validated,pName,name_low,name_high,degree_types,Department_User.name,Major_User.name,cutOffTime
                      FROM User,User_Advisor,Department_User,Major_User
                      WHERE USER.userId='$id' and User_Advisor.userId='$id' and Department_User.userId='$id' and Major_User.userId='$id'";

		$this->result = $this->conn->query($query)->fetch_assoc();
	}

	function processResult() {
		return $this->result;
	}
}