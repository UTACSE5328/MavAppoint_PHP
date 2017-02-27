<?php
namespace App\Controllers;
/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/20/17
 * Time: 12:58 AM
 */
use Models\User\ProcessAdvisorSchedule;
use Models\Db\DatabaseManager;
use Models\Bean\AllocateTime;
class advisorController extends BasicController
{
    private $email;
    private $uid;
    function __construct()
    {
        parent::__construct();
        session_start();
        $this->email=$_SESSION['email'];
        $this->uid=$_SESSION['uid'];
    }

    function ShowScheduleAction(){;
        $processSchedule = new ProcessAdvisorSchedule();
        $advisor = $processSchedule->getAdvisor($this->email);
        $arr =array();
        array_push($arr,$advisor['pName']);
        return $processSchedule->getModifiedSchedulesForShow($arr);


    }

    function AddTimeSlotAction(){
        $manager = new DatabaseManager();
        $time = new AllocateTime();
        $time->setDate($_POST['opendate']);
        $time->setStartTime($_POST['starttime']);
        $time->setEndTime($_POST['endtime']);
        $res = $manager->addTimeSlot($time, $this->uid);
        return $this->ShowScheduleAction();




    }


}