<?php
include 'config.php';

session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<style>
    *{
    box-sizing: border-box;
    padding: 0px;
    margin: 0px;
    font-family: 'Times New Roman', Times, serif;
}
    .div1{
    height: 100%;
    width: 100%;
    background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),url(indexpic.jpeg);
    background-position: center;
    background-size: cover;
    position:absolute;
    animation: transitionAn 0.75s;
}
@keyframes transitionAn{
    from{
        opacity: 0;
        transform: rotateX(-10deg);
    }
    to {
        opacity: 1;
        transform: rotateX(0);
    }
}
    .cp_cont{
        
        background-color: white;
        border: 1px solid none;
        width: 300px;
        height: 300px;
        top: 25%;
        padding: 5px;
        position: relative;
        margin: auto;
        text-align: center;
}
.error p {
	color:#FF0000;
	font-size:20px;
	font-weight:bold;
	margin:50px;
	}
</style>
<body>
<div class="div1">
    <div class="cp_cont">
        <h3><br><br>Forgot Password</h3><br>
        <form action="" id="forgot" method="POST" name="reset">
            <input type="text" class="input-field" name="usrname" placeholder="Enter Username" required><br><br>
            <button type="submit" id="btnsubmit" name="btnconfirm">Confirm</button>
            <button type="submit"  value="Reset Password" id="btncancel" name="btncancel" onclick= "location.href = 'index.php';">Cancel</button>
        </form>
        <?php
        include_once 'config.php';
        error_reporting(0);
            if (isset($_POST['btnconfirm'])){

            $usrname = $_POST['usrname'];

            $qry = "SELECT * from CUSTOMER WHERE USERNAME='$usrname'";
            $result = mysqli_query($con,$qry);
            $row = mysqli_fetch_assoc($result);
            $fetch_username=$row['USERNAME'];
            $password=$row['PASSWORD'];
                if($usrname==$fetch_username){
                    $message = "Username Verified Sucessfully";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    echo '<label><br>Your password is: </label><br>';
                    echo '<textarea type="text" rows="2" cols="10" style="text-align:center; font-size:15px">'.$password.'</textarea><br>';
                    ?>
                    <button type="submit"  value="Back" id="Back" name="Back" onclick= "location.href = 'index.php';">Back</button>
                    <?php
                }
                    else{
                        $message = "Username is not correct";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                }
    
    }
    ?>
    </div>
</div>
</body>
</html>