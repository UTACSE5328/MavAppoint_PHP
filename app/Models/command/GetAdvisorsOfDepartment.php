<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 16:09
 */
use Models\Login\AdvisorUser;

class GetAdvisorsOfDepartment extends SQLCmd{
    private $dep;

    function __construct($dep) {
        $this->dep = $dep;
    }

    function queryDB(){
        $query = "select User_advisor.*,user.*
                    from user_advisor,department_user,user
                    where department_user.userid=user_advisor.userid 
                    and user.userid=user_advisor.userid  and department_user.name = '$this->dep'";
        $this->result = $this->conn->query($query);
    }

    function processResult(){
        $arr = array();
        while($rs = mysqli_fetch_array($this->result)){
            $user = new AdvisorUser();
            $user->setUserId($rs['userId']);
            $user->setPName($rs['pName']);
            $user->setNotification($rs['notification']);
            $user->setNameLow($rs['name_low']);
            $user->setNameHigh($rs['name_high']);
            $user->setDegType($rs['degree_types']);
            $user->setCutOffPreference($rs['cutOffTime']);
            $user->setEmail($rs['email']);
            $user->setPassword($rs['password']);
            $user->setRole($rs['role']);
            $user->setValidated($rs['validated']);
            array_push($arr, $user);
        }

        return $arr;
    }
}