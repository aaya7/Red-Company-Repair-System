<?php
session_start();
include_once 'config.php';
error_reporting(0);

if(!isset($_SESSION['USERNAME'])){
    header("Location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <body>
        <div class="div2">
            <ul>
                <li><a style="float: left;" onclick= "location.href = 'welcome.html';">Home</a></li>
                <li><a style="float: left;" onclick= "javascript:history.back()">Previous</a></li>
                <li><a style="float: left;" onclick= "location.href = 'last.html';">Next</a></li>
                <li class="dropdowns" style="float: right;">
                    <a href="javascript:void(0)" class="dropbtn"><span>&#8803;</span></a>
                    <div class="dropdowns-content">
                        <a href="welcome.html">Home</a>
                        <a href="aboutus.html">About Us</a>
                        <a href="welcome.php">Edit Profile</a>
                        <a href="devicerepair.php">Customer Device</a>
                        <a href="repair.php">Repair</a>
                        <a href="service.php">Service</a>
                        <a href="payment.php">Payment</a>
                        <a onclick=" location.href='logout.php'; 
                        return confirm('Are You sure you want to logout?');">Log Out</a>
                    </div>
                </li>
            </ul>
            <div class="payment_cont1">
                <h2 style="color:blanchedalmond">Payment Page</h2>
                <p><br>YOUR DEVICE HAS COMPLETELY REPAIRED</p><br>
                <label>Payment for repair: (RM)</label>
                <?php
                $query = "SELECT * FROM REPAIR WHERE USERNAME ='{$_SESSION['USERNAME']}'";
                if ($result = $con->query($query)) {
                  while ($row = $result->fetch_assoc()) {
                    $repcharge = $row["REPCHARGE"];?>
                    <br><textarea type="text" id="charge1" rows="1" cols="5" style="text-align:center; font-size:15px"><?php echo $repcharge?></textarea><br>
                  <?php }
                  $result->free();
                }
                  ?>

                <label>Payment for service: (RM)</label>
                <?php
                $query = "SELECT * FROM SERVICE WHERE USERNAME ='{$_SESSION['USERNAME']}'";
                if ($result = $con->query($query)) {
                  while ($row = $result->fetch_assoc()) {
                    $servcharge = $row["SERVCHARGE"];?>
                    <br><textarea type="text" id="charge2" rows="1" cols="5" style="text-align:center; font-size:15px"><?php echo $servcharge?></textarea><br>
                  <?php }
                  $result->free();
                }
                  ?>

                <label>Total Payment: </label>
                <?php 
                $query = mysqli_query($con, "SELECT `REPAIR`.`REPCHARGE` + `SERVICE`.`SERVCHARGE`
                AS PAYMENT FROM `REPAIR`, `SERVICE` 
                WHERE `REPAIR`.`USERNAME` ='{$_SESSION['USERNAME']}' AND `SERVICE`.`USERNAME` ='{$_SESSION['USERNAME']}'");
                    while ($row = mysqli_fetch_assoc($query)) {?>
                    <br><textarea type="number" rows="1" cols="9" style="text-align:center; font-size:15px;"><?php echo"RM". $row['PAYMENT']?></textarea><br>
                <?php
                } 
                ?>

              
            </div>

            <div class="payment_cont2">
                <p>Please complete the repair process by pay the right amount as stated in REPAIR / SERVICE PAGE when you want to pick up your device.</p><br>
                <p>Payment could be done by:<br>Cash<br>Online Banking</p>
                <p>BANK ISLAM MALAYSIA BERHAD</p>
                <p>02057022161190</p>
                <p>AINA NAJWA MOHD ROHIZAN</p>
            </div>
    </div>
</body>
</html>