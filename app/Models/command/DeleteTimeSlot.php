<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/21
 * Time: 14:33
 */
class DeleteTimeSlot extends SQLCmd{
    private $time, $id;

    function __construct(AllocateTime $time, $id) {
        $this->time = $time;
        $this->id = $id;
    }

    function queryDB(){
        $date = $this->time->getDate();
        $start = $this->time->getStartTime();
        $end = $this->time->getEndTime();

        $query = "DELETE from Advising_schedule 
                    WHERE userId = '$this->id'
                    AND date = '$date'
                    AND start >= '$start'
                    AND end <= '$end'";
        $this->result = $this->conn->query($query);
    }

    function processResult(){
        return $this->result;
    }
}