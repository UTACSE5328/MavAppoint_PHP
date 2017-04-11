<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/4/11
 * Time: 0:17
 */

namespace Models\Command;
use Models\bean\WaitList;


class GetStudentWaitList extends SQLCmd
{
    private $user_id,$appointment_id;

    function __construct($user_id, $appointment_id) {
        $this->appointment_id = $appointment_id;
        $this->user_id = $user_id;
    }

    function queryDB(){
        $query = "SELECT * FROM wait_list_schedule 
                    where appointment_id = '$this->appointment_id' and student_user_id = '$this->user_id'";
        $this->result = $this->conn->query($query);
    }

    function processResult(){
        $arr = array();
        while($rs = mysqli_fetch_array($this->result)){
            $apt = new WaitList();
            $apt->setId($rs['id']);
            $apt->setAppointmentId($rs['appointment_id']);
            $apt->setStudentId($rs['student_id']);
            $apt->setStudentUserId($rs['student_user_id']);
            $apt->setType($rs['type']);
            $apt->setDescription($rs['description']);
            $apt->setStudentEmail($rs['student_email']);
            $apt->setStudentPhone($rs['student_cell']);
            array_push($arr, $apt);
        }

        return $arr;
    }
}