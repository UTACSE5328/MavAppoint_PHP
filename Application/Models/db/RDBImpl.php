<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/13
 * Time: 3:24
 */

include_once dirname(__FILE__)."/DBImplInterface.php";

class RDBImpl implements DBImplInterface{

    function createAppointment(Appointment $a, $email)
    {
        include_once dirname(dirname(__FILE__))."/command/CreateAppointment.php";
        $cmd = new CreateAppointment($a, $email);
        return $cmd->execute();
    }

    function updateAppointment(Appointment $a)
    {
        include_once dirname(dirname(__FILE__))."/command/UpdateAppointment.php";
        $cmd = new UpdateAppointment($a);
        return $cmd->execute();
    }

    function cancelAppointment($id)
    {
        include_once dirname(dirname(__FILE__))."/command/CancelAppointment.php";
        $cmd = new CancelAppointment($id);
        return $cmd->execute();
    }

    function getAppointment($d, $e)
    {
        include_once dirname(dirname(__FILE__))."/command/GetAppointment.php";
        $cmd = new GetAppointment($d, $e);
        return $cmd->execute();
    }

    function getAppointments($user)
    {
        include_once dirname(dirname(__FILE__))."/command/GetAppointments.php";
        $cmd = new GetAppointments($user);
        return $cmd->execute();
    }

    function addAppointmentType(AdvisorUser $user, AppointmentType $type)
    {
        include_once dirname(dirname(__FILE__))."/command/AddAppointmentType.php";
        $cmd = new AddAppointmentType($type, $user->getUserId());
        return $cmd->execute();
    }

    function getAppointmentTypes($pName)
    {
        include_once dirname(dirname(__FILE__))."/command/GetAppointmentTypes.php";
        $cmd = new GetAppointmentTypes($pName);
        return $cmd->execute();
    }

    function deleteAppointmentType(AdvisorUser $user, AppointmentType $type)
    {
        include_once dirname(dirname(__FILE__))."/command/DeleteAppointmentType.php";
        $cmd = new DeleteAppointmentType($type, $user->getUserId());
        return $cmd->execute();
    }

    function createUser(LoginUser $user)
    {
        include_once dirname(dirname(__FILE__))."/command/CreateUser.php";
        $cmd = new CreateUser($user);
        return $cmd->execute();
    }

    function updateUser(LoginUser $user)
    {
        include_once dirname(dirname(__FILE__))."/command/UpdateUser.php";
        $cmd = new UpdateUser($user);
        return $cmd->execute();
    }

    function checkUser(GetSet $set)
    {
        include_once dirname(dirname(__FILE__))."/command/CheckUser.php";
        $cmd = new CheckUser($set);
        return $cmd->execute();
    }

    function getUserIdByEmail($email){
        include_once dirname(dirname(__FILE__))."/command/GetUserIdByEmail.php";
        $cmd = new GetUserIdByEmail($email);
        return $cmd->execute();
    }

    function updatePassword($email, $password)
    {
        include_once dirname(dirname(__FILE__))."/command/UpdatePassword.php";
        $cmd = new UpdatePassword($email,$password);
        return $cmd->execute();
    }

    function createAdvisor(AdvisorUser $user)
    {
        include_once dirname(dirname(__FILE__))."/command/CreateAdvisor.php";
        $cmd = new CreateAdvisor($user);
        return $cmd->execute();
    }

    function updateAdvisor(AdvisorUser $advisorUser)
    {
        include_once dirname(dirname(__FILE__))."/command/UpdateAdvisor.php";
        $cmd = new UpdateAdvisor($advisorUser);
        return $cmd->execute();
    }

    function getAdvisor($email)
    {
        include_once dirname(dirname(__FILE__))."/command/GetAdvisor.php";
        $cmd = new GetAdvisor($email);
        return $cmd->execute();
    }

    function getAdvisors()
    {
        include_once dirname(dirname(__FILE__))."/command/GetAdvisors.php";
        $cmd = new GetAdvisors();
        return $cmd->execute();
    }

    function getAdvisorsOfDepartment($department)
    {
        include_once dirname(dirname(__FILE__))."/command/GetAdvisorsOfDepartment.php";
        $cmd = new GetAdvisorsOfDepartment($department);
        return $cmd->execute();
    }

    function getAdvisorSchedules(array $advisorUsers)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetAdvisorSchedules.php";
        $cmd = new GetAdvisorSchedules($advisorUsers,true);
        return $cmd->execute();
    }

    function getAdvisorWaitlistSchedules(array $advisorUsers)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetAdvisorSchedules.php";
        $cmd = new GetAdvisorSchedules($advisorUsers,false);
        return $cmd->execute();
    }

    function deleteAdvisor($id)
    {
        include_once dirname(dirname(__FILE__)) . "/command/DeleteAdvisor.php";
        $cmd = new DeleteAdvisor($id);
        return $cmd->execute();
    }

    function updateNotification($user, $notification)
    {
        include_once dirname(dirname(__FILE__))."/command/UpdateNotification.php";
        $cmd = new UpdateNotification($user,$notification);
        return $cmd->execute();
    }

    function createStudent(StudentUser $user)
    {
        include_once dirname(dirname(__FILE__))."/command/CreateStudent.php";
        $cmd = new CreateStudent($user);
        return $cmd->execute();
    }

    function getStudent($email)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetStudent.php";
        $cmd = new GetStudent($email);

        return $cmd->execute();
    }

    function getAdmin($email)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetAdmin.php";
        $cmd = new GetAdmin($email);
        return $cmd->execute();
    }

    function getFaculty($email)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetAdmin.php";
        $cmd = new GetAdmin($email);
        return $cmd->execute();
    }

    function createWaitlist(WaitList $list)
    {
    }

    function addTimeSlot(AllocateTime $at,$id)
    {
        include_once dirname(dirname(__FILE__)) . "/command/AddTimeSlot.php";
        $cmd = new AddTimeSlot($at,$id);
        return $cmd->execute();
    }

    function deleteTimeSlot(AllocateTime $at, $id)
    {
        include_once dirname(dirname(__FILE__)) . "/command/DeleteTimeSlot.php";
        $cmd = new DeleteTimeSlot($at,$id);
        return $cmd->execute();
    }

    function updateCutOffTime(AdvisorUser $user, $time)
    {
    }

    function getDepartment($id)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetDepartment.php";
        $cmd = new GetDepartment($id);
        return $cmd->execute();
    }

    function getMajorsOfDepartment($name)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetMajorsOfDepartment.php";
        $cmd = new GetMajorsOfDepartment($name);
        return $cmd->execute();
    }

    function getMajor($id)
    {
        include_once dirname(dirname(__FILE__)) . "/command/GetMajor.php";
        $cmd = new GetMajor($id);
        return $cmd->execute();
    }

}