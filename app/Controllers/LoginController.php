<?php
namespace App\Controllers;

use Models\Db\DatabaseManager;
use Models\Bean\GetSet;

//session_start();
//$_SESSION['name'] = $name;
//session_destroy();
//require "BasicController.php";
//require MODEL_PATH."db/DatabaseManager.php";
class LoginController{
    public function defaultAction(){
        var_dump([
            "config" => config("testKey1.testKey2"),
            "env" => env("DB_DATABASE")
        ]);
//        include VIEW_PATH.'loginPage.php';

    }

    public function checkAction(){


        $email = $_POST['email'];
        $password = $_POST['password'];

        $manager = new DatabaseManager();


        //require_once MODEL_PATH."bean/GetSet.php";
        $set = new GetSet();
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
                include VIEW_PATH."admin_home_page.php";
//                header('Location:'.ROOT_URL.'/view/admin_page.php');

            }
            elseif($res['role']=='advisor'){
                //echo "advisor's page has not set";
                include VIEW_PATH."advisor_home_page.php";

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
        $this->DefaultAction();
    }



}


