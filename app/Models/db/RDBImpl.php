<?php
namespace Models\Db;

use Models\Db\DbInterface\DBImplInterface;
use Models\Bean as Bean;
use Models\Login as Login;
use Models\Command as Command;
use Models\PrimitiveTimeSlot as PrimitiveTimeSlot;
use Models\Helper as Helper;

class RDBImpl implements DBImplInterface{

    function connectDB() {
        try {
            $conn = new \mysqli(
                env("DB_HOST"),
                env("DB_USERNAME"),
                env("DB_PASSWORD"),
                env("DB_DATABASE"));

            return $conn;
        } catch (\Exception $e) {
            echo "Can not connect DB.";
        }
        return null;
    }

    function setCutOffTime($id, $time)
    {
        $cmd = new Command\SetCutOffTime($time, $id);
        return $cmd->execute();
    }

    function createAppointment(Bean\Appointment $a, $email)
    {
        $cmd = new Command\CreateAppointment($a, $email);
        return $cmd->execute();
    }

    function updateAppointment(Bean\Appointment $a)
    {
        $cmd = new Command\UpdateAppointment($a);
        return $cmd->execute();
    }

    function cancelAppointment($id)
    {
        $cmd = new Command\CancelAppointment($id);
        return $cmd->execute();
    }

    function getAppointment($d, $e)
    {
        $cmd = new Command\GetAppointment($d, $e);
        return $cmd->execute();
    }

    function getAppointmentByStuId($id,$date)
    {
        $cmd = new Command\GetAppointmentByStuId($id,$date);
        return $cmd->execute();
    }

    function getAppointments($user)
    {
        $cmd = new Command\GetAppointments($user);
        return $cmd->execute();
    }

    function addAppointmentType(Login\AdvisorUser $user, Bean\AppointmentType $type)
    {
        $cmd = new Command\AddAppointmentType($type, $user->getUserId());
        return $cmd->execute();
    }

    function getAppointmentTypes($pName)
    {
        $cmd = new Command\GetAppointmentTypes($pName);
        return $cmd->execute();
    }

    function deleteAppointmentType(Login\AdvisorUser $user, Bean\AppointmentType $type)
    {
        $cmd = new Command\DeleteAppointmentType($type, $user->getUserId());
        return $cmd->execute();
    }

    function createUser(Login\LoginUser $user)
    {
        $cmd = new Command\CreateUser($user);
        return $cmd->execute();
    }

    function updateUser(Login\LoginUser $user)
    {
        $cmd = new Command\UpdateUser($user);
        return $cmd->execute();
    }

    function checkUser(Bean\GetSet $set)
    {
        $cmd = new Command\CheckUser($set);
        return $cmd->execute();
    }

    function getUserIdByEmail($email){
        $cmd = new Command\GetUserIdByEmail($email);
        return $cmd->execute();
    }

    function updatePassword($email, $password)
    {
        $cmd = new Command\UpdatePassword($email,$password);
        return $cmd->execute();
    }

    function createAdvisor(Login\AdvisorUser $user)
    {
        $cmd = new Command\CreateAdvisor($user);
        return $cmd->execute();
    }

    function updateAdvisor(Login\AdvisorUser $advisorUser)
    {
        $cmd = new Command\UpdateAdvisor($advisorUser);
        return $cmd->execute();
    }

    function getAdvisor($email)
    {
        $cmd = new Command\GetAdvisor($email);
        return $cmd->execute();
    }

    function getAdvisors()
    {
        $cmd = new Command\GetAdvisors();
        return $cmd->execute();
    }

    function getAdvisorsOfDepartment($department)
    {
        $cmd = new Command\GetAdvisorsOfDepartment($department);
        return $cmd->execute();
    }

    function getAdvisorSchedule($name)
    {
        $PrimitiveTimeSlotArr = array();
        try {
            $conn = $this->connectDB();
            if($name === "all"){
                $command = "SELECT pname,date,start,end,id FROM user,Advising_Schedule,User_Advisor "
                . "WHERE user.userid=User_Advisor.userid AND user.userid=Advising_Schedule.userid AND studentId is null";
            }
            else{
                $command = "SELECT pname,date,start,end,id FROM USER,Advising_Schedule,User_Advisor "
                    . "WHERE USER.userid=User_Advisor.userid AND USER.userid=Advising_Schedule.userid AND USER.userid=Advising_Schedule.userid AND User_Advisor.pname='$name' AND studentId is null";
            }

            $res = $conn->query($command);

            while($rs = mysqli_fetch_assoc($res)){
                $set = new PrimitiveTimeSlot();
                $set->setName($rs["pname"]);
                $set->setDate($rs["date"]);
                $set->setStartTime($rs["start"]);
                $set->setEndTime($rs["end"]);
                $set->setUniqueId($rs["id"]);
                array_push($PrimitiveTimeSlotArr, serialize($set));
            }

            $compositeTimeSlotArr = Helper\TimeSlotHelper::createCompositeTimeSlot($PrimitiveTimeSlotArr);


            $conn->close();

        } catch (\Exception $e) {

        }

        return $compositeTimeSlotArr;
    }

    function getAdvisorSchedules(array $advisorUsers)
    {
        $cmd = new Command\GetAdvisorSchedules($advisorUsers,true);
        return $cmd->execute();
    }

    function getAdvisorWaitlistSchedules(array $advisorUsers)
    {
        $cmd = new Command\GetAdvisorSchedules($advisorUsers,false);
        return $cmd->execute();
    }

    function deleteAdvisor($id)
    {
//        include_once dirname(dirname(__FILE__)) . "/Command/DeleteAdvisor.php";
        $cmd = new Command\DeleteAdvisor($id);
        return $cmd->execute();
    }

    function updateNotification($user, $notification)
    {
//        include_once dirname(dirname(__FILE__))."/Command/UpdateNotification.php";
        $cmd = new Command\UpdateNotification($user,$notification);
        return $cmd->execute();
    }

    function createStudent(Login\StudentUser $user)
    {
//        include_once dirname(dirname(__FILE__))."/Command/CreateStudent.php";
        $cmd = new Command\CreateStudent($user);
        return $cmd->execute();
    }

    function getStudent($email)
    {
//        include_once dirname(dirname(__FILE__)) . "/Command/GetStudent.php";
        $cmd = new Command\GetStudent($email);

        return $cmd->execute();
    }

    function getStudentByNetID($netid){
        $cmd = new Command\GetStudentByNetID($netid);
        return $cmd->execute();
    }

    function getAdmin($email)
    {
//        include_once dirname(dirname(__FILE__)) . "/Command/GetAdmin.php";
        $cmd = new Command\GetAdmin($email);
        return $cmd->execute();
    }

    function getFaculty($email)
    {
//        include_once dirname(dirname(__FILE__)) . "/Command/GetAdmin.php";
        $cmd = new Command\GetAdmin($email);
        return $cmd->execute();
    }

    function createWaitlist(Bean\WaitList $list)
    {
    }

    function addTimeSlot(Bean\AllocateTime $at, $id)
    {
//        include_once dirname(dirname(__FILE__)) . "/Command/AddTimeSlot.php";
        $cmd = new Command\AddTimeSlot($at,$id);
        return $cmd->execute();
    }

    function deleteTimeSlot(Bean\AllocateTime $at)
    {
//        include_once dirname(dirname(__FILE__)) . "/Command/DeleteTimeSlot.php";
        $cmd = new Command\DeleteTimeSlot($at);
        return $cmd->execute();
    }

    function updateCutOffTime(Login\AdvisorUser $user, $time)
    {
    }

    function getDepartment($id)
    {
//        include_once dirname(dirname(__FILE__)) . "/Command/GetDepartment.php";
        $cmd = new Command\GetDepartment($id);
        return $cmd->execute();
    }

    function getMajorsOfDepartment($name)
    {
//        include_once dirname(dirname(__FILE__)) . "/Command/GetMajorsOfDepartment.php";
        $cmd = new Command\GetMajorsOfDepartment($name);
        return $cmd->execute();
    }

    function getMajor($id)
    {
        $cmd = new Command\GetMajor($id);
        return $cmd->execute();
    }

    function getCSEUser($pName){
        $cmd = new Command\GetCSEUser($pName);
        return $cmd->execute();
    }

    function getCSEStudent($studentId){
        $cmd = new Command\GetCSEStudent($studentId);
        return $cmd->execute();
    }
}