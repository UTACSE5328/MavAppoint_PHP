<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/3/28
 * Time: 12:14
 */

namespace Models\Command;
use Models\Bean\WaitList;

class GetFirstWaitList extends SQLCmd
{
    private $appointment_id;

    function __construct($appointment_id) {
        $this->appointment_id = $appointment_id;
    }

    function queryDB(){
        $query = "SELECT * FROM wait_list_schedule 
                    where appointment_id = '$this->appointment_id' limit 1";
        $this->result = $this->conn->query($query)->fetch_assoc();
    }

    function processResult(){
        if($this->result == null)
             return $this->result;
        else{
            $apt = new WaitList();
            $apt->setId($this->result['id']);
            $apt->setAppointmentId($this->result['appointment_id']);
            $apt->setStudentId($this->result['student_id']);
            $apt->setStudentUserId($this->result['student_user_id']);
            $apt->setType($this->result['type']);
            $apt->setDescription($this->result['description']);
            $apt->setStudentEmail($this->result['student_email']);
            $apt->setStudentPhone($this->result['student_cell']);
            return $apt;
        }
    }
}