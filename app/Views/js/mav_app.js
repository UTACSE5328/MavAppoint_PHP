$(function(){

    $("#signIn").on("click", function (e) {
        e.preventDefault();

        var passhash = md5($("#password").val());
        console.log(passhash);
        $.ajax({
            url: "/MavAppoint_PHP/",
            type: "post",
            data: {
                c : $("#loginController").val(),
                a : $("#checkAction").val(),
                email : $("#email").val(),
                password : passhash
            },
            success: function(data){
                var data = JSON.parse(data);
                if (data.error == 0) {
                    window.location.href = "/MavAppoint_PHP?c=" + $("#indexController").val() + "&role=" + data.data.role;
                }else{
                    alert("hehe");
                    $("#message").css("visibility", "visible");
                }
            }
        });
    });

    $('#loginForm').submit(function (event) {
        event.preventDefault();
        window.history.back();
    });

    $("#createAdvisorSubmit").on("click", function(){
        var email = $("#emailAdvisor").val();
        var pname = $("#pname").val();
        var drp_department = $("#drp_department").val();

        $.ajax({
            url: "/MavAppoint_PHP/",
            type: "post",
            data: {
                c : $("#adminController").val(),
                a : $("#createNewAdvisorAction").val(),
                email : email,
                pname : pname,
                drp_department : drp_department
            },
            success: function(data){
                var data = JSON.parse(data);
                if (data.error == 0) {
                    alert(data.data.message);
                    $("#addAdvisorResult").text(data.data.message);
                    //window.location.href = "/MavAppoint_PHP?c=" + $("#indexController").val() + "&role=" + data.data.role;
                }else{
                    alert(data.data.message);
                    $("#addAdvisorResult").text(data.data.message);
                }
            }
        });
    });

    $("#makeAppointment").on("click", function (e) {
        e.preventDefault();

        $.ajax({
            url: "/MavAppoint_PHP/",
            type: "post",
            data: {
                c : $("#appointmentController").val(),
                a : $("#makeAppointmentAction").val(),
                appointmentId : $("#appointmentId").val(),
                appointmentType : $("#appointmentType").val(),
                duration : $("#duration").val(),
                pName : $("#pName").val(),
                start : $("#start").val(),
                email : $("#email").val(),
                studentId : $("#studentId").val(),
                phoneNumber : $("#phoneNumber").val(),
                description : $("#description").val(),

            },
            success: function(data){
                var data = JSON.parse(data);
                if (data.error == 0) {
                    window.location.href = "/MavAppoint_PHP?c=" + $("#appointmentController").val() + "&a=" + $("#successAction").val()
                        + "&nc=advising&na=getAdvisingInfo";
                }else{
                    //TODO redirect to failure page
                    alert("Make appointment error");
                }
            }
        });
    });

    $(".cancelButton").click(function(){
        var confirmMessage = 'Are you sure you want to delete this appointment?';
        if (confirm(confirmMessage)) {
            var appointmentId = $(this).attr("value");

            $.ajax({
                url: "/MavAppoint_PHP/",
                type: "post",
                data: {
                    c : $("#appointmentController").val(),
                    a : $("#cancelAppointmentAction").val(),
                    appointmentId : appointmentId
                },
                success: function(data){
                    var data = JSON.parse(data);
                    if (data.error == 0) {
                        window.location.href = "/MavAppoint_PHP?c=" + $("#appointmentController").val() + "&a=" + $("#successAction").val()
                        + "&nc=appointment&na=showAppointment";
                    }else{
                        //TODO redirect to failure page
                        alert("Cancel appointment error");
                    }
                }
            });
        }

    });

});