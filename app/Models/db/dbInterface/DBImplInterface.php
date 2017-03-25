<?php
namespace Models\Db\DbInterface;
use Models\Bean as bean;
use Models\Login as login;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/13
 * Time: 1:56
 */

interface DBImplInterface
{
    function setCutOffTime($id,$time);
    function createAppointment(bean\Appointment $a, $email);
    function updateAppointment(bean\Appointment $a);
    function cancelAppointment($id);
    function getAppointment($d,$e);
    function getAppointments($user);

    function addAppointmentType(login\AdvisorUser $user, bean\AppointmentType $type);
    function getAppointmentTypes($pName);
    function deleteAppointmentType(login\AdvisorUser $user, bean\AppointmentType $type);

    function createUser(login\LoginUser $user);
    function updateUser(login\LoginUser $user);
    function checkUser(bean\GetSet $set);
    function getUserIdByEmail($email);
    function updatePassword($email,$password);
    function getStudentByNetID($netid);

    function createAdvisor(login\AdvisorUser $user);
    function getAdvisor($email);
    function getAdvisors();
    function getAdvisorsOfDepartment($department);
    function getAdvisorSchedule($name);
    function getAdvisorSchedules(array $advisorUsers);
    function getAdvisorWaitlistSchedules(array $advisorUsers);
    function deleteAdvisor($id);

    function updateNotification($user,$notification);

    function createStudent(login\StudentUser $user);
    function getStudent($email);

    function getAdmin($email);
    function getFaculty($email);

    function createWaitlist(bean\WaitList $list);

    function addTimeSlot(bean\AllocateTime $at, $id);
    function deleteTimeSlot(bean\AllocateTime $at);

    function updateCutOffTime(login\AdvisorUser $user, $time);

    function getDepartment($id);
    function getMajorsOfDepartment($name);
    function getMajor($id);
}
