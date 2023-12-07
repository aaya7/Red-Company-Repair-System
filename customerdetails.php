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
    <title>Customer Details Page</title>
    <link rel="stylesheet" href="adminstyle.css"/>
</head>
<body >
  <div class="divbg">
    <ul>
        <li><a style="float: left;" onclick= "location.href = 'welcome.html';">Home</a></li>
        <li><a style="float: left;" onclick= "javascript:history.back()">Previous</a></li>
        <li><a style="float: left;" onclick= "location.href = 'devicedetails.php';">Next</a></li>
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
        onkeyup="myFunction()"type="text" id="myInput" placeholder="Search"></li>
    </ul>
    <center>
    <h3><br><br>Welcome To RED COMPANY REPAIR SERVICE website <b><?php echo $_SESSION['ADMIN_ID'];?></b><br><br></h3>
    </center>

   <div class="bt_cont">
        <button id="myBtn" class="openbutton">MODIFY</button>
        <div id="myModal" class="modal">
            <div class="modal-content">
                  <span class="close">&times;</span>
                  <h4 style="color: black;"><br><br>PLEASE FILL IN THIS FIELD TO MODIFY</h4>

                            <form action="" id="delete" method="POST"><br><br>
                            <input type="text" name="username" placeholder="Enter Username"></input><br>
                            <button type="submit" id="btndelete" name="btndelete">DELETE</button>
                            </form>
                            <?php
                            include_once 'config.php';
                            if(isset($_POST['btndelete'])){
                                $usrname = $_POST['username'];
                                $qry = "DELETE FROM CUSTOMER WHERE USERNAME = '$usrname'";
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
        <h2>CUSTOMER DETAILS PAGE</h2>
        <?php 
            include_once "config.php";
                    
            $query = "SELECT * FROM CUSTOMER";
            echo '<table id="myTable" class="center" border="0" cellspacing="2" cellpadding="2"> 
                <tr> 
                    <td>USERNAME</td> 
                    <td>NAME</td> 
                    <td>ADDRESS</td> 
                    <td>EMAIL</td> 
                    <td>PHONE NUMBER</td> 
                </tr>';

            if ($result = $con->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $USERNAME = $row["USERNAME"];
                    $NAME = $row["NAME"];
                    $ADDRESS = $row["ADDRESS"];
                    $EMAIL = $row["EMAIL"];
                    $PHONENUM = $row["PHONENUM"]; 

                    echo '<tr> 
                            <td>'.$USERNAME.'</td> 
                            <td>'.$NAME.'</td> 
                            <td>'.$ADDRESS.'</td> 
                            <td>'.$EMAIL.'</td> 
                            <td>'.$PHONENUM.'</td> 
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