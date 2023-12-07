<?php
include 'config.php';

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
    <title>Change Password</title>
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
</style>
<body>
<div class="div1">
    <div class="cp_cont">
        <h3><br><br>Change Password</h3><br>
        <form action="" id="change" method="POST">
            <input type="password" class="input-field" name="pwd1" placeholder="Password" required><br><br>
            <input type="password" class="input-field" name="pwd2" placeholder="New Password" required><br><br>
            <input type="password" class="input-field" name="pwd3" placeholder="New Password Confirmation" required><br><br>
            <button type="submit" id="btnsubmit" name="btnconfirm">Confirm</button>
            <button type="submit" id="btncancel" name="btncancel" onclick= "location.href = 'welcome.php';">Cancel</button>
        </form>
        <?php
    include_once 'config.php';
    error_reporting(0);
        if (isset($_POST['btnconfirm'])){

            $pwd1 = $_POST['pwd1'];
            $pwd2 = $_POST['pwd2'];
            $pwd3 = $_POST['pwd3'];

            $qry = "SELECT * from CUSTOMER WHERE USERNAME='{$_SESSION['USERNAME']}'";
            $result = mysqli_query($con,$qry);
            $row=mysqli_fetch_array($result);
            if($pwd1 == $row["PASSWORD"] && $pwd2  == $pwd3) {
                $query="UPDATE CUSTOMER SET PASSWORD= '$pwd2' WHERE USERNAME='{$_SESSION['USERNAME']}'";
                mysqli_query($con, $query);
                $message = "Password Changed Sucessfully";
                echo "<script type='text/javascript'>alert('$message');</script>";
                header("Refresh: 0; welcome.php");
                } else{
                $message = "Password is not correct";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
    
    }
    ?>


    </div>
</div>
</body>
</html>