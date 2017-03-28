<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 8:04
 */

use Models\Helper\TimeSlotHelper;
use Models\PrimitiveTimeSlot;

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
//                $query = "SELECT id,User_Advisor.pName,date,start,end,studentId FROM Advising_Schedule,User_Advisor
//                            WHERE User_Advisor.userid=Advising_Schedule.userid
//                            AND User_Advisor.pname='$advisor' ";
                $query = "SELECT pname,date,start,end,id FROM USER,Advising_Schedule,User_Advisor
                          WHERE USER.userid=User_Advisor.userid AND USER.userid=Advising_Schedule.userid
                          AND USER.userid=Advising_Schedule.userid AND User_Advisor.pname= '$advisor' AND studentId is null";

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
        $PrimitiveTimeSlotArr = array();
        for($i=0;$i<$num;++$i){
            $rs = $this->result[$i];

            $set = new PrimitiveTimeSlot();
            $set->setName($rs["pname"]);
            $set->setDate($rs["date"]);
            $set->setStartTime($rs["start"]);
            $set->setEndTime($rs["end"]);
            $set->setUniqueid($rs["id"]);
            array_push($PrimitiveTimeSlotArr, serialize($set));
        }

        $compositeTimeSlotArr = TimeSlotHelper::createCompositeTimeSlot2($PrimitiveTimeSlotArr);

        return $compositeTimeSlotArr;
    }
}