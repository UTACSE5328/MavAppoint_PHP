<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 6:17
 */
namespace Models\Command;

class SetCutOffTime extends SQLCmd{

    private $time,$id;

    function __construct($time, $id) {
        $this->id = $id;
        $this->time = $time;
    }

    function queryDB(){
        $query = "UPDATE  user_advisor set cutofftime = '$this->time' where userId = '$this->id'";
        $this->result = $this->conn->query($query);
    }

    function processResult(){
        return $this->result;
    }
}