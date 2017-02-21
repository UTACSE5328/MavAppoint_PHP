<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 10:25
 */
class GetAppointment extends SQLCmd{
    private $date,$email;

    function __construct($date,$email) {
        $this->date = $date;
        $this->email = $email;
    }

    function queryDB(){
        $query = "SELECT date,start,end,type FROM appointments a,user u 
                  WHERE a.student_userid=u.userid AND u.email='$this->email' AND date >='$this->date' ORDER BY date,start LIMIT 1";
        $this->result = $this->conn->query($query)->fetch_assoc();
    }

    function processResult(){
        return $this->result;
    }
}
