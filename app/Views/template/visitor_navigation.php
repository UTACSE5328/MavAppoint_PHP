<?php
$loginController = mav_encrypt("login");
$registerController = mav_encrypt("register");
?>
<div>
    <ul class="nav navbar-nav">
        <li><a href="advising"><font style="color: #e67e22" size="3">Advising</font>
            </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">

        <li><a href="?c=<?=$registerController?>"><span class="glyphicon glyphicon-user"><font style="color: #e67e22" size="3">Register</font></a></li>
        <li><a href="?c=<?=$loginController?>"><span class="glyphicon glyphicon-log-in"><font style="color: #e67e22" size="3">Login</font></a></li>
    </ul>
</div>
</div>
</nav>