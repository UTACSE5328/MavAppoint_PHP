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
    public function addAdvisorAction(){
//        $manager = new db\DatabaseManager();
//        $manager->getDepartments()
        return [
            "department" => [
                0 => [
                    "name" => "CSE"
                ],
                1 => [
                    "name" => "MATH"
                ],
                2 => [
                    "name" => "MAE"
                ],
                3 => [
                    "name" => "ARCH"
                ],
            ]
        ];
    }

    function createNewAdvisorAction(){
        $manager = new db\DatabaseManager();

        $department = $_REQUEST['drp_department'];
        $email = $_REQUEST['email'];
        $name = $_REQUEST['pname'];

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
            return [
                "error" => 0,
                "data" => [
                    "message" => "Advisor created successfully. An email has been sent to the advisor's account with his/her temporary password"
                ]
            ];
//            return "Advisor created successfully. An email has been sent to the advisor's account with his/her temporary password";
        } else {
            return [
                "error" => 1,
                "data" => [
                    "message" => "Fail"
                ]
            ];
//            return "Failed";
        }




//        echo "department:".$department."<br>";
//        echo "email:".$email."<br>";
//        echo "name:".$name."<br>";


    }

}