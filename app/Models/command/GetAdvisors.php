<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 7:06
 */
class GetAdvisors extends SQLCmd{
    function __construct() {
    }

    function queryDB(){
        $query = "SELECT pname FROM USER,User_Advisor WHERE ROLE='advisor' AND USER.userid = User_Advisor.userid";
        $this->result = $this->conn->query($query);
    }

    function processResult(){
        $arr = array();

        while ($row = $this->result->fetch_assoc()) {
            array_push($arr,$row['pname']);
        }

        return $arr;
    }
}