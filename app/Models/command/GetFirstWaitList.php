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
                    where appointment_id = '$this->appointment_id' order by id asc limit 1";
        $this->result = $this->conn->query($query)->fetch_assoc();
    }

    function processResult(){
        if ($this->result){
            $wl = new WaitList();
            $wl->setId($this->result['id']);
            $wl->setAppointmentId($this->result['appointment_id']);
            $wl->setStudentId($this->result['student_id']);
            $wl->setStudentUserId($this->result['student_user_id']);
            $wl->setType($this->result['type']);
            $wl->setDescription($this->result['description']);
            $wl->setStudentEmail($this->result['student_email']);
            $wl->setStudentPhone($this->result['student_cell']);
            return $wl;
        }

        return null;
    }
}