<?php
$loginController = mav_encrypt("login");
$logoutAction = mav_encrypt("logout");
?>

<div>
    <ul class="nav navbar-nav">

        <li><a href="changePassword"><font style="color: #e67e22" size="3">Change Password</font></a></li>

        <li><a href="availability"><font style="color: #e67e22" size="3">
                    Update Schedule</font> </a></li>
        <li><a href="appointments"><font style="color: #e67e22" size="3">
                    Appointments</font> </a></li>
        <li><a href="customize"><font style="color: #e67e22" size="3">Customize
                    Settings</font></a></li>

    </ul>
    <ul class="nav navbar-nav navbar-right">

        <li><a href="#"><font style="color: #e67e22" size="3">You are logged in as an Advisor.</font></a></li>
        <li><a href="?c=<?=$loginController?>&a=<?=$logoutAction?>"><span class="glyphicon glyphicon-log-in"><font style="color: #e67e22" size="3">Logout</font></span></a></li>
    </ul>

</div>
</div>
</nav>