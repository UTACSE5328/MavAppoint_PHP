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
    private $dep;

    function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }

        $this->email = isset($_SESSION['email']) ? $_SESSION['email']: null;
        $this->uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
        $this->role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
    }

    public function addAdvisorAction(){
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
        $loginUser->setPassword("password");
        $loginUser->setRole("advisor");
        $loginUser->setDepartments(($department));
        $loginUser->setMajors("Software Engineering");


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
                    "message" => "Advisor created successfully. An email has been sent to the advisor's account with his/her temporary password",


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
        if (!isset($_SESSION['role'])) {
            header("Location:" . getUrlWithoutParameters() . "?c=" .mav_encrypt("login"));
        }

        if ($this->role == "admin" && $this->email != null) {
            $dbm = new db\DatabaseManager();
            $adminUser = $dbm->getAdmin($this->email);
            $appointments = $dbm->getAppointments($adminUser);
            if(sizeof($appointments) != 0 ){
                foreach ($appointments as $appointment){



                    $advisor = $dbm->getAdvisor($appointment->getAdvisorEmail());
                    $tempSchedules[] = [
                            "advisingDate" => $appointment->getAdvisingDate(),
                            "advisingStartTime" => $appointment->getAdvisingStartTime(),
                            "advisingEndTime" => $appointment->getAdvisingEndTime(),
//                            "appointmentType" => $appointment->getAppointmentType()
                            "appointmentType" => $appointment->getAppointmentType()." - ".$advisor->getPName()
                        ];


                }

            }

            $scheduleObjectArr = $dbm->getAdvisorSchedule("all");
            if (sizeof($scheduleObjectArr) != 0) {
                foreach ($scheduleObjectArr as $schedule){
                    $tempSchedules[] = [
                        "name" => $schedule->getName(),
                        "date" => $schedule->getDate(),
                        "startTime" => $schedule->getStartTime(),
                        "endTime" => $schedule->getEndTime(),

                    ];

                }



            }


        }
        return [
            "error" => 0,
            "data" => [
                "email" =>$this->email,
                "role" => $this->role,
                "schedules" =>$tempSchedules,
                "appointments" => $tempSchedules
            ]
        ];
    }


    function deleteTimeSlotAction(){
        $startTime = isset($_POST['StartTime2']) ? $_POST['StartTime2'] : null;
        $endTime = isset($_POST['EndTime2']) ? $_POST['EndTime2'] : null;
        $date = isset($_POST['Date']) ? $_POST['Date'] : null;
        $pName = isset($_POST['pname']) ? $_POST['pname'] : null;
        $repeat = isset($_POST['delete_repeat']) ? intval($_POST['delete_repeat']) : null;
        $reason = isset($_POST['delete_reason']) ? $_POST['delete_reason'] : null;

        DeleteTimeSlotController::deleteTimeSlot($date,$startTime,$endTime,$pName,$repeat,$reason);
        $dbm = new db\DatabaseManager();
        $studentEmails = $dbm->getStudentEmails();
        $emailSubject = 'MavAppoint: Advisor\'s advising time has been cancelled!';
        $msg = "Advising time slot of advisor " .$pName. " on " . $date. " at ". $startTime . "-" .$endTime." has been cancelled."
            ."\n" ."Reason: ". $reason  ;
//        mav_mail($emailSubject,$msg,$studentEmails);

        return [
            "error" => 0,
            "msg" => $msg,
            "dispatch" => "success"
        ];
    }

    function showAdvisorAssignmentAction(){
        $dbm = new db\DatabaseManager();

        $this->dep = $dbm->getDepartment($this->uid)[0];

        $advisors = $dbm->getAdvisorsOfDepartment($this->dep);
        $majors = $dbm->getMajorsOfDepartment($this->dep);

        $res = array();
        foreach ($advisors as $rs){
            array_push($res,
                [
                    "pName"=>$rs->getPName(),
                    "nameLow"=>$rs->getNameLow(),
                    "nameHigh"=>$rs->getNameHigh(),
                    "degreeType"=>$rs->getDegType()
                ]
                );
        }

        return [
            "error" => 0,
            "data" => [
                "advisors" => $res,
                "majors" => $majors
            ],
        ];
    }

    function assignStudentToAdvisorAction(){
        $dbm = new db\DatabaseManager();
        $advisorsNew = isset($_POST['advisors']) ? $_POST['advisors'] : null;
        $advisorsNew = json_decode($advisorsNew, true);

        foreach ($advisorsNew as $res){
            $user = new login\AdvisorUser();
            $user->setPName($res['pName']);
            $user->setNameLow($res['nameLow']);
            $user->setNameHigh($res['nameHigh']);
            $user->setDegType($res['degreeType']);

            $dbm->updateAdvisor($user);
        }


        return [
            "error" => 0
        ];
    }

    public function successAction(){
        return [
            "error" => 0,
            "data" => "http://localhost/MavAppoint_PHP/?c=" . mav_encrypt("admin") . "&a=" . mav_encrypt("showAdvisorAssignment")
        ];
    }
}