<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 10:43
 */
use Models\Login as login;
class GetAppointments extends SQLCmd{
    private $user;

    function __construct(login\LoginUser $user) {
        $this->user = $user;
    }

    function queryDB(){
        $email = $this->user->getEmail();
        $id = $this->user->getUserId();

        if($this->user instanceof login\AdvisorUser){
            $query = "SELECT User_Advisor.pname,User.email,date,start,end,type,id,Appointments.description,
                        studentId,Appointments.student_email,Appointments.student_cell 
                        FROM USER,Appointments,User_Advisor 
                        WHERE USER.email='$email' AND user.userid=Appointments.advisor_userid 
                        AND User_Advisor.userid=Appointments.advisor_userid";
        }else if($this->user instanceof login\StudentUser){
            $query = "SELECT User_Advisor.pname,User.email,date,start,end,type,id,description,student_email, student_cell 
                      FROM USER,Appointments,User_Advisor 
                      WHERE USER.email='$email' AND user.userid=Appointments.student_userid AND User_Advisor.userid=Appointments.advisor_userid";
        }else{
            $query =  "select department_user.userId,user_advisor.pName, appointments.date, appointments.start, 
                       appointments.end,appointments.type,user.email,appointments.description,appointments.studentId, 
                       appointments.student_email, appointments.student_cell, appointments.Id  
                       from department_user,user, appointments, user_advisor 
                       where userId = '$id' 
                       AND department_user.userId = user.userId AND appointments.advisor_userId = user.userId 
                       AND user_advisor.userId = user.userId;";
        }
        $arr=array();
        $res = $this->conn->query($query);
        while($rs = mysqli_fetch_assoc($res)){
            array_push($arr, $rs);
        }
        $this->result = $arr;
//        $this->result = mysqli_fetch_assoc($res);
//        $this->result = $this->conn->query($query)->fetch_assoc();
    }

    function processResult(){
        return $this->result;
    }
}