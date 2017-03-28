<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 6:17
 */
namespace Models\Command;
use Models\Bean\AppointmentType;
//include_once dirname(dirname(__FILE__))."/bean/AppointmentType.php";

class AddAppointmentType extends SQLCmd{

    private $at,$id;

    function __construct($id, AppointmentType $at) {
        $this->at = $at;
        $this->id = $id;
    }

    function queryDB(){
        if($this->at != null &&
            $this->at->getDuration() > 0) {
            $type = $this->at->getType();
            $duration = $this->at->getDuration();

            $query = "INSERT INTO Appointment_Types (userid, type, duration) values('$this->id','$type','$duration')";
            $this->result = $this->conn->query($query);
        }else
            $this->result = false;
    }

    function processResult(){
        return $this->result;
    }
}