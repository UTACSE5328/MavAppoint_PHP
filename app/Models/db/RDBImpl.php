<?php
namespace Models\Db;
use Models\Db\DbInterface\DBImplInterface;
use Models\Bean as bean;
use Models\Login as login;
use Models\Command as command;
//include_once dirname(__FILE__) . "/DBImplInterface.php";

class RDBImpl implements DBImplInterface{

    function createAppointment(bean\Appointment $a, $email)
    {
        include_once dirname(dirname(__FILE__))."/command/CreateAppointment.php";
        $cmd = new command\CreateAppointment($a, $email);
        return $cmd->execute();
    }

    function updateAppointment(bean\Appointment $a)
    {
        include_once dirname(dirname(__FILE__))."/command/UpdateAppointment.php";
        $cmd = new command\UpdateAppointment($a);
        return $cmd->execute();
    }

    function cancelAppointment($id)
    {
        include_once dirname(dirname(__FILE__))."/command/CancelAppointment.php";
        $cmd = new command\CancelAppointment($id);
        return $cmd->execute();
    }

    function getAppointment($d, $e)
    {
        include_once dirname(dirname(__FILE__))."/command/GetAppointment.php";
        $cmd = new command\GetAppointment($d, $e);
        return $cmd->execute();
    }

    function getAppointments($user)
    {
        include_once dirname(dirname(__FILE__))."/command/GetAppointments.php";
        $cmd = new command\GetAppointments($user);
        return $cmd->execute();
    }

    function addAppointmentType(login\AdvisorUser $user, bean\AppointmentType $type)
    {
        include_once dirname(dirname(__FILE__))."/command/AddAppointmentType.php";
        $cmd = new command\AddAppointmentType($type, $user->getUserId());
        return $cmd->execute();
    }

    function getAppointmentTypes($pName)
    {
        include_once dirname(dirname(__FILE__))."/command/GetAppointmentTypes.php";
        $cmd = new command\GetAppointmentTypes($pName);
        return $cmd->execute();
    }

    function deleteAppointmentType(login\AdvisorUser $user, bean\AppointmentType $type)
    {
        include_once dirname(dirname(__FILE__))."/command/DeleteAppointmentType.php";
        $cmd = new command\DeleteAppointmentType($type, $user->getUserId());
        return $cmd->execute();
    }

    function createUser(login\LoginUser $user)
    {
//        include_once dirname(dirname(__FILE__))."/command/CreateUser.php";
        $cmd = new command\CreateUser($user);
        return $cmd->execute();
    }

    function updateUser(login\LoginUser $user)
    {
        include_once dirname(dirname(__FILE__))."/command/UpdateUser.php";
        $cmd = new command\UpdateUser($user);
        return $cmd->execute();
    }

    function checkUser(bean\GetSet $set)
    {
//        include_once dirname(dirname(__FILE__))."/command/CheckUser.php";
        $cmd = new command\CheckUser($set);
        return $cmd->execute();
    }

    function getUserIdByEmail($email){
        include_once dirname(dirname(__FILE__))."/command/GetUserIdByEmail.php";
        $cmd = new command\GetUserIdByEmail($email);
        return $cmd->execute();
    }

    function updatePassword($email, $password)
    {
        include_once dirname(dirname(__FILE__))."/command/UpdatePassword.php";
        $cmd = new command\UpdatePassword($email,$password);
        return $cmd->execute();
    }

    function createAdvisor(login\AdvisorUser $user)
    {
        include_once dirname(dirname(__FILE__))."/command/CreateAdvisor.php";
        $cmd = new command\CreateAdvisor($user);
        return $cmd->execute();
    }

    function updateAdvisor(login\AdvisorUser $advisorUser)
    {
        include_once dirname(dirname(__FILE__))."/command/UpdateAdvisor.php";
        $cmd = new command\UpdateAdvisor($advisorUser);
        return $cmd->execute();
    }

    function getAdvisor($email)
    {
        include_once dirname(dirname(__FILE__))."/command/GetAdvisor.php";
        $cmd = new command\GetAdvisor($email);
        return $cmd->execute();
    }

    function getAdvisors()
    {
        include_once dirname(dirname(__FILE__))."/command/GetAdvisors.php";
        $cmd = new command\GetAdvisors();
        return $cmd->execute();
    }

    function getAdvisorsOfDepartment($department)
    {
        include_once dirname(dirname(__FILE__))."/command/GetAdvisorsOfDepartment.php";
        $cmd = new command\GetAdvisorsOfDepartment($department);
        return $cmd->execute();
    }

    function getAdvisorSchedules(array $advisorUsers)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetAdvisorSchedules.php";
        $cmd = new command\GetAdvisorSchedules($advisorUsers,true);
        return $cmd->execute();
    }

    function getAdvisorWaitlistSchedules(array $advisorUsers)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetAdvisorSchedules.php";
        $cmd = new command\GetAdvisorSchedules($advisorUsers,false);
        return $cmd->execute();
    }

    function deleteAdvisor($id)
    {
        include_once dirname(dirname(__FILE__)) . "/command/DeleteAdvisor.php";
        $cmd = new command\DeleteAdvisor($id);
        return $cmd->execute();
    }

    function updateNotification($user, $notification)
    {
        include_once dirname(dirname(__FILE__))."/command/UpdateNotification.php";
        $cmd = new command\UpdateNotification($user,$notification);
        return $cmd->execute();
    }

    function createStudent(login\StudentUser $user)
    {
        include_once dirname(dirname(__FILE__))."/command/CreateStudent.php";
        $cmd = new command\CreateStudent($user);
        return $cmd->execute();
    }

    function getStudent($email)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetStudent.php";
        $cmd = new command\GetStudent($email);

        return $cmd->execute();
    }

    function getAdmin($email)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetAdmin.php";
        $cmd = new command\GetAdmin($email);
        return $cmd->execute();
    }

    function getFaculty($email)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetAdmin.php";
        $cmd = new command\GetAdmin($email);
        return $cmd->execute();
    }

    function createWaitlist(bean\WaitList $list)
    {
    }

    function addTimeSlot(bean\AllocateTime $at,$id)
    {
        include_once dirname(dirname(__FILE__)) . "/command/AddTimeSlot.php";
        $cmd = new command\AddTimeSlot($at,$id);
        return $cmd->execute();
    }

    function deleteTimeSlot(bean\AllocateTime $at, $id)
    {
        include_once dirname(dirname(__FILE__)) . "/command/DeleteTimeSlot.php";
        $cmd = new command\DeleteTimeSlot($at,$id);
        return $cmd->execute();
    }

    function updateCutOffTime(login\AdvisorUser $user, $time)
    {
    }

    function getDepartment($id)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetDepartment.php";
        $cmd = new command\GetDepartment($id);
        return $cmd->execute();
    }

    function getMajorsOfDepartment($name)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetMajorsOfDepartment.php";
        $cmd = new command\GetMajorsOfDepartment($name);
        return $cmd->execute();
    }

    function getMajor($id)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetMajor.php";
        $cmd = new command\GetMajor($id);
        return $cmd->execute();
    }

}