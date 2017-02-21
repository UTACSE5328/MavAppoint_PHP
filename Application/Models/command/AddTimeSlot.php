<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 14:59
 */
class AddTimeSlot extends SQLCmd {
    private $time,$id;

    function __construct(AllocateTime $time, $id) {
        $this->time = $time;
        $this->id = $id;
    }

    function queryDB(){
        $cmd = new GetUserIdByEmail($this->time->getEmail());
        $userid = $cmd->execute();
        $date = $this->time->getData();
        $start = $this->time->getStartTime();
        $end = $this->time->getEndTime();

        $query = "SELECT COUNT(*) FROM  ADVISING_SCHEDULE WHERE date='$date' AND start >='$start' AND end <='$end' AND userid='$userid'";
        $res = ($this->conn->query($query)->fetch_assoc())['count(*)'];

        if($res == 0) {
            $query = "INSERT INTO ADVISING_SCHEDULE (date,start,end,studentid,userid) VALUES(?,?,?,null,?)";
            $this->result = $this->conn->query($query)->fetch_assoc();
        }
    }

    function processResult(){
        return $this->result;
    }
}