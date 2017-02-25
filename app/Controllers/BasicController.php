<?php

/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/19/17
 * Time: 3:26 AM
 */
class BasicController
{
    function __construct()
    {
        header("content-type: text/html; charset=utf-8");
    }

    function GotoUrl($msg, $url, $time=5){
        header( "refresh:$time;url=$url" );
        echo "<font color=red>$msg</font> <br>";
        echo "You'll be redirected in about {$time} secs. If not, click <a href=\"$url\">here</a>.";
//        echo ' <a href="$url">here</a>.';

    }


}