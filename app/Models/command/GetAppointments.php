<?php
namespace Models\Command;

use Models\Login as login;
use Models\bean\Appointment;

class GetAppointments extends SQLCmd{
    private $user;

    function __construct(login\LoginUser $user) {
        $this->user = $user;
    }

    function queryDB(){
        $email = $this->user->getEmail();
        $id = $this->user->getUserId();

        if($this->user instanceof login\AdvisorUser){
            $query = "SELECT User_Advisor.pName,User.email,date,start,end,type,Id,Appointments.description,
                        studentId,Appointments.student_email,Appointments.student_cell 
                        FROM USER,Appointments,User_Advisor 
                        WHERE USER.email='$email' AND user.userid=Appointments.advisor_userid 
                        AND User_Advisor.userid=Appointments.advisor_userid";
        }else if($this->user instanceof login\StudentUser){
            $query = "SELECT User_Advisor.pName,User.email,date,start,end,type,Id,description,studentId, student_email, student_userId, student_cell
                      FROM USER,Appointments,User_Advisor 
                      WHERE USER.email='$email' AND user.userid=Appointments.student_userId AND User_Advisor.userid=Appointments.advisor_userid
                      order by date desc, start asc";
        }else{
            $query = "select name from department_user where userId = '$id'";

            $dep = $this->conn->query($query)->fetch_assoc()['name'];

            $query = "select appointments.date,appointments.start,appointments.end,
                      appointments.type,appointments.Id,appointments.description,
                      appointments.student_userId,appointments.studentId,
                      appointments.student_email,appointments.student_cell,user.email,user_advisor.pName
                      from appointments,department_user,user,user_advisor
                      where appointments.advisor_userId = department_user.userId 
                      and appointments.advisor_userId = user.userId
                      and appointments.advisor_userId = user_advisor.userId
                      and department_user.name = '$dep'";
        }
        $this->result = $this->conn->query($query);
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
            $set->setAppointmentId($rs['Id']);
            $set->setDescription($rs['description']);
            $set->setStudentUserId($rs['student_userId']);
            $set->setStudentId($rs['studentId']);
            $set->setStudentEmail($rs['student_email']);
            $set->setStudentPhoneNumber($rs['student_cell']);
            array_push($arr, $set);
        }

        return $arr;
    }
}