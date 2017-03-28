<?php
namespace Models\Db;

use Models\Bean as bean;
use Models\Login as login;

class DatabaseManager{
    private $impl;

    function __construct() {
        $this->impl = new RDBImpl();
    }

    function getStudentEmails(){
        return $this->impl->getStudentEmails();
    }

    function getCSEUser($pName){
        return $this->impl->getCSEUser($pName);
    }

    function getCSEStudent($studentId){
        return $this->impl->getCSEStudent($studentId);
    }

    function setCutOffTime($id, $time){
        return $this->impl->setCutOffTime($id,$time);
    }

    function addAppointmentType($userId, bean\AppointmentType $at){
       return $this->impl->addAppointmentType($userId,$at);
    }

    function createAppointment(bean\Appointment $apt, $email){
        return $this->impl->createAppointment($apt, $email);
    }

    function addTimeSlot(bean\AllocateTime $time, $id){
        return $this->impl->addTimeSlot($time, $id);
    }

    function deleteTimeSlot(bean\AllocateTime $time){
        return $this->impl->deleteTimeSlot($time);
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

    function deleteAppointmentType($userId, bean\AppointmentType $at){
        return $this->impl->deleteAppointmentType($userId,$at);
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

    function getStudentByNetID($netid){
        return $this->impl->getStudentByNetID($netid);
    }

    function getAdmin($email){
        return $this->impl->getAdmin($email);
    }

    function getFaculty($email){
        return $this->impl->getFaculty($email);
    }

    function getAdvisorSchedule($name){
        return$this->impl->getAdvisorSchedule($name);
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