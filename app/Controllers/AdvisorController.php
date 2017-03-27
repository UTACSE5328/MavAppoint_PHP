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

class advisorController extends BasicController
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
        if($this->role =="advisor" && $this->email!=null){
            $dbm = new DatabaseManager();
            $advisor = $dbm->getAdvisor($this->email);
            $scheduleObjectArr = $dbm->getAdvisorSchedule($advisor->getPName());
            if (sizeof($scheduleObjectArr) != 0) {
                $schedules = array();
                for ($i = 0; $i < sizeof($scheduleObjectArr); $i++) {

                    $scheduleObject = $scheduleObjectArr[$i];
                    array_push($schedules,
                        [
                            "title" => $scheduleObject->getName(),
                            "start" => $scheduleObject->getDate() . "T" . $scheduleObject->getStartTime(),
                            "end" => $scheduleObject->getDate() . "T" . $scheduleObject->getEndTime(),
                            "id" => $i,
                            "backgroundColor" => 'blue'
                        ]
                    );

                }


            }
        }

        return [
            "error" => 0,
            "data" => [
                "email" =>$this->email,
                "advisorName" => $advisor->getPName(),
                "role" => $this->role,
                "schedule" =>$schedules
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
        $msg = "Advising time of advisor " .$pName. ": " . $date. "  ". $startTime . "~" .$endTime." has been cancelled."
            ."\n" ."Reason: ". $reason  ;
            $this->notifyAllStudent($emailSubject,$msg,$studentEmails);




        return [
            "error" => 0,
            "msg" => $msg,
            "dispatch" => "success",


        ];
    }



}