<?php
namespace Models\Db;

use Models\Bean as bean;
use Models\Login as login;
//use Models\Bean\GetSet;

//include_once dirname(__FILE__)."/RDBImpl.php";

class DatabaseManager{
    private $impl;

    function __construct() {
        $this->impl = new RDBImpl();
    }

    function setCutOffTime($id, $time){
        return $this->impl->setCutOffTime($id,$time);
    }

    function addAppointmentType(login\AdvisorUser $user, bean\AppointmentType $at){
       return $this->impl->addAppointmentType($user,$at);
    }

    function createAppointment(bean\Appointment $apt, $email){
        return $this->impl->createAppointment($apt, $email);
    }

    function addTimeSlot(bean\AllocateTime $time, $id){
        return $this->impl->addTimeSlot($time, $id);
    }

    function deleteTimeSlot(bean\AllocateTime $time, $id){
        return $this->impl->deleteTimeSlot($time, $id);
    }

    function cancelAppointment($id){
        return $this->impl->cancelAppointment($id);
    }

    function createAdvisor(login\AdvisorUser $advisorUser){
        return $this->impl->createAdvisor($advisorUser);
    }

    function createUser(login\LoginUser $loginUser){
        return $this->impl->createUser($loginUser);
    }

    function createStudent(login\StudentUser $user){
        return $this->impl->createStudent($user);
    }

    function checkUser(bean\GetSet $set){
        return $this->impl->checkUser($set);
    }

    function deleteAppointmentType(login\AdvisorUser $user, bean\AppointmentType $at){
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
    function getAppointmentByStuId($id,$date){
        return $this->impl->getAppointmentByStuId($id,$date);
    }

    function getAppointments(login\LoginUser $user){
        return $this->impl->getAppointments($user);
    }

    function getAppointmentTypes($pName){
        return $this->impl->getAppointmentTypes($pName);
    }

    function updateUser(login\LoginUser $user){
        return $this->impl->updateUser($user);
    }

    function updatePassword($email,$password){
        return $this->impl->updatePassword($email,$password);
    }

    function updateAppointment(bean\Appointment $apt){
        return $this->impl->updateAppointment($apt);
    }

    function updateAdvisor(login\AdvisorUser $user){
        return $this->impl->updateAdvisor($user);
    }

    function updateUserNotification(login\LoginUser $user,$notification){
        return $this->impl->updateNotification($user,$notification);
    }
}