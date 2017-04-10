<?php
namespace App\Controllers;
/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/20/17
 * Time: 12:58 AM
 */
use Models\Db\DatabaseManager;
use Models\Bean\AllocateTime;
use Models\Helper\TimeSlotHelper;
use Models\Bean\Appointment;

class advisorController
{
    private $email;
    private $uid;
    private $role;
    function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->email = isset($_SESSION['email']) ? $_SESSION['email']: null;
        $this->uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
        $this->role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
    }

    function showScheduleAction(){;
        if (!isset($_SESSION['role'])) {
            //TODO: change url
            header('Location:http://' . 'mavappont_php_master.sites.dev/MavAppoint_PHP/?c=' . mav_encrypt("login"));
        }

        if($this->role =="advisor" && $this->email!=null){
            $dbm = new DatabaseManager();
            $advisor = $dbm->getAdvisor($this->email);
            $scheduleObjectArr = $dbm->getAdvisorSchedule($advisor->getPName());
            if (sizeof($scheduleObjectArr) != 0) {
                foreach ($scheduleObjectArr as $schedule){
                    $tempSchedules[] = [
                        "name" => $schedule->getName(),
                        "date" => $schedule->getDate(),
                        "startTime" => $schedule->getStartTime(),
                        "endTime" => $schedule->getEndTime(),

                    ];

                }



            }


            $appointments = $dbm->getAppointments($advisor);
            $tempAppointments = array_map(function(Appointment $appointment){
                return [
                    "advisingDate" => $appointment->getAdvisingDate(),
                    "advisingStartTime" => $appointment->getAdvisingStartTime(),
                    "advisingEndTime" => $appointment->getAdvisingEndTime(),
                    "appointmentType" => $appointment->getAppointmentType(),
                ];
            }, $appointments);


        }

        return [
            "error" => 0,
            "data" => [
                "email" =>$this->email,
                "advisorName" => $advisor->getPName(),
                "role" => $this->role,
                "schedules" =>$tempSchedules,
                "appointments" => $tempAppointments
            ]
        ];


    }

    function addTimeSlotAction(){

        $dbm = new DatabaseManager();
        $time = new AllocateTime();
        $time->setDate($_POST['opendate']);
        $time->setStartTime($_POST['starttime']);
        $time->setEndTime($_POST['endtime']);
        $repeat = $_POST['repeat'];
        try{
            $rep = intval($repeat);
        }catch (\Exception $e){
            $rep = 0;
        }

        date_default_timezone_set('America/Chicago');
        $todayDate = date("Y-m-d");
        if($time->getDate()<=$todayDate){
            return[
                "error" => 0,
                "dispatch" => "failure",
            ];
        }
        $flag = $dbm->addTimeSlot($time, $this->uid);
        for($i=0;$i<$rep;$i++){
            $time->setDate(TimeSlotHelper::addDate($time->getDate(),1) );
            $flag = $dbm->addTimeSlot($time, $this->uid);
        }

        if($flag == false){
            return[
                "error" => 0,
                "dispatch" => "failure",
            ];
        }
        else
            return[
                "error" => 0,
                "dispatch" => "success",
            ];





    }


    function deleteTimeSlotAction(){
        $startTime = isset($_POST['StartTime2']) ? $_POST['StartTime2'] : null;
        $endTime = isset($_POST['EndTime2']) ? $_POST['EndTime2'] : null;
        $date = isset($_POST['Date']) ? $_POST['Date'] : null;
        $pName = isset($_POST['pname']) ? $_POST['pname'] : null;
        $repeat = isset($_POST['delete_repeat']) ? intval($_POST['delete_repeat']) : null;
        $reason = isset($_POST['delete_reason']) ? $_POST['delete_reason'] : null;

        DeleteTimeSlotController::deleteTimeSlot($date,$startTime,$endTime,$pName,$repeat,$reason);
        $dbm = new DatabaseManager();
        $studentEmails = $dbm->getStudentEmails();
        $emailSubject = 'MavAppoint: Advisor\'s advising time has been cancelled!';
        $msg = "Advising time slot of advisor " .$pName. " on " . $date. " at ". $startTime . "-" .$endTime." has been cancelled."
            ."\n" ."Reason: ". $reason  ;
//        mav_mail($emailSubject,$msg,$studentEmails);





        return [
            "error" => 0,
            "dispatch" => "success",


        ];
    }

//    public function successAction(){
//        return [
//            "error" => 0,
//            //TODO: change url
//            "data" => "http://localhost/MavAppoint_PHP/?c=" . mav_encrypt("advidor") . "&a=" . mav_encrypt("showSchedule")
//        ];
//    }




}