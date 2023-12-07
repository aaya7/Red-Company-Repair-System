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
    <title>WELCOME USER</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="div1">
        <ul>
            <li><a style="float: left;" onclick= "location.href = 'welcome.html';">Home</a></li>
            <li><a style="float: left;" onclick= "javascript:history.back()">Previous</a></li>
        </ul>
        <div class ="logged_user_welcome">
            <p><br>Welcome To RED COMPANY<br><br> REPAIR SERVICE website <b><?php echo $_SESSION['USERNAME'];?></b></p><br>
            <div class="button_cont">
                <div class="button_choice" id="myBtn">EDIT PROFILE</div>
                    <div id="myModal" class="modal">
                        <div class="modal-content" style="width:300px">
                            <span class="close">&times;</span>
                            <h4 style="color: black;"><br><br>PLEASE FILL IN THIS FIELD TO UPDATE YOUR PROFILE</h4>
                            <form action="" id="update" method="POST"><br><br>
                            <input type="text" id="cust" name="name" placeholder="New Name"><br>
                            <input type="text"id="cust" name="address" placeholder="New Address"><br>
                            <input type="email"id="cust" name="email" placeholder="New Email"><br>
                            <input type="text"id="cust" name="phonenum" placeholder="New Phone Number"><br><br>
                            <button type="submit" id="btnupdate" name="btnupdate">UPDATE</button><br><br>
                            </form>
                            <?php
                            include_once 'config.php';
                            if(isset($_POST['btnupdate'])){
                                $name= $_POST['name'];
                                $address= $_POST['address'];
                                $email= $_POST['email'];
                                $phonenum = $_POST['phonenum'];
                                $qry = "UPDATE `CUSTOMER` SET NAME = '$name',ADDRESS = '$address', 
                                EMAIL = '$email', PHONENUM = '$phonenum'
                                WHERE USERNAME ='{$_SESSION['USERNAME']}'";
                                $result = mysqli_query($con, $qry);
                                
                                    if($result){
                                        echo "<script type='text/javascript'>alert('Updated Successfully!');</script>";
                                        } 
                                    else {
                                        echo "<script type='text/javascript'>alert('Error updating record.')</script>";
                                        }
                            } 
                            ?>
                        <button style="margin: 10px"onclick= "location.href = 'changepass.php';">Change password</button>
                        </div>
                    </div>
                <div class="button_choice" onclick="location.href = 'menu.html';">MAIN MENU</div>
                <div class="button_choice" onclick=" location.href='logout.php'; 
                return confirm('Are You sure you want to logout?');">LOG OUT</div>
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

