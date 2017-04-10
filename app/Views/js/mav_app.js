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
                    // alert("Error!");
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


    $("#assignStudentSubmit").on("click", function (e) {
        e.preventDefault();

        var length = $("#length").val();
        var advisors = [];

        for(var i = 0; i < length; i++){
            var advisor = {};

            var degType = 0;
            $("#degree"+i+" :selected").each(function(i, selected){
                if($(selected).text() == 'Bachelors')
                    degType += 1;
                if($(selected).text() == 'Masters')
                    degType += 2;
                if($(selected).text() == 'Doctorate')
                    degType += 4;
            });

            advisor.pName = $("#pName"+i).text();
            advisor.nameLow = $("#lowRange"+i+" option:selected").val();
            advisor.nameHigh = $("#highRange"+i+" option:selected").val();
            advisor.degreeType = degType;
            advisor.majors = $("#majors"+i+" option:selected").val();

            advisors.push(advisor);
        }

        $.ajax({
            url: "/MavAppoint_PHP/",
            type: "post",
            data: {
                c : $("#adminController").val(),
                a : $("#assignStudentToAdvisorAction").val(),
                advisors : JSON.stringify(advisors)
            },
            success: function(data){
                var data = JSON.parse(data);
                if (data.error == 0) {
                    window.location.href = "/MavAppoint_PHP?c=" + $("#adminController").val() + "&a=" + $("#successAction").val();
                }else{
                    alert("advising error");
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

    $("#drp_department").change(function(){
        var department = $("#drp_department option:selected").text();
        //alert(department);
        $.ajax({
            url: "/MavAppoint_PHP/",
            type: "post",
            data: {
                c : $("#registerController").val(),
                a : $("#getMajorsAction").val(),
                department : department
            },
            success: function(data){
                var data = JSON.parse(data);
                if (data.error == 0) {
                    $('#drp_major').empty();
                    $.each(data.data.majors, function(key, value) {
                        $('#drp_major')
                            .append($("<option></option>")
                                //.attr("value",key)
                                .text(value));
                    });
                }else{
                    alert("Error when getting majors from department");
                }
            }
        });
    });

    $("#registerSubmit").click(function(e){
        e.preventDefault();

        var email = $("#email").val();
        var studentId = $("#studentId").val();
        var phoneNumber = $("#phoneNumber").val();

        $.ajax({
            url: "/MavAppoint_PHP/",
            type: "post",
            data: {
                c : $("#registerController").val(),
                a : $("#registerStudentAction").val(),
                email : email,
                studentId : studentId,
                phoneNumber : phoneNumber,
                department : $('#drp_department').find(":selected").text(),
                major : $('#drp_major').find(":selected").text(),
                degree : $('#drp_degreeType').find(":selected").text(),
                initial : $('#drp_last_name_initial').find(":selected").text()
            },
            success: function(data){
                var data = JSON.parse(data);
                if (data.error == 0) {
                    window.location.href = $("#loginUrl").val();
                }else{
                    $("#registerErrorMessage").text(data.description).css({'color' : '#e67e22', 'font-size' : '16px'});
                }
            }
        });
    });
});