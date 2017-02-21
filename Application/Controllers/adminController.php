<?php

/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/20/17
 * Time: 12:58 AM
 */
class adminController
{
    function loadHtmlAction(){
        include VIEW_PATH."create_advisor.html";

    }

    function createNewAdvisorAction(){

        $department = $_POST['drp_department'];
        $email = $_POST['emailAddress'];
        $name = $_POST['pname'];


        echo "Advisor created successfully. An email has been sent to the advisor's account with his/her temporary password";


//        echo "department:".$department."<br>";
//        echo "email:".$email."<br>";
//        echo "name:".$name."<br>";


    }

}