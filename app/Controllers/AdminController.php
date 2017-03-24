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


class adminController extends BasicController
{
    private $email;
    private $uid;
    private $role;
    function __construct()
    {
        session_start();
        $this->email = isset($_SESSION['email']) ? $_SESSION['email']: null;
        $this->uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
        $this->role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
    }

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

    function showDepartmentScheduleAction()
    {
        if ($this->role == "admin" && $this->email != null) {
            $dbm = new db\DatabaseManager();
            $schedules = $dbm->getAdvisorSchedule("all");
            if (sizeof($schedules) != 0) {
                $validSchedule = array();
                for ($i = 0; $i < sizeof($schedules); $i++) {

                    $schedule = unserialize($schedules[$i]);
                    $startDate = $schedule->getDate();
                    date_default_timezone_set('UTC');
                    $todayDate = date("Y-m-d");

                    if ($startDate > $todayDate) {
                        array_push($validSchedule, serialize($schedule));
                    }

                }
                session_start();
                $_SESSION['departmentSchedule'] = $validSchedule;


            }

        }
    }


    function deleteTimeSlotAction(){
        $startTime = isset($_POST['StartTime2']) ? $_POST['StartTime2'] : null;
        $endTime = isset($_POST['EndTime2']) ? $_POST['EndTime2'] : null;
        $date = isset($_POST['Date']) ? $_POST['Date'] : null;
        $pName = isset($_POST['pname']) ? $_POST['pname'] : null;
        $repeat = isset($_POST['delete_repeat']) ? intval($_POST['delete_repeat']) : null;
        $reason = isset($_POST['delete_reason']) ? $_POST['delete_reason'] : null;

        $msg = DeleteTimeSlotController::deleteTimeSlot($date,$startTime,$endTime,$pName,$repeat,$reason);


        $this->showDepartmentScheduleAction();



        return [
            "error" => 0,
            "msg" => $msg,
            "isDispatch" => true,


        ];

    }



}