<?php

namespace App\Controllers;


use Models\Bean\Appointment;
use Models\Db\DatabaseManager;
use Models\Login\StudentUser;

class AppointmentController
{
    public function makeAppointmentAction(){
        $appointment = new Appointment();
        $appointment->setStudentPhoneNumber($_REQUEST['phoneNumber']);
        $appointment->setAppointmentId($_REQUEST['appointmentId']);
        $appointment->setStudentId($_REQUEST['studentId']);
        $appointment->setDescription($_REQUEST['description']);
        $appointment->setAppointmentType($_REQUEST['appointmentType']);
        $appointment->setPname($_REQUEST['pName']);

        $start = $_REQUEST['start'];
        $dateTime = explode(" ", $start);
        $date = $dateTime[3] . "-" . convertMonth($dateTime[1]) . "-" . $dateTime[2];
        $startTime = $dateTime[4];
        $duration = $_REQUEST['duration'];
        $endTime = $this->addTime($startTime, $duration);

        $appointment->setAdvisingDate($date);
        $appointment->setAdvisingStartTime($startTime);
        $appointment->setAdvisingEndTime($endTime);

        $dbManager = new DatabaseManager();
        $result = $dbManager->createAppointment($appointment, $_REQUEST['email']);
        if (!isset($result['response']) || !$result['response']) {
            return [
                "error" => 1
            ];
        }

        if ($result['student_notify'] == 'yes') {
            mav_mail("MavAppoint: Advising appointment with " . $appointment->getPname(),
                "\nAn appointment has been set for " . $appointment->getAppointmentType() . " on " . $appointment->getAdvisingDate() . " at " .
                $appointment->getAdvisingStartTime() . " - " . $appointment->getAdvisingEndTime() . "\nPlease arrive on time! Thanks!",
                [$_REQUEST['email']]);
        }

        if ($result['advisor_notify'] == 'yes') {
            mav_mail("MavAppoint: Advising appointment with " . $appointment->getStudentId(),
                "\nAn appointment has been set for " . $appointment->getAppointmentType() . " on " . $appointment->getAdvisingDate() . " at " .
                $appointment->getAdvisingStartTime() . " - " . $appointment->getAdvisingEndTime(),
                [$result['advisor_email']]);
        }

        return [
            "error" => 0,
        ];
    }

    public function showAppointmentAction() {
        $dbManager = new DatabaseManager();
        $user = $dbManager->getStudent($_SESSION['email']);
        return [
            "error" => 0,
            "data" => [
                "appointments" => $this->getAppointments($user, $dbManager)
            ]
        ];
    }

    public function cancelAppointmentAction() {
        $appointmentId = $_REQUEST['appointmentId'];
        $dbManager = new DatabaseManager();
        $appointment = $dbManager->getAppointmentById($appointmentId);
        $result = $dbManager->cancelAppointment($appointmentId);
        if (!$result || $appointment == null) {
            return [
                "error" => 1
            ];
        }

        mav_mail("Advising Appointment with " . $appointment->getPname() . " cancelled",
            "Your appointment on " . $appointment->getAdvisingDate() . " from " . $appointment->getAdvisingStartTime() .
            " to " . $appointment->getAdvisingEndTime() . " has been cancelled",
            [$appointment->getStudentEmail()]);

        mav_mail("Advising Appointment with Student Id: " . $appointment->getStudentId() . " cancelled",
            "Your appointment on " . $appointment->getAdvisingDate() . " from " . $appointment->getAdvisingStartTime() .
            " to " . $appointment->getAdvisingEndTime() . " has been cancelled",
            [$appointment->getAdvisorEmail()]);
//        $test = 1;
//        if ($appointment == null) {
//            $test = 2;
//        }
        return [
            "error" => 0,
        ];
    }


    public function successAction(){
        $controller = mav_encrypt($_REQUEST['nc']);
        $action = mav_encrypt($_REQUEST['na']);
        return [
            "error" => 0,
            //TODO: change url
            "data" => "http://http://mavappont_php_master.sites.dev/MavAppoint_PHP/?c=$controller&a=$action"
        ];
    }







    private function getAppointments(StudentUser $user, DatabaseManager $dbManager) {
        $appointments = $dbManager->getAppointments($user);
        $tempAppointments = array_map(function(Appointment $appointment){
            return [
                "pName" => $appointment->getPname(),
                "advisingDate" => $appointment->getAdvisingDate(),
                "advisingStartTime" => $appointment->getAdvisingStartTime(),
                "advisingEndTime" => $appointment->getAdvisingEndTime(),
                "appointmentType" => $appointment->getAppointmentType(),
                "appointmentId" => $appointment->getAppointmentId(),
                "advisorEmail" => $appointment->getAdvisorEmail(),
                "description" => $appointment->getDescription(),
                "studentId" => "Advisor only",  //hidden
                "studentEmail" => $appointment->getStudentEmail(),
                "studentPhoneNumber" => $appointment->getStudentPhoneNumber()
            ];
        }, $appointments);

        return $tempAppointments;
    }

    private function addTime($startTime, $duration) {
        $tmp = explode(":", $startTime);
        $hours = $tmp[0];
        $minutes = $tmp[1] + $duration;
        if ($minutes >= 60) {
            $minutes -= 60;
            $hours += 1;

            if ($hours < 10) {
                $hours = "0" . $hours;
            }
        }

        if ($minutes < 10) {
            $minutes = "0" . $minutes;
        }
        $tmp[1] = $minutes;
        $tmp[0] = $hours;

        return join(":", $tmp);
    }
}