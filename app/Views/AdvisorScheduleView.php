<?php
/**
 * Created by PhpStorm.
 * User: gaolin
 * Date: 3/13/17
 * Time: 2:14 AM
 */

include ("template/header.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : "visitor";
include ("template/" . $role . "_navigation.php");
$schedule = isset($_SESSION['schedule']) ? $_SESSION['schedule'] : null;
$content = json_decode($content, true);
$isDispatch = isset($content['isDispatch']) ? $content['isDispatch'] : false;
if($isDispatch){

?>

<script type='text/javascript'>
window.location.href="app/Views/success.php";
</script>
<?php  unset($content['isDispatch']); } ?>

<div id='calendar'></div>

<!--  begin processing schedules -->
<div class="container-fluid">
    <script>

        $(document).ready(function(){

            $('#calendar').fullCalendar({
                header:
                    {
                        left:'month,basicWeek,basicDay',
                        right: 'today, prev,next',
                        center: 'title'
                    },
                displayEventEnd :
                    {
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
                <?php if($schedule !=null) {?>
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
                events: [
                    <?php for($i=0; $i<sizeof($schedule); $i++) { $scheduleObject=unserialize($schedule[$i]); ?>
                    {
                        title:'<?php echo $scheduleObject->getName(); ?>',
                        start:'<?php echo $scheduleObject->getDate()."T".$scheduleObject->getStartTime(); ?>',
                        end:'<?php echo $scheduleObject->getDate()."T".$scheduleObject->getEndTime(); ?>',
                        id:<?=$i?>,
                        backgroundColor: 'blue'
                    } <?php if($i!= sizeof($schedule) - 1) {?> ,  <?php }?>
                    <?php }?>


                ] <?php } ?>

            });
        });
    </script>


    <form name=addTimeSlot id="add_time_slot" action="?c=<?=$advisorController?>&a=<?=$addTimeSlotAction?>" method="post">
        <div class="modal fade" id="addTimeSlotModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addTimeSlotLabel">Add Time Slots</h4>
                    </div>
                    <div class="modal-body">
                        <label for="starttime">Start Time:</label> <input type="time"
                                                                          class="form-control" name=starttime id="starttime" step="300">
                        <label for="tndtime">End Time:</label> <input type="time"
                                                                      class="form-control" name=endtime id="endtime" step="300">
                        <label for="opendate">Date:</label> <input type="text"
                                                                   class="form-control" name=opendate id="opendate">
                        <label for="repeat">Weekly repeat duration:</label>
                        <input type="text" class="form-control" name=repeat id="repeat" value="0">
                        <label
                                id="result"><font style="color: #e67e22" size="4"></label>
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
    <form name=deleteTimeSlot id="delete_time_slot" action="?c=<?=$advisorController?>&a=<?=$deleteTimeSlotAction?>" method="post">
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
