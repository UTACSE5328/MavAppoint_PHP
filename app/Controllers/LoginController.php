<?php
namespace App\Controllers;

use Models\Db as db;
use Models\Bean as bean;

//session_start();
//$_SESSION['name'] = $name;
//session_destroy();
//require "BasicController.php";
//require MODEL_PATH."db/DatabaseManager.php";
class LoginController{
    public function defaultAction(){
        return [
            "config" => config("testKey1.testKey2"),
            "env" => env("DB_DATABASE")
        ];
//        include VIEW_PATH.'loginPage.php';

    }

    public function checkAction(){


        $email = $_POST['email'];
        $password = $_POST['password'];

        $manager = new db\DatabaseManager();


        //require_once MODEL_PATH."bean/GetSet.php";
        $set = new bean\GetSet();
        $set->setEmail("$email");
        $set->setPassword("$password");
        $res = $manager->checkUser($set);



        if(!$res){
            die("login failed");
        }else{


            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $res['role'];
            $_SESSION['uid'] = $manager->getUserIdByEmail($email);

            if($res['role']=='admin'){
//                include VIEW_PATH."admin_home_page.php";
//                header('Location:'.ROOT_URL.'/view/admin_page.php');

            }
            elseif($res['role']=='advisor'){
//                return "return some parameters that saved in \$content can be used in this web page";
//                include VIEW_PATH."advisor_home_page.php";

            } elseif($res['role']=='student'){
                $this->GotoUrl("student's page has not implemented!",'?c=Login&a=Default',3);

            }
            elseif ($res['role']=='faculty'){
                $this->GotoUrl("faculty's page has not implemented",'?c=Login&a=Default',3);
            }
            //    echo json_encode($res).'</br>';
            //    echo "==============================</br>";
        }

    }

    public function logoutAction(){
        session_start();
        session_destroy();
//        $this->DefaultAction();
    }
    public function testAction(){
        include dirname(dirname(__FILE__))."/Models/test/test.php";
    }



}


