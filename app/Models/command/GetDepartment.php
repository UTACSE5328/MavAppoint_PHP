<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 17:06
 */

class GetDepartment extends SQLCmd{
    private $id;

    function __construct($id) {
        $this->id = $id;
    }

    function queryDB(){
        if($this->id == null)
            $query = "SELECT name FROM Department";
        else
            $query = "select name from department_user where userId ='$this->id'";

        $this->result = $this->conn->query($query)->fetch_assoc();
    }

    function processResult(){
        return $this->result;
    }
}