<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 8:04
 */
include_once dirname(dirname(__FILE__))."/login/AdvisorUser.php";

class GetAdvisorSchedules extends SQLCmd{
    private $advisors;
    private $available;

    function __construct(array $advisors, $available) {
        $this->advisors = $advisors;
        $this->available = $available;
    }

    function queryDB(){
        $num = count($this->advisors);
        $arr = array();
        for($i=0;$i<$num;++$i) {
            $advisor = $this->advisors[$i];
            if ($this->available) {
                $query = "SELECT pname,date,start,end,id FROM USER,Advising_Schedule,User_Advisor 
                        WHERE USER.userid=User_Advisor.userid AND USER.userid=Advising_Schedule.userid 
                        AND USER.userid=Advising_Schedule.userid AND User_Advisor.pname='$advisor' AND studentId is null";
                $res = $this->conn->query($query)->fetch_assoc();
                if($res != null)
                array_push($arr, $res);
            } else {
                $query = "SELECT pname,date,start,end,id FROM USER,Advising_Schedule,User_Advisor 
                            WHERE USER.userid=User_Advisor.userid AND USER.userid=Advising_Schedule.userid 
                            AND USER.userid=Advising_Schedule.userid AND User_Advisor.pname='$advisor' AND studentId is not null";
                $res = $this->conn->query($query)->fetch_assoc();
                if($res != null)
                    array_push($arr, $res);
            }
        }

        $this->result = $arr;
    }

    function processResult(){
        return $this->result;
    }
}