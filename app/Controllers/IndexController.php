<?php

namespace App\Controllers;


class IndexController
{
    public function defaultAction(){
        $arr = array(
            "error" => 0
        );

        if (isset($_GET['role'])) {
            $arr['role'] = $_GET['role'];
        }

        return $arr;
    }
}