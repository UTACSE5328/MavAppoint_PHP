<?php
/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/27/17
 * Time: 6:54 AM
 */

namespace Models\Command;


class GetAppointmentByStuId extends SQLCmd
{
    private $studentId,$date;

    function __construct($stuId, $date) {
        $this->studentId = $stuId;
        $this->date = $date;
    }

    function queryDB(){
        $query = "SELECT date,start,end,type FROM appointments a 
                  WHERE a.studentId='$this->studentId' AND date ='$this->date' ";
        $this->result = $this->conn->query($query)->fetch_assoc();
    }

    function processResult(){
        return $this->result;
    }

}