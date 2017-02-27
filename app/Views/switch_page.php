<?php
/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 2/26/17
 * Time: 2:53 PM
 */

session_start();


If(!isset($_SESSION['role'])){
    include "./loginView.php";
}
else{
    if($_SESSION['role']=='admin'){
        include "admin_home_page.php";

    }
    elseif($_SESSION['role']=='advisor'){
        include "advisor_home_page.php";

    } elseif($_SESSION['role']=='student'){
        //...

    }
    elseif ($_SESSION['role']=='faculty'){
        //...
    }
}
