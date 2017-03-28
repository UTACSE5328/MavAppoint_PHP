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
        $type = $this->apt->getAppointmentType();
        $description = $this->apt->getDescription();
        $student_email = $this->apt->getStudentEmail();
        $student_cell = $this->apt->getStudentPhoneNumber();

        $query = "SELECT * from Appointments where id = '$appointment_id'";
        $res = $this->conn->query($query)->fetch_assoc();
        $date = $res['date'];
        $start = $res['start'];
        $end = $res['end'];

        $query = "SELECT userId from user_student where student_id = '$student_id'";
        $res = $this->conn->query($query)->fetch_assoc();
        $student_userId = $res['userId'];

        $query = "UPDATE Appointments SET student_userId='$student_userId',studentId='$student_id',
            type = '$type', description = '$description', student_email = '$student_email',
            student_cell = '$student_cell' where Id = '$appointment_id'";
        $this->conn->query($query);
        $this->result = mysqli_affected_rows($this->conn);

        $query = "UPDATE Advising_Schedule SET studentId='$student_id' where date='$date' AND start >='$start' AND end <='$end'";
        $this->conn->query($query);
    }

    function processResult(){
        if($this->result == 0)
            return false;
        else
            return true;
    }
}