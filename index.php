<?php

require __DIR__ . '/vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

$config = require(__DIR__ . '/config/web.php');

(new \App\Application($config))->run();

//define("DS", DIRECTORY_SEPARATOR);

//define("ROOT", __DIR__ . DS);
//define("APP", ROOT . 'app' . DS);
//echo ROOT.'<br>';
//echo APP.'<br>';
//define("CTRL_PATH", APP . 'Controllers' . DS);
//define("MODEL_PATH", APP . 'Models' . DS);
//define("VIEW_PATH", APP . 'Views' . DS);

//require MODEL_PATH . "db/DatabaseManager.php";
//require_once MODEL_PATH . "bean/GetSet.php";

//$c = !isset($_GET['c']) ? $_GET['c'] : "Login"; //默认选用Login
//
////require CTRL_PATH . $c . "Controller.php";
//$controller_name = $c . "Controller";
//$controller = new $controller_name();
//
//
//$a = !isset($_GET['a']) ? $_GET['a'] : "Default"; //Controller 中的默认方法 DefaultAction()
//$action = $a . "Action";
//$controller->$action();


