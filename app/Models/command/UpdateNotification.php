<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 16:58
 */
class UpdateNotification extends SQLCmd{

    private $user,$notification;

    function __construct(LoginUser $user, $notification) {
        $this->user = $user;
        $this->notification = &$notification;
    }

    function queryDB(){
        $id = $this->user->getUserId();
        if($this->user instanceof AdvisorUser) {
            $query = "UPDATE user_advisor SET notification = '$this->notification' WHERE userId = '$id'";
        }else{
            $query = "UPDATE user_student SET notification = '$this->notification' WHERE userId = '$id'";
        }
        $this->result = $this->conn->query($query);
    }

    function processResult(){
        return $this->result;
    }
}