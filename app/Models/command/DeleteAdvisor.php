<?php
namespace Models\Command;
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


        if(mysqli_affected_rows($this->conn) == 0)
            $this->result = false;
        else
            $this->result = true;
    }

    function processResult(){
        return $this->result;
    }
}