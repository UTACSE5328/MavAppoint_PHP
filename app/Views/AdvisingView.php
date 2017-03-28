<?php
include("template/header.php");
$role = isset($_SESSION['role']) ? $_SESSION['role'] : "visitor";
include("template/" . $role . "_navigation.php");
$advisingController = mav_encrypt("advising");
$scheduleAction = mav_encrypt("schedule");

$content = json_decode($content, true);
$departments = $content['data']['departments'];
$degrees = $content['data']['degrees'];
$majors = $content['data']['majors'];
$letters = $content['data']['letters'];
$advisors = $content['data']['advisors'];
$schedules = $content['data']['schedules'];
$appointments = $content['data']['appointments'];
?>

<div class="container-fluid">
    <!-- Panel -->
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading text-center"><h1>Student Information</h1></div>
        <div class="panel-body">

            <form action="advising" method="post" name="advisor_form">
                <div class="row">
                    <div class="col-md-2">
                        <label for="drp_department"><font color="#0" size="4">Department</font></label>

                        <br>
                        <select id="drp_department" onchange = "submit();" name = "drp_department" class="btn btn-default btn-lg dropdown-toggle">

                            <?php
                                $i = 0;
                                foreach ($departments as $department) {
                                    echo "<option id=\"option\" value = $i> $department</option>";
                                    $i++;
                                }
                            ?>


                        </select>

                    </div>
                    <div class="col-md-2">

                        <label for="drp_degreeType"><font color="#0" size="4">Degree Type</font></label>
                        <br>
                        <select id="drp_degreeType" name="drp_degreeType" onchange = "submit();" class="btn btn-default btn-lg dropdown-toggle">

                            <?php
                                $i = 0;
                                foreach ($degrees as $degree) {
                                    echo "<option id = \"degree\" value=$i > $degree</option>";
                                    $i++;
                                }
                            ?>


                        </select>
                        <br>

                    </div>
                    <div class="col-md-4">

                        <label for="drp_major"><font color="#0" size="4">Major</font></label>
                        <br>
                        <select id="drp_major" name="drp_major" onchange = "submit();" class="btn btn-default btn-lg dropdown-toggle">

                            <?php
                            $i = 0;
                            foreach ($majors as $major) {
                                echo "<option id = \"major\" value=$i > $major</option>";
                                $i++;
                            }
                            ?>

                            <script>function selectmajor(){
                                    document.getElementById("major").value;
                                    advisor_form.submit();
                                }
                            </script>
                        </select>
                        <br>

                    </div>

                    <div class="col-md-4"></div>
                    <label for="drp_lastName"><font color="#0" size="4">Last Name</font></label>
                    <br>
                    <select id="drp_lastName" name="drp_lastName" onchange = "submit();" class="btn btn-default btn-lg dropdown-toggle">

                        <?php

                            echo "<option id = \"letter\" value=0 > $letters</option>";

                        ?>

                        <script>function selectLetter(){
                                document.getElementById("letter").value;
                                advisor_form.submit();
                            }
                        </script>
                    </select>
                    <br>

                </div>




                <div class="pull-right form-inline">
                    <div class="btn-group">

                        <input type=hidden name=advisor_button id="advisor_button">
                        <script>

                            document.getElementById("advisor_button").value = "all";
                        </script>

                        <!-- begin processing advisors  -->
                        <button type="button" id="all1" onclick="alladvisors()">All</button>
                        <script> function alladvisors(){
                                document.getElementById("advisor_button").value = "all";
                                advisor_form.submit();
                            }
                        </script>


                        <?php
                            $i = 0;
                            foreach ($advisors as $advisor) {
                        ?>
                                <button type="button" id="button1<?=$i?>" onclick="button<?=$i?>()"><?=$advisor['pName']?></button>
                                <script> function button<?=$i?>() {
                                        document.getElementById("advisor_button").value = "<?=$advisor['pName']?>";
                                        advisor_form.submit();
                                    }
                                </script>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </form>

            <!-- end processing advisors -->
        </div>
    </div>
</div>
<?php
if(count($advisors) == 0) {
    echo "<label><font color=\"#0\" size=\"5\"> No advisors available for advising</font></label>";
} else {
?>
<div class="container-fluid">
    <div class="date-display span12">


        <div id='calendar'>


            <!--  begin processing schedules -->
            <script>
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
                        }
                        <?php
                        if(count($schedules) != 0){
                        ?>
                        ,
                        eventClick: function(event,element){
                            if (event.id >= 0){
                                document.getElementById("id1").value = event.id;
                                document.getElementById("pname").value = event.title;
                                addAppt.submit();
                            }
                            else{
                                updateAppt.submit();
                            }
                        },
                        events: [
                            <?php
                            $i = 0;
                            foreach ($schedules as $schedule) {
                            ?>
                                {
                                    title: '<?=$schedule['name']?>',
                                    start: '<?php echo $schedule['date'] . "T" . $schedule['startTime']?>',
                                    end: '<?php echo $schedule['date'] . "T" . $schedule['endTime']?>',
                                    id:<?=$i?>,
                                    backgroundColor: 'blue'
                                }
                            <?php
                                if ($i != count($schedules) - 1 || count($appointments) != 0) {
                                    echo ",";
                                }
                                $i++;
                            }

                            if (count($appointments) != 0) {
                                $i = 1;
                                foreach ($appointments as $appointment) {
                            ?>
                                {
                                    title:'<?=$appointment['appointmentType']?>',
                                    start:'<?php echo $appointment['advisingDate'] . "T" . $appointment['advisingStartTime']?>',
                                    end:'<?php echo $appointment['advisingDate'] . "T" . $appointment['advisingEndTime']?>',
                                    id:<?=-$i?>,
                                    backgroundColor: 'orange'
                                }
                            <?php
                                if ($i != count($appointments)) {echo ",";}
                                }
                            }
                         }
                            ?>
                        ]
                    });
                });
            </script>


            <form name=addAppt method="get">
                <input type="hidden" name=c value="<?=$advisingController?>">
                <input type="hidden" name=a value="<?=$scheduleAction?>">
                <input type="hidden" name=id1 id="id1">
                <input type="hidden" name=pname id="pname">
                <input type="hidden" name=advisor_email id="advisor_email">
            </form>

            <form name=updateAppt action="appointments" method="get"></form>

            <br /> <br />
            <hr>
        </div>
    </div>
</div>
<?php
}
?>
<style>
    #calendar {
        background-color: white;
    }
</style>

<?php include ("template/footer.php"); ?>