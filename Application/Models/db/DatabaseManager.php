<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/13
 * Time: 3:25
 */

include_once dirname(__FILE__)."/RDBImpl.php";

class DatabaseManager{
    private $impl;

    function __construct() {
        $this->impl = new RDBImpl();
    }

    function addAppointmentType(AdvisorUser $user, AppointmentType $at){
       return $this->impl->addAppointmentType($user,$at);
    }

    function createAppointment(Appointment $apt, $email){
        return $this->impl->createAppointment($apt, $email);
    }

    function cancelAppointment($id){
        return $this->impl->cancelAppointment($id);
    }

    function createAdvisor(AdvisorUser $advisorUser){
        return $this->impl->createAdvisor($advisorUser);
    }

    function createUser(LoginUser $loginUser){
        return $this->impl->createUser($loginUser);
    }

    function createStudent(StudentUser $user){
        return $this->impl->createStudent($user);
    }

    function checkUser(GetSet $set){
        return $this->impl->checkUser($set);
    }

    function deleteAppointmentType(AdvisorUser $user, AppointmentType $at){
        return $this->impl->deleteAppointmentType($user,$at);
    }

    function deleteAdvisor($id){
        return $this->impl->deleteAdvisor($id);
    }

    function getUserIdByEmail($email){
        return $this->impl->getUserIdByEmail($email);
    }

    function getAdvisor($email){
        return $this->impl->getAdvisor($email);
    }

    function getAdvisors(){
        return $this->impl->getAdvisors();
    }

    function getAdvisorsOfDepartment($dep){
        return $this->impl->getAdvisorsOfDepartment($dep);
    }

    function getStudent($email){
        return $this->impl->getStudent($email);
    }

    function getAdmin($email){
        return $this->impl->getAdmin($email);
    }

    function getFaculty($email){
        return $this->impl->getFaculty($email);
    }

    function getAdvisorSchedules(array $advisorUsers){
        return $this->impl->getAdvisorSchedules($advisorUsers);
    }

    function getAdvisorWaitlistSchedules(array $advisorUsers){
        return $this->impl->getAdvisorWaitlistSchedules($advisorUsers);
    }

    function getMajor($id){
        return $this->impl->getMajor($id);
    }

    function getDepartment($id){
        return $this->impl->getDepartment($id);
    }

    function getMajorsOfDepartment($name){
        return $this->impl->getMajorsOfDepartment($name);
    }

    function getAppointment($date,$email){
        return $this->impl->getAppointment($date,$email);
    }

    function getAppointments(LoginUser $user){
        return $this->impl->getAppointments($user);
    }

    function getAppointmentTypes($pName){
        return $this->impl->getAppointmentTypes($pName);
    }

    function updateUser(LoginUser $user){
        return $this->impl->updateUser($user);
    }

    function updatePassword($email,$password){
        return $this->impl->updatePassword($email,$password);
    }

    function updateAppointment(Appointment $apt){
        return $this->impl->updateAppointment($apt);
    }

    function updateAdvisor(AdvisorUser $user){
        return $this->impl->updateAdvisor($user);
    }

    function updateUserNotification(LoginUser $user,$notification){
        return $this->impl->updateNotification($user,$notification);
    }
}