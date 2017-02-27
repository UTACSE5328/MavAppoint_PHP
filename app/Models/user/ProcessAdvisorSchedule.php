<?php
/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/27/17
 * Time: 3:02 AM
 */

namespace Models\User;
use Models\Db\DatabaseManager;
/**
 * Class ProcessAdvisorSchedule
 * @package Models\User
 */
class ProcessAdvisorSchedule
{
    private $manager = null;
    private $availableId = 0;
    private $unavailableId = -1;



    function __construct()
    {
        $this->manager = new DatabaseManager();
    }



    function getAdvisor($email){
        $res = $this->manager->getAdvisor($email);
        return $res;
    }


    function getModifiedSchedulesForShow($advisorName)
    {// Can only get one advisor's schedule each time.
        $res = $this->manager->getAdvisorSchedules($advisorName);
        if ($res == null) return null;

        $arrForDisplay = array();

        date_default_timezone_set('UTC');
        $nowtime = date("Y-m-d");

        //↓ merge available schedules record in database  and color it blue for display
        if (sizeof($res) == 1 && $res[0]['date'] > $nowtime && $res[0]['studentId'] == null) {
            $displayArr = [
                'title' => $res[0]['pName'],
                'start' => $res[0]['date'] . 'T' . $res[0]['start'],
                'end' => $res[0]['date'] . 'T' . $res[0]['end'],
                'id' => $this->availableId,
                'backgroundColor' => 'blue'
            ];
            array_push($arrForDisplay, $displayArr);
            $this->availableId++;
        } else {

            $benginDateIndex = 0;
            for ($i = 0; $i < sizeof($res); $i++) {
                if ($res[$i]['date'] > $nowtime && $res[$i]['studentId'] == null) {
                    $benginDateIndex = $i;
                    break;

                }
            }
            if ($benginDateIndex < sizeof($res)) {
                //save the first available schedule data in following 3 variables
                $date = $res[$benginDateIndex]['date'];
                $starttime = $res[$benginDateIndex]['start'];
                $endtime = $res[$benginDateIndex]['end'];


                for ($i = $benginDateIndex + 1; $i < sizeof($res); $i++) {
                    if ($res[$i]['studentId'] == null) { //only consider the available schedule(studentId==null).

                        if ($res[$i]['date'] == $date && $res[$i]['start'] == $endtime) {
                            $endtime = $res[$i]['end'];//merge time range
                        } else {
                            $displayArr = [
                                'title' => $res[$i]['pName'],
                                'start' => $date . 'T' . $starttime,
                                'end' => $date . 'T' . $endtime,
                                'id' => $this->availableId,
                                'backgroundColor' => 'blue'
                            ];
                            array_push($arrForDisplay, $displayArr);

                            $date = $res[$i]['date'];
                            $starttime = $res[$i]['start'];
                            $endtime = $res[$i]['end'];
                            $this->availableId++;
                        }
                    }

                }
                $displayArr = [
                    'title' => $advisorName,
                    'start' => $date . 'T' . $starttime,
                    'end' => $date . 'T' . $endtime,
                    'id' => $this->availableId,
                    'backgroundColor' => 'blue'
                ];
                array_push($arrForDisplay, $displayArr);
                $this->availableId++;

            }


        }


        //↓ process unavailable schedules:
        $benginDateIndex = 0;
        for ($i = 0; $i < sizeof($res); $i++) {
            if ($res[$i]['studentId'] != null) {
                $benginDateIndex = $i;
                break;

            }
        }
        if ($benginDateIndex < sizeof($res)) {
            //save the first unavailable schedule data in following 4 variables
            $date = $res[$benginDateIndex]['date'];
            $starttime = $res[$benginDateIndex]['start'];
            $endtime = $res[$benginDateIndex]['end'];
            $studentId = $res[$benginDateIndex]['studentId'];


            for ($i = $benginDateIndex + 1; $i < sizeof($res); $i++) {
                if ($res[$i]['studentId'] != null) { //only consider the available schedule(studentId!=null).

                    if ($res[$i]['date'] == $date && $res[$i]['start'] == $endtime && $res[$i]['studentId'] == $studentId) {
                        $endtime = $res[$i]['end'];//merge time range
                    } else {
//                        $appointment = ;
                        $displayArr = [
                            'title' => $this->manager->getAppointmentByStuId($studentId,$date)['type'],
                            'start' => $date . 'T' . $starttime,
                            'end' => $date . 'T' . $endtime,
                            'id' => $this->unavailableId,
                            'backgroundColor' => 'orange'
                        ];
                        array_push($arrForDisplay, $displayArr);

                        $date = $res[$i]['date'];
                        $starttime = $res[$i]['start'];
                        $endtime = $res[$i]['end'];
                        $studentId = $res[$i]['studentId'];
                        $this->unavailableId--;
                    }
                }

            }
            $displayArr = [
                'title' => $this->manager->getAppointmentByStuId($studentId,$date)['type'],
                'start' => $date . 'T' . $starttime,
                'end' => $date . 'T' . $endtime,
                'id' => $this->unavailableId,
                'backgroundColor' => 'orange'
            ];
            array_push($arrForDisplay, $displayArr);
            $this->unavailableId--;

        }


        return $arrForDisplay;



    }

}