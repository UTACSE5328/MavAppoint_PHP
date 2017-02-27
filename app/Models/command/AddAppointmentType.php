<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 6:17
 */
namespace Models\Command;
//include_once dirname(dirname(__FILE__))."/bean/AppointmentType.php";

class AddAppointmentType extends SQLCmd{

    private $at,$id;

    function __construct(AppointmentType $at, $id) {
        $this->at = $at;
        $this->id = $id;
    }

    function queryDB(){
        $type = $this->at->getType();
        $duration = $this->at->getDuration();

        $query = "INSERT INTO Appointment_Types (userid, type, duration) values('$this->id','$type','$duration')";
        $this->result = $this->conn->query($query);
    }

    function processResult(){
        return $this->result;
    }
}