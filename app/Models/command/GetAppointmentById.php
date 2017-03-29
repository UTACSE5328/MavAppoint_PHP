<?php

namespace Models\Command;


use Models\Bean\Appointment;

class GetAppointmentById extends SQLCmd
{
    private $id;

    public function __construct($appointmentId) {
        $this->id = $appointmentId;
    }

    function queryDB()
    {
        $query = "SELECT user_advisor.pName,user.email,date,start,end,type,description,studentId,student_email, student_cell,advisor_userId,student_userId
        FROM appointments,user_advisor,user
        WHERE Id=$this->id and user_advisor.userId = advisor_userId and user.userId = advisor_userId";

        $this->result = $this->conn->query($query)->fetch_assoc();
    }

    function processResult()
    {
        $rs = $this->result;
        if ($rs != null) {
            $set = new Appointment();
            $set->setPname($rs["pName"]);
            $set->setAdvisingDate($rs["date"]);
            $set->setAdvisingStartTime($rs["start"]);
            $set->setAdvisingEndTime($rs["end"]);
            $set->setAppointmentType($rs["type"]);
            $set->setDescription($rs['description']);
            $set->setStudentId($rs['studentId']);
            $set->setStudentEmail($rs['student_email']);
            $set->setStudentPhoneNumber($rs['student_cell']);
            $set->setAdvisorUserId($rs['advisor_userId']);
            $set->setAdvisorEmail($rs['email']);
            $set->setStudentUserId($rs['student_userId']);

            return $set;
        }

        return $rs;




    }
}