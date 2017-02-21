<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/13
 * Time: 1:56
 */

interface DBImplInterface
{
    function createAppointment(Appointment $a, $email);
    function updateAppointment(Appointment $a);
    function cancelAppointment($id);
    function getAppointment($d,$e);
    function getAppointments($user);

    function addAppointmentType(AdvisorUser $user, AppointmentType $type);
    function getAppointmentTypes($pName);
    function deleteAppointmentType(AdvisorUser $user, AppointmentType $type);

    function createUser(LoginUser $user);
    function updateUser(LoginUser $user);
    function checkUser(GetSet $set);
    function getUserIdByEmail($email);
    function updatePassword($email,$password);

    function createAdvisor(AdvisorUser $user);
    function getAdvisor($email);
    function getAdvisors();
    function getAdvisorsOfDepartment($department);
    function getAdvisorSchedules(array $advisorUsers);
    function getAdvisorWaitlistSchedules(array $advisorUsers);
    function deleteAdvisor($id);

    function updateNotification($user,$notification);

    function createStudent(StudentUser $user);
    function getStudent($email);

    function getAdmin($email);
    function getFaculty($email);

    function createWaitlist(WaitList $list);

    function addTimeSlot(AllocateTime $at, $id);
    function deleteTimeSlot(AllocateTime $at, $id);

    function updateCutOffTime(AdvisorUser $user, $time);

    function getDepartment($id);
    function getMajorsOfDepartment($name);
    function getMajor($id);
}
