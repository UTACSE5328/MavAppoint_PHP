<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/21
 * Time: 14:33
 */
use Models\Bean\AllocateTime;
class DeleteTimeSlot extends SQLCmd{
    private $time;

    function __construct(AllocateTime $time) {
        $this->time = $time;

    }

    function queryDB(){
        $date = $this->time->getDate();
        $start = $this->time->getStartTime();
        $end = $this->time->getEndTime();
        $pname = $this->time->getEmail();// 'email' of the AllocateTime object stored pname

        $query = "DELETE a FROM advising_schedule a JOIN User_Advisor b ON a.userid=b.userid WHERE date='$date' AND start >='$start' AND end <='$end'"
            ."AND b.pname='$pname'";

        $this->result = $this->conn->query($query);
    }

    function processResult(){
        return $this->result;
    }
}