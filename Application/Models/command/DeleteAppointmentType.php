<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 7:22
 */

class DeleteAppointmentType extends SQLCmd{
    private $at,$id;

    function __construct(AppointmentType $at, $id) {
        $this->at = $at;
        $this->id = $id;
    }

    function queryDB(){
        $type = $this->at->getType();
        $duration = $this->at->getDuration();

        $query = "DELETE FROM appointment_types WHERE userid = '$this->id' and type = '$type' and duration = '$duration'";
        $this->result = $this->conn->query($query);
    }

    function processResult(){
        return $this->result;
    }
}