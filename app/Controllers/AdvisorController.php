<?php

/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/20/17
 * Time: 12:58 AM
 */
require "BasicController.php";
require MODEL_PATH."user/advisorModel.php";
include_once MODEL_PATH."/bean/AllocateTime.php";
class advisorController extends BasicController
{
    private $email;
    private $uid;
    function __construct()
    {
        session_start();
        $this->email=$_SESSION['email'];
        $this->uid=$_SESSION['uid'];
    }

    function ShowScheduleAction(){

        $advisormodel = new advisorModel();
        $advisor = $advisormodel->getAdvisor($this->email);
//        echo json_encode($advisor).'</br>';
//        echo "==============================</br>";
        $arr =array();

        array_push($arr,$advisor['pName']);


        $schedules = $advisormodel->getAdvisorSchedules($arr);



//        echo json_encode($schedules).'</br>';
//        echo "==============================</br>";

//        date_default_timezone_set('UTC');
//        $nowtime= date("Y-m-d");
//        $testtime = '2017-02-19';
//        if($nowtime>$testtime){
//            echo "nowtime:".$nowtime." >" ."testtime:".$testtime;
//
//        }
//        else{
//            echo "testtime:".$testtime." >" ."nowtime:".$nowtime;
//        }


        include VIEW_PATH."advisor_update_schedule.php";
    }

    function AddTimeSlotAction(){
        $manager = new DatabaseManager();
        $time = new AllocateTime();
        $time->setDate($_POST['opendate']);
        $time->setStartTime($_POST['starttime']);
        $time->setEndTime($_POST['endtime']);
        $res = $manager->addTimeSlot($time, $this->uid);
        $this->ShowScheduleAction();




    }


}