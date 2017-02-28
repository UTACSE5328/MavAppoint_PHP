<?php
//if the value is "view", return view, else return json format
return [
    "login" => [
        "default" => "LoginView",
        "check" => "check",
        "logout" => "IndexView",
    ],
    "index" => [
        "default" => "IndexView"
    ],
    "admin" => [
        "showCreateAdvisorForm" => "create_advisor",
        "createNewAdvisor" => "createNewAdvisor"
    ],
    "advisor" => [
        "ShowSchedule" => "advisor_update_schedule",
        "AddTimeSlot" =>  "advisor_update_schedule"

    ]
];