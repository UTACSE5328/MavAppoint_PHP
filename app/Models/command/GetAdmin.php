<?php
namespace Models\Command;
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 2017/2/14
 * Time: 7:28
 */
class GetAdmin extends SQLCmd{
    private $email;

    function __construct($email) {
        $this->email = $email;
    }

    function queryDB(){
        $query = "SELECT * FROM User where EMAIL='$this->email'";
        $this->result = $this->conn->query($query)->fetch_assoc();
    }

    function processResult(){
        return $this->result;
    }
}