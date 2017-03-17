<?php
//if the value is "view", return view, else return json format
return [
    "login" => [
        "default" => "LoginView",
        "test" => "testView",
        "check" => "UserView",
        "logout" => "IndexView",

    ],
    "index" => [
        "default" => "IndexView"
    ],
    "admin" => [
        "addAdvisor" => "CreateAdvisorView",
        "createNewAdvisor" => "createNewAdvisor"
    ],
    "advisor" => [
        "showSchedule" => "AdvisorScheduleView",
        "addTimeSlot" =>  "AdvisorScheduleView"

    ]
];