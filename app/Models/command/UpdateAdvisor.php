<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 16:13
 */
use Models\Login\AdvisorUser;
class UpdateAdvisor extends SQLCmd{
    private $user;

    function __construct(AdvisorUser $user) {
        $this->user = $user;
    }

    function queryDB(){
        $id = $this->user->getUserId();
        $pName = $this->user->getPName();
        $notification = $this->user->getNotification();
        $nameLow = $this->user->getNameLow();
        $nameHigh = $this->user->getNameHigh();
        $degreeType = $this->user->getDegType();

        if($id != null) {
            $query = "UPDATE User_Advisor SET pName='$pName', notification='$notification', 
                    name_low='$nameLow', name_high='$nameHigh', degree_types='$degreeType' WHERE userId='$id'";
        }else{
            $query = "UPDATE User_Advisor SET 
                    name_low='$nameLow', name_high='$nameHigh', degree_types='$degreeType' WHERE pName='$pName'";
        }

        $this->result = $this->conn->query($query);
    }

    function processResult(){
        if(mysqli_affected_rows($this->conn) > 0)
            return true;
        else
            return false;
    }
}