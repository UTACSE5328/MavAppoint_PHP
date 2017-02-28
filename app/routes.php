<?php
//if the value is "view", return view, else return json format
return [
    "login" => [
        "default" => "LoginView",
        "check" => "switch_page",
        "logout" => "LoginView",
        "test" => "test"
    ],
    "admin" => [
        "showCreateAdvisorForm" => "create_advisor",
        "createNewAdvisor" => "createNewAdvisor"
    ],
    "advisor" => [
        "ShowSchedule" => "advisor_update_schedule",
        "AddTimeSlot" =>  "advisor_update_schedule",
        "ShowSettingForm" => "customize_settings",
        "SetCutOffTime" => "customize_settings"

    ]
];