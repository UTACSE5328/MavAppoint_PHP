<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 16:09
 */
class GetAdvisorsOfDepartment extends SQLCmd{
    private $dep;

    function __construct($dep) {
        $this->dep = $dep;
    }

    function queryDB(){
        $query = "select User_advisor.userId 
                    from user_advisor,department_user 
                    where department_user.userid=user_advisor.userid and department_user.name = '$this->dep'";
        $this->result = $this->conn->query($query)->fetch_assoc();
    }

    function processResult(){
        return $this->result;
    }
}