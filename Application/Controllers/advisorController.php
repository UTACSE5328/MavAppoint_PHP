<?php

/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/20/17
 * Time: 12:58 AM
 */
require "BasicController.php";
require MODEL_PATH."user/advisorModel.php";
class advisorController extends BasicController
{
    function ShowScheduleAction(){
        session_start();
        $email=$_SESSION['email'];
        $advisormodel = new advisorModel();
        $advisor = $advisormodel->getAdvisor($email);
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


        include VIEW_PATH."advisor_update_schedule.html";
    }

    function AddTimeSlotAction(){

        echo $_POST['starttime']."<br>";
        echo $_POST['endtime']."<br>";
        echo $_POST['opendate']."<br>";
        echo $_POST['repeat'];

    }


}