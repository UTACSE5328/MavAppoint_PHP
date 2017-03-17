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
        parent::__construct();
        session_start();
        $this->email = isset($_SESSION['email']) ? $_SESSION['email']: null;
        $this->uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
        $this->role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
    }

    function showScheduleAction(){;
//        $processSchedule = new ProcessAdvisorSchedule();
//        $advisor = $processSchedule->getAdvisor($this->email);
//        $arr =array();
//        array_push($arr,$advisor['pName']);
//        return $processSchedule->getModifiedSchedulesForShow($arr);

        if($this->role =="advisor" && $this->email!=null){
            $dbm = new DatabaseManager();
            $advisor = $dbm->getAdvisor($this->email);
            $schedules = $dbm->getAdvisorSchedule($advisor['pName']);
            if(sizeof($schedules)!=0){
                $validSchedule = array();
                for($i=0;$i<sizeof($schedules);$i++){

                    $schedule = unserialize($schedules[$i]);
                    $startDate = $schedule->getDate();
                    date_default_timezone_set('UTC');
                    $todayDate = date("Y-m-d");

                    if($startDate>$todayDate)
                    {
                        array_push($validSchedule, serialize($schedule));
                    }

                }
                session_start();
                $_SESSION['schedule'] = $validSchedule;


            }



//            if(isset($schedule)){
//                session_start();
//                $_SESSION['schedule'] = $schedule;
//            }

        }


        return [
            "error" => 0,
            "data" => [
                "email" =>$this->email,
                "advisorName" => $advisor['pName'],
                "role" => $this->role,
                "validSchedule" =>$validSchedule
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
        $dbm->addTimeSlot($time, $this->uid);
        for($i=0;$i<$rep;$i++){
            $time->setDate(TimeSlotHelper::addDate($time->getDate(),1) );
            $dbm->addTimeSlot($time, $this->uid);
        }



        return $this->showScheduleAction();




    }


}