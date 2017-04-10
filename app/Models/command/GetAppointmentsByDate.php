<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/4/10
 * Time: 17:08
 */

namespace Models\Command;
use Models\bean\Appointment;


class GetAppointmentsByDate extends SQLCmd
{

    private $start,$end;

    function __construct($start, $end) {
        $this->start = $start;
        $this->end = $end;
    }

    function queryDB(){
        $query = "SELECT * FROM appointments WHERE date >='$this->start' 
                  and date <= '$this->end' ORDER BY date";
        $this->result          = $this->conn->query($query);
    }

    function processResult(){
        $arr = array();
        while($rs = mysqli_fetch_array($this->result)){
            $set = new Appointment();
            $set->setPname($rs['pName']);
            $set->setAdvisorEmail($rs['email']);
            $set->setAdvisingDate($rs["date"]);
            $set->setAdvisingStartTime($rs["start"]);
            $set->setAdvisingEndTime($rs["end"]);
            $set->setAppointmentType($rs["type"]);
            $set->setAppointmentId($rs['id']);
            $set->setDescription($rs['description']);
            $set->setStudentId($rs['studentId']);
            $set->setStudentEmail($rs['student_email']);
            $set->setStudentPhoneNumber($rs['student_cell']);
            array_push($arr, $set);
        }

        return $arr;
    }
}