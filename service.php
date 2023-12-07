<?php
session_start();

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
    <title>Service</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
    <div class="div2">
        <ul>
            <li><a style="float: left;" onclick= "location.href = 'welcome.html';">Home</a></li>
            <li><a style="float: left;" onclick= "javascript:history.back()">Previous</a></li>
            <li><a style="float: left;" onclick= "location.href = 'payment.php';">Next</a></li>
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

        <div class="bt_cont">
              <button id="myBtn" class="openbutton">Read Me</button>
              <div id="myModal" class="modal">
                <div class="modal-content">
                  <span class="close">&times;</span>
                  <p>Then, we would notify you 
                    about everything that we could done on your devices. We would 
                    update the description one hour after the customer has posted 
                    their devices' notes. After we have updated the 
                    description, customers have to ensure to send their devices to 
                    our shop within 24 hours of the date.</p>
                </div>
              </div>
            </div> 
        
          <div class="devrepair_container">
            <div class="row">
              <div class="devicerepair_container">
                <h2>Information</h2><br>
                <p>Please fill in this field to register as a service customer.</p><br>
                <form action="" id="dev_date" method="POST">
                <label>Service ID must be all numbers:</label><br>
                  <input type="text" name="servid" placeholder="Enter Service ID" required></input><br>
                  <input type="text" name="dev_id" placeholder="Enter Device ID" required></input><br>
                  <input type="text" name="username" placeholder="Enter Username" required></input><br><br>
                  <input type="submit" name="submit" value="Submit"><br>
                </form>
                <?php
                  include_once 'config.php';
                  error_reporting(0);
                  if (isset($_POST['submit'])) {
                      
                      // receive all input values from the form
                      $servid = $_POST['servid'];
                      $device_id = $_POST['dev_id'];
                      $usrname = $_POST['username'];
                      $insert_device = "INSERT INTO SERVICE (SERVID, DEV_ID, USERNAME)
                                      VALUES ( '$servid','$device_id', '$usrname')";
                      $servicecheck = "SELECT * FROM SERVICE WHERE (SERVID = '$servid' AND DEV_ID = '$device_id')";
                      $result = mysqli_query($con, $servicecheck);
                        if($result->num_rows > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $_SESSION['SERVID'] = $row['SERVID'];
                            $_SESSION['DEV_ID'] = $row['DEV_ID'];
                            $message="Service ID or Device ID is already exist. Please try again.";
                            echo "<script type='text/javascript'>alert('$message');</script>";
                        }
                        else{
                            $result_ins = mysqli_query($con, $insert_device);
                            if($result_ins){
                              $message="Submitted Successfully.";
                              echo "<script type='text/javascript'>alert('$message');</script>";
                          }
                          else{
                              $message="Submission failed. Please try again.";
                              echo "<script type='text/javascript'>alert('$message');</script>";
                          }
                        }
                    }
                  ?>
              </div>

              

              <div class="devicerepair_container">
                <h2>Description</h2><br>
                <p>We would update the description right after we have observed your devices.</p><br>
                <?php
                $query = "SELECT * FROM SERVICE WHERE USERNAME ='{$_SESSION['USERNAME']}'";
                if ($result = $con->query($query)) {
                  while ($row = $result->fetch_assoc()) {
                    $descr = $row["DESCRIPTION"];
                    echo '<textarea type="text" rows="5" cols="30" style="text-align:center; font-size:15px">'.$descr.'</textarea><br>';
                  }
                  $result->free();
                }
                  ?>
              </div>
                    
                <div class="devicerepair_container">
                  <h2>Status / Pick Up Date</h2><br>
                  <p>The progress of repairing or servicing. Example =  New / In Progress or Processing / Completed </p><br>
                  <?php
                $query = "SELECT * FROM SERVICE WHERE USERNAME ='{$_SESSION['USERNAME']}'";
                if ($result = $con->query($query)) {
                  while ($row = $result->fetch_assoc()) {
                    $status = $row["STATUS"];
                    echo '<textarea type="text" rows="2" cols="10" style="text-align:center; font-size:15px">'.$status.'</textarea><br>';
                  }
                  $result->free();
                }
                  ?>
                    <p>Customer can pick up their devices on the date that we provided. Example =  20/09/2021</p><br>
                    <?php
                $query = "SELECT * FROM SERVICE WHERE USERNAME ='{$_SESSION['USERNAME']}'";
                if ($result = $con->query($query)) {
                  while ($row = $result->fetch_assoc()) {
                    $date = $row["PICKUP_DATE"];
                    echo '<textarea type="text" rows="2" cols="10" style="text-align:center; font-size:15px">'.$date.'</textarea><br>';
                  }
                  $result->free();
                }
                  ?>
                </div>

                <div class="devicerepair_container">
                  <h2>Payment</h2><br>
                  <p>Our team will update this area after all pocessing have done: <br>Example = RM150.00  </p><br>
                  <?php
                $query = "SELECT * FROM SERVICE WHERE USERNAME ='{$_SESSION['USERNAME']}'";
                if ($result = $con->query($query)) {
                  while ($row = $result->fetch_assoc()) {
                    $servcharge = $row["SERVCHARGE"];
                    echo '<textarea type="text" rows="3" cols="15" style="text-align:center; font-size:15px">Your payment will be RM'.$servcharge.'</textarea><br>';
                  }
                  $result->free();
                }
                  ?>
                </div>
                
            </div>
          </div>
        
        <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
          modal.style.display = "block";
        }
        span.onclick = function() {
          modal.style.display = "none";
        }
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
        </script>
    </div>
</body>
</html>