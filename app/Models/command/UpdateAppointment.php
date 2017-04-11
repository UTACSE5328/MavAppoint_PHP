<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/3/28
 * Time: 12:10
 */

namespace Models\Command;


use Models\Bean\Appointment;

class UpdateAppointment extends SQLCmd
{
    private $apt;

    function __construct(Appointment $apt) {
        $this->apt = $apt;
    }

    function queryDB(){
        $appointment_id = $this->apt->getAppointmentId();
        $student_id = $this->apt->getStudentId();
        $student_userId = $this->apt->getStudentUserId();
        $type = $this->apt->getAppointmentType();
        $description = $this->apt->getDescription();
        $student_email = $this->apt->getStudentEmail();
        $student_cell = $this->apt->getStudentPhoneNumber();

        $date = $this->apt->getAdvisingDate();
        $start = $this->apt->getAdvisingStartTime();
        $end = $this->apt->getAdvisingEndTime();

        $query = "UPDATE appointments SET student_userId='$student_userId',studentId='$student_id',
            type = '$type', description = '$description', student_email = '$student_email',
            student_cell = '$student_cell' where Id = '$appointment_id'";

        $this->conn->query($query);
        $this->result = mysqli_affected_rows($this->conn);

        $query = "UPDATE advising_schedule SET studentId='$student_id' where date='$date' AND start >='$start' AND end <='$end'";
        $this->conn->query($query);
    }

    function processResult(){
        if($this->result == 0)
            return false;
        else
            return true;
    }
}