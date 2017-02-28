<?php
namespace App\Controllers;
/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/20/17
 * Time: 12:58 AM
 */
//include_once dirname(dirname(__FILE__))."/Models/login/LoginUser.php";
//include_once dirname(dirname(__FILE__))."/Models/login/AdvisorUser.php";
use Models\Db as db;
use Models\Login as login;
class adminController
{
    function showCreateAdvisorFormAction(){
//        include VIEW_PATH."create_advisor.php";

    }

    function createNewAdvisorAction(){
        $manager = new db\DatabaseManager();

        $department = $_POST['drp_department'];
        $email = $_POST['emailAddress'];
        $name = $_POST['pname'];

        $loginUser = new login\LoginUser();
        $loginUser->setEmail($email);
        $loginUser->setPassword("12345678");
        $loginUser->setRole("advisor");
        $loginUser->setDepartments(($department));

        $id = $manager->createUser($loginUser);

        $Advisor = new login\AdvisorUser();
        $Advisor->setUserId($id);
        $Advisor->setPName($name);
        $Advisor->setNotification("Yes");
        $Advisor->setNameLow("a");
        $Advisor->setNameHigh("Z");
        $Advisor->setDegType("7");

        $res=$manager->createAdvisor($Advisor);
        if($res)
        {
            return "Advisor created successfully. An email has been sent to the advisor's account with his or her temporary password";
        }
        else{
            return "Failed";
        }




//        echo "department:".$department."<br>";
//        echo "email:".$email."<br>";
//        echo "name:".$name."<br>";


    }

}