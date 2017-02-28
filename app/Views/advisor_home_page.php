
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <title>MavAppoint</title>

    <meta name="description"
          content="Full view calendar component for twitter bootstrap with year, month, week, day views.">
    <meta name="keywords"
          content="jQuery,Bootstrap,Calendar,HTML,CSS,JavaScript,responsive,month,week,year,day">
    <meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <!-[if lt IE 7]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.0(beta)/IE7.js" type="text/javascript"></script>
    <![endif]â€“>
    <!-[if lt IE 8]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.0(beta)/IE8.js" type="text/javascript"></script>
    <![endif]â€“>
    <!-[if lt IE 9]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <![endif]â€“>
    <link rel="stylesheet"
          href="./app/Views/components/bootstrap3/css/bootstrap.css">
    <link rel="stylesheet" href="./app/Views/components/bootstrap3/css/bootstrap-datetimepicker.min.css">
    <link href="./app/Views/components/mavappoint.css" rel="stylesheet"/>
    <link rel="stylesheet" href="./app/Views/css/fullcalendar.css">
    <link rel="icon" href="./app/Views/img/mavlogo.gif" type="image/x-icon">

    <script type="text/javascript" src="./app/Views/components/jquery/jquery.min.js"></script>
    <script type="text/javascript"
            src="./app/Views/components/underscore/underscore-min.js"></script>
    <script type="text/javascript"
            src="./app/Views/components/bootstrap3/js/bootstrap.min.js"></script>
    <script type="text/javascript"
            src="./app/Views/components/jstimezonedetect/jstz.min.js"></script>
    <script type="text/javascript" src="./app/Views/js/lib/moment.min.js"></script>
    <script type="text/javascript" src="./app/Views/js/fullcalendar.js"></script>
    <script type="text/javascript"
            src="./app/Views/components/bootstrap3/js/bootstrap-datetimepicker.min.js"></script>
</head>

<body onload="" >
<?php
//echo $content?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div id="inversenavbar" class="container-fluid"
         style="background-color: #104E8B;">
        <div class="navbar-header">
            <a class="navbar-brand" href="index"> <b> <font
                    style="color: #e67e22" size="6"> MavAppoint </font></b></a>
        </div>

        <div>
            <ul class="nav navbar-nav">

                <li><a href="changePassword"><font style="color: #e67e22" size="3">Change Password</font></a></li>

                <li><a href="?c=advisor&a=ShowSchedule"><font style="color: #e67e22" size="3">
                    Update Schedule</font> </a></li>
                <li><a href="appointments"><font style="color: #e67e22" size="3">
                    Appointments</font> </a></li>
                <li><a href="?c=advisor&a=ShowSettingForm"><font style="color: #e67e22" size="3">Customize
                    Settings</font></a></li>


                <ul class="nav navbar-nav navbar-right">

                    <li><a href="#"><font style="color: #e67e22" size="3">You are logged in as Advisor.</font></a></li>
                    <li><a href="?c=login&a=logout"><span class="glyphicon glyphicon-log-in"><font
                            style="color: #e67e22">Logout</font></span></a></li>
                </ul>

        </div>

</nav>


<div class="container">
    <div class="jumbotron masthead">
        <img src="./app/Views/img/mavlogo.gif" style=";padding:30px;float:left;">
        <h1><font style="color: #e67e22;font-size:72px;"> Mav-Appointment </font></h1>
        <p>This advising system is used by University of Texas at Arlington only.</p>

    </div>
</div>
<script type="text/javascript" src="./app/Views/js/allInPage.js"></script>
<footer>
</footer>
</body>

</html>
