
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
    <script src=â€http://ie7-js.googlecode.com/svn/version/2.0(beta)/IE7.jsâ€ type=â€text/javascriptâ€></script>
    <![endif]â€“>
    <!-[if lt IE 8]>
    <script src=â€http://ie7-js.googlecode.com/svn/version/2.0(beta)/IE8.jsâ€ type=â€text/javascriptâ€></script>
    <![endif]â€“>
    <!-[if lt IE 9]>
    <script src=â€http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.jsâ€></script>
    <![endif]â€“>
    <link rel="stylesheet"
          href="./app/Views/components/bootstrap3/css/bootstrap.css">
    <link rel="stylesheet" href="components/bootstrap3/css/bootstrap-datetimepicker.min.css">
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
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div id="inversenavbar" class="container-fluid"
         style="background-color: #104E8B;">
        <div class="navbar-header">
            <a class="navbar-brand" href="index"> <b> <font
                    style="color: #e67e22" size="6"> MavAppoint </font></b></a>
        </div>

        <div id="navbar">
            <ul class="nav navbar-nav">

                <li><a href="changePassword"><font style="color: #e67e22" size="3">Change Password</font></a></li>
                <li><a href="?c=admin&a=showCreateAdvisorForm"><font style="color: #e67e22" size="3">Add New Advisor </font></a></li>
                <li><a href="delete_advisor"><font style="color: #e67e22" size="3">Delete Advisor </font></a></li>
                <li><a href="appointments"><font style="color: #e67e22" size="3">Show Department Schedule</font></a></li>
                <li><a href="assign_students"><font style="color: #e67e22" size="3">Assign Students To Advisors</font></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="#"><font style="color: #e67e22" size="3">You are
                    logged in as an Admin.</font></a></li>
                <li><a href="?c=login&a=logout"><span class="glyphicon glyphicon-log-in"><font style="color: #e67e22" size="3">Logout</font></a></li>
            </ul>
        </div>
    </div>
</nav>




<style>
    .resize {
        width: 60%;
    }
    .resize-body {
        width: 80%;
    }


</style>
<div class="container">
    <!-- Panel -->
    <div class="panel panel-default resize center-block">
        <!-- Default panel contents -->
        <form action="?c=admin&a=createNewAdvisor" method="post" name="advisor_form" onsubmit="return false;">
            <div class="panel-heading text-center"><h1>Create New Advisor</h1></div>
            <div class="panel-body resize-body center-block">



                <div class="form-group">

                    <label for="drp_department"><font color="#0" size="4">Departments</font></label>
                    <br>
                    <select id="drp_department" name="drp_department" class="btn btn-default btn-lg dropdown-toggle">

                        <option value=0 >ARCH</option>

                        <option value=1 >CSE</option>

                        <option value=2 >MAE</option>

                        <option value=3 >MATH</option>

                        <option value=4 >UENGINT</option>

                    </select>
                    <br>

                    <label for="emailAddress"><font color="#0" size="4">Email
                        Address</font></label><br>
                    <input type="text" style="width: 350px;" class="form-control" id="emailAddress" placeholder="">
                    <label for="pname"><font color="#0" size="4">Display
                        Name</font></label><br>
                    <input type="text" style="width: 350px;" class="form-control" id="pname" placeholder="">
                    <br>
                </div>

            </div>
            <div class= "panel-footer text-center">
                <input onclick="javascript:FormSubmit();" type="submit" class="btn-lg" value="Submit">
            </div>
        </form>

        <label id="result"><font color="#0" size="4"></font></label>

    </div>
</div>

<script>

    function getApartments(){

    }

    function FormSubmit(){
        var email = document.getElementById("emailAddress").value;
        var pname = document.getElementById("pname").value;
        var drp_department = document.getElementById("drp_department").value;
        var params = ('emailAddress='+email+'&pname='+pname+'&drp_department='+drp_department);
        var xmlhttp;
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4){
                document.getElementById("result").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("POST","?c=admin&a=createNewAdvisor",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.setRequestHeader("Content-length",params.length);
        xmlhttp.setRequestHeader("Connection","close");
        xmlhttp.send(params);
        document.getElementById("result").innerHTML = "Attempting to create new Advisor...";
    }
</script>
<script type="text/javascript" src="./app/Views/js/allInPage.js"></script>
<footer>
</footer>
</body>

</html>
