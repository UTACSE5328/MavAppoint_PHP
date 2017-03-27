<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 0:20
 */
//include_once dirname(dirname(__FILE__))."/login/AdvisorUser.php";

use Models\Login as login;
class CreateAdvisor extends SQLCmd{
    private $advisorUser;

    function __construct(login\AdvisorUser $advisorUser) {
        $this->advisorUser = $advisorUser;
    }

    function queryDB(){
        $userId = $this->advisorUser->getUserId();
        $pName = $this->advisorUser->getPName();
        $notification = $this->advisorUser->getNotification();
        $name_low = $this->advisorUser->getNameLow();
        $name_high = $this->advisorUser->getNameHigh();
        $degree_type = $this->advisorUser->getDegType();
        $department = $this->advisorUser->getDepartments();
        $major = $this->advisorUser->getMajors();

        $query = "INSERT INTO User_Advisor (userid,pname,notification,name_low,name_high,degree_types, cutOffTime) 
                    values('$userId','$pName','$notification','$name_low','$name_high','$degree_type','0')";

        $this->result = $this->conn->query($query);

        $query = "INSERT INTO department_user (name, userId) values ('$pName','$department')";

        $this->result = $this->result && $this->conn->query($query);

        $query = "INSERT INTO major_user (name, userId) values ('$pName','$major')";

        $this->result = $this->result && $this->conn->query($query);
    }

    function processResult(){
        return $this->result;
    }
}