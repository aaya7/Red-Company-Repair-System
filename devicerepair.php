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
    <title>Device</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
  <div class="div1">
    <ul>
      <li><a style="float: left;" onclick= "location.href = 'welcome.html';">Home</a></li>
      <li><a style="float: left;" onclick= "javascript:history.back()">Previous</a></li>
      <li><a style="float: left;" onclick= "location.href = 'repair.php';">Next</a></li>
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
                  <h4>WELCOME TO DEVICE DETAILS PAGE. PLEASE SPECIFY THE DETAILS OF YOUR BROKEN DEVICE.</h4><br>
                  <p>This is a page where you have to provide all of the details that are needed
                    to repair your devices. If you have more than one device to repair, you could fill
                    in the device details again so that we could observe what we could do with your devices.
                    After you have completed this part, you can choose either you want to repair or
                    service your broken devices or both. We are currently offering two services which are device
                    repair and device service. Device repair included replacing part such as screen or
                    battery while device service included servicing such as cleaning your
                    device and ensure that your device is installed with antivirus software. 
                  </p>
                  <h4 style="color: black;"><br><br>PLEASE FILL IN THIS FIELD TO UPDATE YOUR DEVICE PROFILE</h4>
                  <form action="" id="update" method="POST"><br>
                            <input type="text" name="dev_id" placeholder="Enter Device ID"><br>
                            <input type="text" name="type" placeholder="New Type"><br>
                            <input type="text" name="sernum" placeholder="New Serial Number"><br>
                            <input type="text" name="model" placeholder="New Model"><br>
                            <label >Specify Notes:<label><br>
                            <textarea type="text" rows="5" cols="30" name="notes"></textarea><br>
                            <label >Choose New Date:<label><br>
                            <input type="date" name="date" placeholder="New Date"><br><br>
                            <button type="submit" id="btnupdate" name="btnupdate">UPDATE</button>
                            </form>
                            <?php
                            include_once 'config.php';
                            if(isset($_POST['btnupdate'])){
                                $deviceid = $_POST['dev_id'];
                                $type= $_POST['type'];
                                $sernum= $_POST['sernum'];
                                $model= $_POST['model'];
                                $notes= $_POST['notes'];
                                $date= $_POST['date'];
                                $qry = "UPDATE `DEVICE` SET `DEV_ID` = '$deviceid',
                                TYPE = '$type',SERIALNUM = '$sernum', MODEL = '$model', 
                                NOTES = '$notes', SEND_DATE = '$date'
                                WHERE DEV_ID = '$deviceid'";
                                $result = mysqli_query($con, $qry);
                                
                                    if($result){
                                        echo "<script type='text/javascript'>alert('Updated Successfully!');</script>";
                                        } 
                                    else {
                                        echo "<script type='text/javascript'>alert('Error updating record.;')</script>";
                                        }
                            } 
                            ?>
                </div>
            </div>
        </div> 
            
    <div class="devrepair_container">
      <div class="row">
          <div class="devicerepair_container">
          <h2>Drop The Date</h2><br>
          <p>Don't forget to specify estimated date here after you logged in for us to observe what we could do with your devices.</p><br>
             <form method="POST" action="" id="devdetails">
              <input type="date" name="date" id="date"></input>
          </div>
          
          <div class="devicerepair_container">
          <h2>Device Details</h2><br>
          <p>Please fill in this field with your device details:</p><br>
          <form action=devicerepair.php id="devdetails" method="POST">
            <input type="text" name="username" placeholder="Username:" required>
            <input type="text" name="dev_id" placeholder="Device ID:" required>
            <input type="text" name="type" placeholder="Device Type (Android/IOS):" required>
            <input type="text" name="serialnum" placeholder="Serial Number:" required>
            <input type="text" name="model" placeholder="Model / Brand:" required><br>
          </div>
          
          <div class="devicerepair_container">
            <h2>Notes</h2><br>
            <form action="devicerepair.php" id="devdetails" method="POST">
              <label for="notesform">Please describe your devices in this field:<label><br><br>
              <textarea type="text" rows="5" cols="30" name="notes"></textarea><br><br>
              <input type="submit" name="devsubmit" value="Submit All"><br>
            </form> 
            <?php
            include_once 'config.php';
            if (isset($_POST['devsubmit'])) {
                // receive all input values from the form
                $usrname = $_POST['username'];
                $device_id = $_POST['dev_id'];
                $device_type = $_POST['type'];
                $ser_num = $_POST['serialnum'];
                $model = $_POST['model'];
                $note  = $_POST['notes'];
                $date = $_POST['date'];
              

                $con = mysqli_connect($servername, $username, $password, $dbname);
                $insert_device = "INSERT INTO DEVICE (USERNAME, DEV_ID, TYPE, SERIALNUM, MODEL, NOTES, SEND_DATE)
                                VALUES ('$usrname', '$device_id', '$device_type', '$ser_num', '$model', '$note', '$date')";
                
                    $result_dev = mysqli_query($con, $insert_device);
                    if($result_dev){
                      $message="Submitted successfully.";
                      echo "<script type='text/javascript'>alert('$message');</script>";
                  }
                  else{
                      $message="Submitted failed. Please try again.";
                      echo "<script type='text/javascript'>alert('$message');</script>";
                  }
              }
            ?>

          </div>
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