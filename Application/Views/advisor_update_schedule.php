
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
    <script src="http://ie7-js.googlecode.com/svn/version/2.0(beta)/IE7.js" type="text/javascript"></script>
    <![endif]"“>
    <!-[if lt IE 8]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.0(beta)/IE8.js" type="text/javascript"></script>
    <![endif]"“>
    <!-[if lt IE 9]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <![endif]"“>
    <link rel="stylesheet"
          href="./Application/Views/components/bootstrap3/css/bootstrap.css">
    <link rel="stylesheet" href="./Application/Views/components/bootstrap3/css/bootstrap-datetimepicker.min.css">
    <link href="./Application/Views/components/mavappoint.css" rel="stylesheet"/>
    <link rel="stylesheet" href="./Application/Views/css/fullcalendar.css">
    <link rel="icon" href="./Application/Views/img/mavlogo.gif" type="image/x-icon">

    <script type="text/javascript" src="./Application/Views/components/jquery/jquery.min.js"></script>
    <script type="text/javascript"
            src="./Application/Views/components/underscore/underscore-min.js"></script>
    <script type="text/javascript"
            src="./Application/Views/components/bootstrap3/js/bootstrap.min.js"></script>
    <script type="text/javascript"
            src="./Application/Views/components/jstimezonedetect/jstz.min.js"></script>
    <script type="text/javascript" src="./Application/Views/js/lib/moment.min.js"></script>
    <script type="text/javascript" src="./Application/Views/js/fullcalendar.js"></script>
    <script type="text/javascript"
            src="./Application/Views/components/bootstrap3/js/bootstrap-datetimepicker.min.js"></script>

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
                <li><a href="customize"><font style="color: #e67e22" size="3">Customize
                    Settings</font></a></li>


                <ul class="nav navbar-nav navbar-right">

                    <li><a href="#"><font style="color: #e67e22" size="3">You are logged in as Advisor.</font></a></li>
                    <li><a href="?c=Login&a=Logout"><span class="glyphicon glyphicon-log-in"><font
                            style="color: #e67e22">Logout</font></span></a></li>
                </ul>

        </div>

</nav>

<div id='calendar'></div>







<!--  begin processing schedules -->

<div class="container-fluid">
    <script>
         var schedules= <?php echo json_encode($schedules);?>;
        $(document).ready(function(){
            $('#calendar').fullCalendar({
                header: {
                    left:'month,basicWeek,basicDay',
                    right: 'today, prev,next',
                    center: 'title'
                },
                displayEventEnd : {
                    month: true,
                    basicWeek: true,
                    'default' : true,
                },
                eventMouseOver: function(event,jsEvent,view){
                    $('.fc-event-inner', this).append('<div id=\"'+event.id+'\" class=\"hover-end\">'+$.fullCalendar.formatDate(event.end, 'h:mmt')+'</div>');
                },
                eventMouseout: function(event, jsEvent, view) {
                    $('#'+event.id).remove();
                },
                dayClick: function(date,jsEvent,view){
                    document.getElementById("opendate").value = date.format('YYYY-MM-DD');
                    $("#addTimeSlotModal").modal();
                }

                ,
                eventClick: function(event,element){
                    if (event.id >= 0){
                        document.getElementById("StartTime2").value = event.start.format('HH:mm');
                        document.getElementById("EndTime2").value = event.end.format('HH:mm');
                        document.getElementById("pname").value = event.title;
                        document.getElementById("Date").value = event.start.format('YYYY-MM-DD');
                        $("#deleteTimeSlotModal").modal();
                    }
                    else{
                        updateAppt.submit();
                    }
                },
                events:schedules



            });
        });
    </script>


    <form name=addTimeSlot id="add_time_slot" action="?c=advisor&a=AddTimeSlot" method="post">
        <div class="modal fade" id="addTimeSlotModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addTimeSlotLabel">Add Time Slots</h4>
                    </div>
                    <div class="modal-body">
                        <label for="starttime">Start Time:</label>
                            <input type="time" class="form-control" name=starttime id="starttime" step="300">
                        <label for="tndtime">End Time:</label>
                            <input type="time" class="form-control" name=endtime id="endtime" step="300">
                        <label for="opendate">Date:</label>
                            <input type="text" class="form-control" name=opendate id="opendate">
                        <label for="repeat">Weekly repeat duration:</label>
                            <input type="text" class="form-control" name=repeat id="repeat" value="0">
                        <label id="result"><font style="color: #e67e22" size="4"></label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close</button>
                        <input type="submit" value="submit"
                               onclick="javascript:FormSubmit();">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form name=deleteTimeSlot id="delete_time_slot" action="ts-manage" method="post">
        <div class="modal fade" id="deleteTimeSlotModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="deleteTimeSlotTitle">Delete Time
                            Slot</h4>
                    </div>
                    <div class="modal-body">
                        <label for="StartTime">Start Time:</label> <input type="time"
                                                                          class="form-control" name=StartTime2 id="StartTime2" step="300">
                        <label for="EndTime">End Time:</label> <input type="time"
                                                                      class="form-control" name=EndTime2 id="EndTime2" step="300">
                        <label for="Date">Date:</label> <input type="date"
                                                               class="form-control" name=Date id="Date"> <input
                            type="hidden" name=pname id="pname"> <label id="result2"><font
                            style="color: #e67e22" size="4"></font></label>
                        <label for="delete_repeat">Weekly repeat duration:</label>
                        <input type="text" class="form-control" name=delete_repeat id="delete_repeat" value="0">

                        <label for="delete_reason">Reason:</label>
                        <input type="text" class="form-control" name=delete_reason id="delete_reason" placeholder="Reason for cancelling slot/s.">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close</button>
                        <input type="submit" value="submit"
                               onclick="return validate();">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script> function FormSubmit(){
        var starttime = document.getElementById("starttime").value;
        var endtime = document.getElementById("endtime").value;
        var date = document.getElementById("opendate").value;
        var repeat = document.getElementById("repeat").value;
        var params = ('starttime='+starttime+'&endtime='+endtime+'&opendate='+date+'&repeat='+repeat);
        document.getElementById('add_time_slot').submit();
    }

    </script>
    <script>
        function validate(){
            var valid = confirm('Are you sure you want to delete?');
            if (valid == true){
                document.getElementById('delete_time_slot').submit();
            }
            else {
                return false;
            }
        }
    </script>
</div>

<style>
    #calendar {
        background-color: white;
    }
</style>
<script type="text/javascript" src="./Application/Views/js/allInPage.js"></script>
<footer>
</footer>
</body>

</html>
