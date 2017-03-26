<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 7:06
 */
use Models\Login\AdvisorUser;

class GetAdvisors extends SQLCmd{
    function __construct() {
    }

    function queryDB(){
        $query = "SELECT pname FROM USER,User_Advisor WHERE ROLE='advisor' AND USER.userid = User_Advisor.userid";
        $this->result = $this->conn->query($query);
    }

    function processResult(){
        $arr = array();
        while($rs = mysqli_fetch_array($this->result)){
            array_push($arr, $rs['pname']);
        }

        return $arr;
    }
}