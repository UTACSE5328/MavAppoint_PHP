<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 15:08
 */
class TimeSlotHelper {
    function count($start,$end){
        $start_split = explode(':',$start);
        $end_split = explode(':',$end);

        $start_h = $start_split[0];
        $end_h = $end_split[0];

        $start_m = $start_split[1];
        $end_m = $end_split[1];

        $arr = array();

        if ($start_h == $end_h){
            for($j = $start_m; $j < $end_m; $j = $j + 5){
                $timeArr = array(
                    "start"=> ($start_h.":".$j),
                    "end"=>($end_h.":".($j+5))
                );

                array_push($arr,$timeArr);
            }
		}else
            for ($i = $start_h; $i <= $end_h; $i++){
                if($i == $start_h){
                    for ($j = $start_m; $j < 60; $j=$j+5){
                        $timeArr = array(
                            "start"=> ($start_h.":".$j),
                            "end"=>($start_h.":".($j+5))
                        );

                        array_push($arr,$timeArr);
                    }
                }
                elseif ($i != $end_h && count($arr) != 0){
                    for ($j = 0; $j < 60; $j = $j + 5){
                        $timeArr = array(
                            "start"=> ($i.":".$j),
                            "end"=>($i.":".($j+5))
                        );

                        array_push($arr,$timeArr);
                    }
                }
                elseif ($i == $end_h){
                    for($j=0;$j<$end_m;$j=$j+5){
                        $timeArr = array(
                            "start"=> ($end_h.":".$j),
                            "end"=>($end_h.":".($j+5))
                        );

                        array_push($arr,$timeArr);
                    }
                }
            }
		return $arr;
    }
}