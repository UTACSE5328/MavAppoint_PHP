<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 6:44
 */
require "SQLCmd.php";
include_once dirname(dirname(__FILE__))."/bean/GetSet.php";
class CheckUser extends SQLCmd{
    private $set;

    function __construct(GetSet $set) {
        $this->set = $set;
    }

    function queryDB(){
        $email = $this->set->getEmail();
        $password = $this->set->getPassword();

        $query = "SELECT role FROM User where EMAIL='$email' AND PASSWORD='$password'";
        $this->result = $this->conn->query($query)->fetch_assoc();
    }

    function processResult(){
        return $this->result;
    }
}