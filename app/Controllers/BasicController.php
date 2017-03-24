<?php
namespace App\Controllers;
/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/19/17
 * Time: 3:26 AM
 */
class BasicController
{

    function GotoUrl($msg, $url, $time=5){
        header( "refresh:$time;url=$url" );
        echo "<font color=red>$msg</font> <br>";
        echo "You'll be redirected in about {$time} secs. If not, click <a href=\"$url\">here</a>.";

    }

    function showSuccess(){
//        include dirname(dirname(__FILE__))."/Views/success.php";
        $url = dirname(dirname(__FILE__))."/Views/success.php";
//        header("Location:$url");



        echo "< script language='javascript' type='text/javascript'>";
        echo "window.location.href='$url'";
        echo "< /script>";
    }


}