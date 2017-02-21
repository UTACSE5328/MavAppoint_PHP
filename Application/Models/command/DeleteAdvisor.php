<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 16:32
 */
class DeleteAdvisor extends SQLCmd{
    private $id;

    function __construct($id) {
        $this->id = $id;
    }

    function queryDB(){

        $query = "DELETE FROM appointments WHERE advisor_userId = '$this->id'";
        $this->conn->query($query);

        $query = "DELETE FROM advising_schedule WHERE userId = '$this->id'";
        $this->conn->query($query);

        $query = "DELETE FROM department_user WHERE userId = '$this->id'";
        $this->conn->query($query);

        $query = "DELETE FROM major_user WHERE userId = '$this->id'";
        $this->conn->query($query);

        $query = "DELETE FROM appointment_types WHERE userId = '$this->id'";
        $this->conn->query($query);

        $query = "DELETE FROM user_advisor WHERE userId = '$this->id'";
        $this->conn->query($query);

        /*
        $query = "DELETE FROM user WHERE userId = '$this->id'";
        $this->conn->query($query);*/

        $this->result = true;
    }

    function processResult(){
        return $this->result;
    }
}