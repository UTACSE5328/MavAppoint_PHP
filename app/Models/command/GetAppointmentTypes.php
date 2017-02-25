<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 15:11
 */
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
        $this->result = $this->conn->query($query)->fetch_assoc();
    }

    function processResult(){
        return $this->result;
    }
}