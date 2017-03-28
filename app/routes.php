<?php
//if the value is "view", return view, else return json format
return [
    "login" => [
        "default" => "LoginView",
        "test" => "testView",
        "check" => "check",
        "logout" => "IndexView",

    ],
    "index" => [
        "default" => "IndexView"
    ],
    "admin" => [
        "addAdvisor" => "CreateAdvisorView",
        "createNewAdvisor" => "createNewAdvisor",
        "showDepartmentSchedule" => "DepartmentScheduleView",
        "deleteTimeSlot" => "DepartmentScheduleView",
    ],
    "advisor" => [
        "showSchedule" => "AdvisorScheduleView",
        "addTimeSlot" =>  "AdvisorScheduleView",
        "deleteTimeSlot" => "AdvisorScheduleView"

    ],
    "advising" => [
        "getAdvisingInfo" => "AdvisingView",
        "schedule" => "ScheduleView",
        "makeAppointment" => "makeAppointment",
        "success" => "SuccessView"
    ]
];