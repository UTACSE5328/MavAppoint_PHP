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
        //prerequisite, middleware
        $this->addRoute();
        $this->dispatch();
    }

    private function addRoute(){
        self::$container["route"] = require("routes.php");
    }

    private function dispatch() {
        $c = isset($_GET['c']) ? $_GET['c'] : "login"; //Default Login
        $a = isset($_GET['a']) ? $_GET['a'] : "default"; //Use defaultAction() as default
//        echo "param c=".$c."<br>";
//        echo "param a=".$a."<br>";

        if(isset(self::$container["route"][$c]) && isset(self::$container["route"][$c][$a])){
            $controller = "App\\Controllers\\" . ucfirst($c) . "Controller";
            $controller = new $controller();
            $action = $a . "Action";
            $content = json_encode($controller->$action());

            $action = self::$container["route"][$c][$a];
            if($action == $a) {
                echo $content;
            } else {
                $this->view($action, $content);
            }
        } else {
            die("error");
        }
    }

    private function view($view, $content){
        include("Views/" . $view . ".php");
    }
}