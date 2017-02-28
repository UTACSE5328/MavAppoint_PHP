
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
    <link rel="stylesheet" href="./app/Views/components/bootstrap3/css/bootstrap-datetimepicker.min.css">
    <link href="./app/Views/components/mavappoint.css" rel="stylesheet"/>
    <link rel="stylesheet" href="./app/Views/css/fullcalendar.css">
    <link rel="icon" href="./app/Views/img/mavlogo.gif" type="image/x-icon">

    <script type="text/javascript" src="components/jquery/jquery.min.js"></script>
    <script type="text/javascript"
            src="components/underscore/underscore-min.js"></script>
    <script type="text/javascript"
            src="components/bootstrap3/js/bootstrap.min.js"></script>
    <script type="text/javascript"
            src="components/jstimezonedetect/jstz.min.js"></script>
    <script type="text/javascript" src="./app/Views/js/lib/moment.min.js"></script>
    <script type="text/javascript" src="./app/Views/js/fullcalendar.js"></script>
    <script type="text/javascript"
            src="components/bootstrap3/js/bootstrap-datetimepicker.min.js"></script>
</head>

<body onload="" >
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
        <div class="panel-heading text-center"><h1>Customize Settings</h1></div>


        <div class="panel-body resize-body center-block">
            <form action="appointment_type" method="post" name="delete">
                <div class="panel-heading text-center"><h3>Appointment Manager</h3></div>
                <input type=hidden name=cancel_button id="cancel_button">
                <input type=hidden name=edit_button id="edit_button">
                <table class="table table-striped custab">
                    <thead>
                    <tr>
                        <th><font style="color: #0" size="4">Appointment Type</font></th>
                        <th><font style="color: #0" size="4">Duration</font></th>
                    </tr>
                    </thead>



                    <!-- begin processing appointments  -->

                    <tr>
                        <td><font style="color: #0" size="3">Add Course</font></td>
                        <td><font style="color: #0" size="3">10</font></td>
                        <td><button type="button" onclick="deleteapptype0()" class="btn"> <span class="glyphicon glyphicon-remove"></span></button></td>
                    </tr>

                    <script> function deleteapptype0(){
                            var apptype = "Add Course";
                            var minutes = "10";
                            if (validate(apptype) == true){

                                var params = ('minutes=' + minutes + '&apptypes=' + apptype);
                                var xmlhttp;
                                xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function() {
                                    if (xmlhttp.readyState == 4) {
                                        if(xmlhttp.status == 200){
                                            document.getElementById("result").innerHTML = xmlhttp.responseText;
                                        }

                                    }else{
                                        //alert(xmlhttp.readyState+" "+xmlhttp.status);
                                    }
                                }

                                xmlhttp.open("POST", "appointment_type", true);
                                xmlhttp.setRequestHeader("Content-type",
                                    "application/x-www-form-urlencoded");
                                xmlhttp.setRequestHeader("Content-length", params.length);
                                xmlhttp.setRequestHeader("Connection", "close");
                                xmlhttp.send(params);
                                //window.location.reload();
                                window.location.href=window.location;

                            }
                        }</script>

                    <tr>
                        <td><font style="color: #0" size="3">Drop Course</font></td>
                        <td><font style="color: #0" size="3">10</font></td>
                        <td><button type="button" onclick="deleteapptype1()" class="btn"> <span class="glyphicon glyphicon-remove"></span></button></td>
                    </tr>

                    <script> function deleteapptype1(){
                            var apptype = "Drop Course";
                            var minutes = "10";
                            if (validate(apptype) == true){

                                var params = ('minutes=' + minutes + '&apptypes=' + apptype);
                                var xmlhttp;
                                xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function() {
                                    if (xmlhttp.readyState == 4) {
                                        if(xmlhttp.status == 200){
                                            document.getElementById("result").innerHTML = xmlhttp.responseText;
                                        }

                                    }else{
                                        //alert(xmlhttp.readyState+" "+xmlhttp.status);
                                    }
                                }

                                xmlhttp.open("POST", "appointment_type", true);
                                xmlhttp.setRequestHeader("Content-type",
                                    "application/x-www-form-urlencoded");
                                xmlhttp.setRequestHeader("Content-length", params.length);
                                xmlhttp.setRequestHeader("Connection", "close");
                                xmlhttp.send(params);
                                //window.location.reload();
                                window.location.href=window.location;

                            }
                        }</script>

                    <tr>
                        <td><font style="color: #0" size="3">Swap Course</font></td>
                        <td><font style="color: #0" size="3">10</font></td>
                        <td><button type="button" onclick="deleteapptype2()" class="btn"> <span class="glyphicon glyphicon-remove"></span></button></td>
                    </tr>

                    <script> function deleteapptype2(){
                            var apptype = "Swap Course";
                            var minutes = "10";
                            if (validate(apptype) == true){

                                var params = ('minutes=' + minutes + '&apptypes=' + apptype);
                                var xmlhttp;
                                xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function() {
                                    if (xmlhttp.readyState == 4) {
                                        if(xmlhttp.status == 200){
                                            document.getElementById("result").innerHTML = xmlhttp.responseText;
                                        }

                                    }else{
                                        //alert(xmlhttp.readyState+" "+xmlhttp.status);
                                    }
                                }

                                xmlhttp.open("POST", "appointment_type", true);
                                xmlhttp.setRequestHeader("Content-type",
                                    "application/x-www-form-urlencoded");
                                xmlhttp.setRequestHeader("Content-length", params.length);
                                xmlhttp.setRequestHeader("Connection", "close");
                                xmlhttp.send(params);
                                //window.location.reload();
                                window.location.href=window.location;

                            }
                        }</script>

                    <!-- end processing advisors -->
                </table>
            </form>
        </div>
        <div class="panel-footer text-center">
            <input type="submit" class="btn-lg" value="Add Appointment Type" href="#" data-toggle="modal" data-target="#addApptType">
        </div>

        <form action="add_app_type" method="post" onsubmit="return false;">
            <div class="modal fade" id="addApptType" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"></button>
                            <h4 class="modal-title" id="addApptTypeLabel">Add Appointment Type</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="apptypes">Appointment Type:</label>
                                <input type="text" class="form-control" id="apptypes" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="minutes">Minutes</label> <input type="number" class="form-control" id="minutes" step="5" placeholder="">
                            </div>
                            <div>
                                <label id="result"><font style="color: #0" size="4"></font></label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" value="submit" onclick="javascript:FormSubmit();">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="panel-body resize-body center-block">
            <form action="?c=advisor&a=SetCutOffTime" method="post" name="cutOffTime">
                <div class="panel-heading text-center"><h3>Cut-Off Time Preference</h3></div>

                <div class="form-group">
                    <label for="cutOffTimeText">Cut-Off Time (in hours):<br></label>
                    <input type="text" name="cutOffTimeText" id="cutOffTimeText" placeholder="">
                </div>

                <div class="panel-footer text-center">
                    <input type="submit" class="btn-lg" value="submit"/>
                </div>
            </form>
        </div>



        <div class="panel-body resize-body center-block">
            <form action="customize" method="POST">
                <div class="panel-heading text-center"><h3>Email Notifications</h3></div>
                <label style="text-align: center" for="message"><font color="#0" size="4"></font></label> <br>

                <div class="form-group">
                    <input type="radio" name="notify" id="radioyes" value="yes" checked><label for="radioyes">Yes</label>
                </div>
                <div class="form-group">
                    <input type="radio" name="notify" id="radiono" value="no"><label for="radiono">No</label>
                </div>

                <div class="panel-footer text-center">
                    <input type="submit" class="btn-lg" value="submit"/>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function SetNotification() {

    }

    function FormSubmit() {
        var apptype = document.getElementById("apptypes").value;
        var minutes = document.getElementById("minutes").value;
        var params = ('minutes=' + minutes + '&apptypes=' + apptype);
        var xmlhttp;
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                document.getElementById("result").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("POST", "add_app_type", true);
        xmlhttp.setRequestHeader("Content-type",
            "application/x-www-form-urlencoded");
        xmlhttp.setRequestHeader("Content-length", params.length);
        xmlhttp.setRequestHeader("Connection", "close");
        xmlhttp.send(params);
        document.getElementById("result").innerHTML = "Adding appointment type...";
        //window.location.reload();
        window.location.href=window.location;
    }

    function validate(apptype){
        return confirm('Are you sure you want to delete '+ apptype +'?');
    }

</script>

<script type="text/javascript" src="./app/Views/js/allInPage.js"></script>
<footer>
</footer>
</body>

</html>
