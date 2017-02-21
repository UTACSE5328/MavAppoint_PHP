<?php
/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/16/17
 * Time: 5:44 PM
 */

//session_start();
//$_SESSION['name'] = $name;
//session_destroy();
require "BasicController.php";
//require MODEL_PATH."db/DatabaseManager.php";
class LoginController extends BasicController{
    function DefaultAction(){
        include VIEW_PATH.'loginPage.html';

    }

    function CheckAction(){


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
            if($res['role']=='admin'){
                include VIEW_PATH."admin_home_page.html";
//                header('Location:'.ROOT_URL.'/view/admin_page.php');

            }
            elseif($res['role']=='advisor'){
                //echo "advisor's page has not set";
                include VIEW_PATH."advisor_home_page.html";

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


}


