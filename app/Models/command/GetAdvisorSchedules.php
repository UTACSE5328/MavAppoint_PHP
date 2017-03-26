<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 8:04
 */
use Models\bean\AdvisingSchedule;

class GetAdvisorSchedules extends SQLCmd{
    private $advisors,$available;

    function __construct(array $advisors, $available) {
        $this->advisors = $advisors;
        $this->available = $available;
    }

    function queryDB(){
        $num = count($this->advisors);
        $arr = array();
        for($i=0;$i<$num;++$i) {
            $advisor = $this->advisors[$i];

            if($this->available)
                $query = "SELECT id,User_Advisor.pName,date,start,end,studentId FROM Advising_Schedule,User_Advisor 
                            WHERE User_Advisor.userid=Advising_Schedule.userid 
                            AND User_Advisor.pname='$advisor' ";
            else
                $query = "SELECT id,User_Advisor.pName,date,start,end,studentId FROM Advising_Schedule,User_Advisor 
                            WHERE User_Advisor.userid=Advising_Schedule.userid 
                            AND User_Advisor.pname='$advisor' 
                            AND Advising_Schedule.studentId is not null";

            $res = $this->conn->query($query);

            while($rs = mysqli_fetch_assoc($res)){
                array_push($arr, $rs);
            }
        }
        $this->result = $arr;
    }

    function processResult(){
        $num = count($this->result);
        $arr = array();
        for($i=0;$i<$num;++$i){
            $rs = $this->result[$i];

            $set = new AdvisingSchedule();
            $set->setUniqueid($rs["id"]);
            $set->setName($rs["pName"]);
            $set->setStartTime($rs["start"]);
            $set->setEndTime($rs["end"]);
            $set->setStudentId($rs["studentId"]);
            array_push($arr, serialize($set));
        }

        return $arr;
    }
}