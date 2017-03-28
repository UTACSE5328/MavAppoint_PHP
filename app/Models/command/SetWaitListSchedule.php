<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/3/28
 * Time: 11:58
 */

namespace Models\Command;


use Models\Bean\Appointment;

class SetWaitListSchedule extends SQLCmd
{
    private $apt;

    function __construct(Appointment $apt)
    {
        $this->apt = $apt;
    }

    function queryDB()
    {
        $appointment_id = $this->apt->getAppointmentId();
        $student_id = $this->apt->getStudentId();
        $type = $this->apt->getAppointmentType();
        $description = $this->apt->getDescription();
        $student_email = $this->apt->getStudentEmail();
        $student_cell = $this->apt->getStudentPhoneNumber();

        $query = "SELECT COUNT(*) from wait_list_schedule 
                  where appointment_id ='$appointment_id' and student_id ='$student_id'";
        $count = $this->conn->query($query)->fetch_assoc()['COUNT(*)'];

        if ($count == 0) {
            $query = "Insert into wait_list_schedule 
                      (appointment_id, student_id, type, description, student_email, student_cell)
                        values ('$appointment_id','$student_id','$type','$description',
                        '$student_email','$student_cell')";
            $this->conn->query($query);

            if($this->conn->affected_rows > 0)
                $this->result = true;
            else
                $this->result = false;
        }else
            $this->result = false;
    }

    function processResult()
    {
        return $this->result;
    }
}