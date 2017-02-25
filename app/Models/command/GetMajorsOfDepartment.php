<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 17:11
 */
class GetMajorsOfDepartment extends SQLCmd{
    private $name;

    function __construct($name) {
        $this->name = $name;
    }

    function queryDB(){
        $query = "SELECT name from major where dep_name='$this->name'";

        $this->result = $this->conn->query($query)->fetch_assoc();
    }

    function processResult(){
        return $this->result;
    }
}