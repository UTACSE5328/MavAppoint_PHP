<?php
/**
 * Created by PhpStorm.
 * User: oguni
 * Date: 3/24/2017
 * Time: 4:32 AM
 */

namespace Models\Command;


class GetStudentByNetID extends SQLCmd
{
    private $netid;

    function __construct($netid){
        $this->$netid = $netid;
    }

    function queryDB(){
        $query = "SELECT User_Student.student_id, User_Student.netid, User_Student.degree_type,User_Student.phone_num,
                      User_Student.last_name_initial, User_Student.notification,password,validated
                      FROM user,User_Student
                      WHERE USER.netid='$this->netid' and User_Student.netid='$this->netid'";

        $this->result = $this->conn->query($query)->fetch_assoc();
    }

    function processResult() {
        return ($this->result);
    }
}