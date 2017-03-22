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

});