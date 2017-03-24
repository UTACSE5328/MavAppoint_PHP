<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 15:11
 */
use Models\bean\AppointmentType;
class GetAppointmentTypes extends SQLCmd{
    private $pName;

    function __construct($pName) {
        $this->pName = $pName;
    }

    function queryDB(){
        $query = "SELECT type,duration,user.email 
                  FROM  Appointment_Types,User_Advisor,user 
                  WHERE Appointment_Types.userid=User_Advisor.userid 
                  AND User_Advisor.userid=user.userid AND User_Advisor.pname='$this->pName'";
        $this->result = $this->conn->query($query);
    }

    function processResult(){
        $arr = array();
        while($rs = mysqli_fetch_array($this->result)){
            $set = new AppointmentType();
            $set->setType($rs["type"]);
            $set->setDuration($rs["duration"]);
            $set->setType($rs["type"]);
            array_push($arr, ($set));
        }

        return $arr;
    }
}