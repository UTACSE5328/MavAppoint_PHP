<?php
namespace Models\User;
/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/20/17
 * Time: 1:25 PM
 */
//require MODEL_PATH."/db/DatabaseManager.php";
use Models\Db\DatabaseManager;
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
        $res = $this->manager->getAdvisor($email);

        return $res;
    }

    function getAdvisorSchedules($arr){

        $res = $this->manager->getAdvisorSchedules($arr);

        $arrForDisplay=array();
        date_default_timezone_set('UTC');
        $nowtime= date("Y-m-d");


        if(sizeof($res)==1 && $res[0]['date']>$nowtime && $res[0]['studentId']==null) {
            $displayArr = [
                'title' => $res[0]['pName'],
                'start' => $res[0]['date'] . 'T' . $res[0]['start'],
                'end' => $res[0]['date'] . 'T' . $res[0]['end'],
                'id' => 0,
                'backgroundColor' => 'blue'
            ];
            array_push($arrForDisplay, $displayArr);
        }
        else {

            $benginDateIndex=0;
            for($i=0; $i<sizeof($res);$i++){
                if($res[$i]['date']>$nowtime && $res[$i]['studentId']==null){
                    $benginDateIndex=$i;
                    break;

                }
            }
            if($benginDateIndex<sizeof($res)){
                $date=$res[$benginDateIndex]['date'];
                $starttime=$res[$benginDateIndex]['start'];
                $endtime=$res[$benginDateIndex]['end'];

                $id=0;
                for($i=$benginDateIndex+1 ; $i<sizeof($res); $i++){
                    if($res[$i]['studentId']==null){

                        if ($res[$i]['date']==$date && $res[$i]['start']==$endtime ){
                            $endtime=$res[$i]['end'];//merge time range
                        }
                        else{
                            $displayArr=[
                                'title'=> $res[$i]['pName'],
                                'start'=> $date.'T'.$starttime,
                                'end'=> $date.'T'.$endtime,
                                'id' =>$id,
                                'backgroundColor' => 'blue'
                            ];
                            array_push($arrForDisplay,$displayArr);

                            $date=$res[$i]['date'];
                            $starttime=$res[$i]['start'];
                            $endtime=$res[$i]['end'];
                            $id++;
                        }

                        if($i==sizeof($res)-1){
                            $displayArr=[
                                'title'=> $res[$i]['pName'],
                                'start'=> $date.'T'.$starttime,
                                'end'=> $date.'T'.$endtime,
                                'id' =>$id,
                                'backgroundColor' => 'blue'
                            ];
                            array_push($arrForDisplay,$displayArr);

                        }

                    }

                }

            }

            $id=-1;
            for($i=0;$i<sizeof($res);$i++){
                if ($res[$i]['studentId']!=null){
                    $displayArr=[
                        'title'=> $res[$i]['pName'],
                        'start'=> $res[$i]['date'].'T'.$res[$i]['start'],
                        'end'=> $res[$i]['date'].'T'.$res[$i]['end'],
                        'id' =>$id,
                        'backgroundColor' => 'orange'
                    ];
                    array_push($arrForDisplay,$displayArr);
                    $id--;

                }

            }






        }


      

        return $arrForDisplay;
    }





}