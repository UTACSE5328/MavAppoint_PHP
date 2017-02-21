<?php

/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/20/17
 * Time: 1:25 PM
 */
//require MODEL_PATH."/db/DatabaseManager.php";

class advisorModel
{
//    private $email=null;
    private $manager = null;
//    private $advisor = null;

    function __construct()
    {
//        $this->email = $email;
        $this->manager = new DatabaseManager();
    }

    function getAdvisor($email){
//        echo "getAdvisor</br>";
        $res = $this->manager->getAdvisor("$email");
        return $res;
    }

    function getAdvisorSchedules($arr){
        $res = $this->manager->getAdvisorSchedules($arr);
        $arrForDisplay=array();
        date_default_timezone_set('UTC');
        $nowtime= date("Y-m-d");


        for($i=0 ; $i<sizeof($res); $i++){
            if($res[$i]['date']<$nowtime){
                $displayArr=[
                    'title'=> $res[$i]['pname'],
                    'start'=> $res[$i]['date'].'T'.$res[$i]['start'],
                    'end'=> $res[$i]['date'].'T'.$res[$i]['end'],
                    'id' =>$i,
                    'backgroundColor' => 'blue'
                ];
                array_push($arrForDisplay,$displayArr);
            }

        }
        return $arrForDisplay;
    }





}