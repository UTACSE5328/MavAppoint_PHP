<?php

/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/20/17
 * Time: 12:58 AM
 */
include_once dirname(dirname(__FILE__))."/Models/login/LoginUser.php";
include_once dirname(dirname(__FILE__))."/Models/login/AdvisorUser.php";

class adminController
{
    function loadHtmlAction(){
        include VIEW_PATH."create_advisor.php";

    }

    function createNewAdvisorAction(){
        $manager = new DatabaseManager();

        $department = $_POST['drp_department'];
        $email = $_POST['emailAddress'];
        $name = $_POST['pname'];

        $loginUser = new LoginUser();
        $loginUser->setEmail($email);
        $loginUser->setPassword("12345678");
        $loginUser->setRole("advisor");
        $loginUser->setDepartments(($department));

        $id = $manager->createUser($loginUser);

        $Advisor = new AdvisorUser();
        $Advisor->setUserId($id);
        $Advisor->setPName($name);
        $Advisor->setNotification("Yes");
        $Advisor->setNameLow("a");
        $Advisor->setNameHigh("Z");
        $Advisor->setDegType("7");

        $res=$manager->createAdvisor($Advisor);
        if($res)
        {
            echo "Advisor created successfully. An email has been sent to the advisor's account with his/her temporary password";
        }
        else{
            echo "Failed";
        }




//        echo "department:".$department."<br>";
//        echo "email:".$email."<br>";
//        echo "name:".$name."<br>";


    }

}