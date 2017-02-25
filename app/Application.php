<?php

namespace App;


class Application
{
    static $container = [];

    public function __construct($config = [])
    {
       self::$container["config"] = $config;
    }

    public function run()
    {
        $c = isset($_GET['c']) ? $_GET['c'] : "login"; //Default Login


        $controller = "App\\Controllers\\" . ucfirst($c) . "Controller";
        $controller = new $controller();

        $a = isset($_GET['a']) ? $_GET['a'] : "default"; //Use defaultAction() as default
        $action = $a . "Action";

        $controller->$action();
    }

}