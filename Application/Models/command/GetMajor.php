<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 16:01
 */
class GetMajor extends SQLCmd{
    private $id;

    function __construct($id) {
        $this->id = $id;
    }

    function queryDB(){
        if($this->id == null)
            $query = "SELECT name FROM Major";
        else
            $query = "select name from major_user where userId ='$this->id'";

        $this->result = $this->conn->query($query)->fetch_assoc();
    }

    function processResult(){
        return $this->result;
    }
}