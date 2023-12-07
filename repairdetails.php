<?php
session_start();

if(!isset($_SESSION['ADMIN_ID'])){
    header("Location: adminlogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Details Page</title>
    <link rel="stylesheet" href="adminstyle.css"/>
</head>
<body>
  <div class="divbg">
    <ul>
        <li><a style="float: left;" onclick= "location.href = 'welcome.html';">Home</a></li>
        <li><a style="float: left;" onclick= "javascript:history.back()">Previous</a></li>
        <li><a style="float: left;" onclick= "location.href = 'servicedetails.php';">Next</a></li>
        <li class="dropdowns" style="float: right;">
        <a href="javascript:void(0)" class="dropbtn"><span>&#8803;</span></a>
        <div class="dropdowns-content">
            <a href="customerdetails.php">Customer Details</a>
            <a href="devicedetails.php">Device Details</a>
            <a href="repairdetails.php">Repair Details</a>
            <a href="servicedetails.php">Service Details</a>
            <a onclick=" location.href='logoutadmin.php'; 
                return confirm('Are You sure you want to logout?');">Log Out</a>
        </div>
        </li>
        <li><input style="float: right; padding:5px; padding-top:2px; top:9px; margin:auto; position:relative" 
        onkeyup="myFunction()" type="text" id="myInput" placeholder="Search"></li>
    </ul>

    <div class="bt_cont">
        <button id="myBtn" class="openbutton">MODIFY</button>
        <div id="myModal" class="modal">
            <div class="modal-content">
                  <span class="close">&times;</span>
                  <h4 style="color: black;"><br><br>PLEASE FILL IN THIS FIELD TO MODIFY</h4>
                            <form action="" id="update" method="POST">
                            <input type="text" name="repid" placeholder="Enter Repair ID"></input><br>
                            <input type="text" name="repcharge" placeholder="Repair Charge (RM)"></input><br>
                            <input type="text" name="status" placeholder="Status"><br></input><br>
                            <label>Choose Date:</label><br>
                            <input type="date" name="pickup_date" placeholder="Enter Pick Up Date"></input><br><br>
                            <label>Specify Description:</label><br>
                            <textarea type="text" rows="5" cols="30" name="descr" placeholder="Enter Description"></textarea><br>
                            <button type="submit" id="btnupdate" name="btnupdate">UPDATE</button>
                            </form>
                            <?php
                            include_once 'config.php';
                            if(isset($_POST['btnupdate'])){
                                $repid=$_POST['repid'];
                                $descr= $_POST['descr'];
                                $pickup_date= $_POST['pickup_date'];
                                $repcharge= $_POST['repcharge'];
                                $status = $_POST['status'];
                                $qry = "UPDATE `REPAIR` SET REPAIRID = '$repid',`DESCR` = '$descr',
                                PICKUP_DATE = '$pickup_date',REPCHARGE = '$repcharge', STATUS = '$status'
                                WHERE REPAIRID = '$repid'";
                                $result = mysqli_query($con, $qry);
                                
                                    if($result){
                                        echo "<script type='text/javascript'>alert('Updated Successfully!');</script>";
                                        } 
                                    else {
                                        echo "<script type='text/javascript'>alert('Error updating record.');</script>";
                                        }
                            } 
                            ?>
                            
                            <form action="" id="delete" method="POST"><br><br>
                            <input type="text" name="repid" placeholder="Enter Repair ID"></input><br>
                            <button type="submit" id="btndelete" name="btndelete">DELETE</button>
                            </form>
                            <?php
                            include_once 'config.php';
                            if(isset($_POST['btndelete'])){
                                $repid = $_POST['repid'];
                                $qry = "DELETE FROM REPAIR WHERE REPAIRID = '$repid'";
                                $result = mysqli_query($con, $qry);
                                
                                    if($result){
                                        echo "<script type='text/javascript'>alert('Deleted Successfully!');</script>";
                                        } 
                                    else {
                                        echo "<script type='text/javascript'>alert('Error deleting record.');</script>";
                                        }
                            } 
                            ?>
            </div>
        </div>
    </div> 
    <div class="large_cont">
        <h2>REPAIR DETAILS PAGE</h2>
        <?php 
            include_once "config.php";
                    
            $query = "SELECT * FROM REPAIR";
            echo '<table class="center" border="0" cellspacing="2" cellpadding="2"> 
                <tr> 
                    <td>REPAIR ID</td>
                    <td>DESCRIPTION</td> 
                    <td>PICK UP DATE</td> 
                    <td>REPAIR CHARGE (RM)</td>
                    <td>STATUS</td>
                    <td>DEVICE ID</td>
                    <td>USERNAME</td>
                     
                </tr>';

            if ($result = $con->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $repid = $row["REPAIRID"];
                    $descr = $row["DESCR"];
                    $pickup_date = $row["PICKUP_DATE"];
                    $repcharge = $row["REPCHARGE"]; 
                    $status = $row["STATUS"]; 
                    $dev_id = $row["DEV_ID"]; 
                    $usrname = $row["USERNAME"]; 

                    echo '<tr> 
                            <td>'.$repid.'</td> 
                            <td>'.$descr.'</td> 
                            <td>'.$pickup_date.'</td> 
                            <td>'.$repcharge.'</td> 
                            <td>'.$status.'</td>
                            <td>'.$dev_id.'</td>
                            <td>'.$usrname.'</td> 
                        </tr>';
                }
                $result->free();
            } 
            ?>
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

        function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
            }       
        }
        }
        </script>
</body>
</html>