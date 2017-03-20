<?php
session_start();
include ("template/header.php");
$role = isset($_SESSION['role']) ? $_SESSION['role'] : "visitor";
include ("template/" . $role . "_navigation.php");
?>


<div class="container">
    <div class="jumbotron masthead">
        <img src="app/Views/img/mavlogo.gif" style=";padding:30px;float:left;">
        <h1><font style="color: #e67e22;font-size:72px;"> Mav-Appointment </font></h1>
        <p>This advising system is used by University of Texas at Arlington only.</p>
        <?php if($role == ""){ ?>
        <a href="advising" class="btn btn-primary btn-lg">Make an appointment Now!</a>
        <?php	}else if($role != "advisor" && $role != "admin"){ ?>
        <a href="advising" class="btn btn-primary btn-lg">Make an appointment Now!</a>
        <?php } ?>

    </div>
</div>

<?php include ("template/footer.php"); ?>