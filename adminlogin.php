<?php
include 'config.php';

session_start();

error_reporting(0);

if (isset($_POST['btnlogin'])) {

    if (isset($_SESSION['ADMIN_ID'])) {
        header("Location: customerdetails.php");
    }
	$ADMIN_ID = $_POST['ADMIN_ID'];
	$ADMIN_PASSWORD = $_POST['ADMIN_PASSWORD'];

	$sql = "SELECT * FROM ADMIN WHERE ADMIN_ID='$ADMIN_ID' AND ADMIN_PASSWORD='$ADMIN_PASSWORD'";
	$result = mysqli_query($con, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['ADMIN_ID'] = $row['ADMIN_ID'];
        $_SESSION['ADMIN_PASSWORD'] = $row['ADMIN_PASSWORD'];
		header("Location: customerdetails.php");
	} else {
		echo "<script>alert('Woops! ID or Password is Wrong.')</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
</head>
<style>
    		
    *{
        box-sizing: border-box;
        padding: 0px;
        margin: 0px;
        font-family: 'Times New Roman', Times, serif
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

    .form-box{
    width: 300px;
    height: 340px;
    position: relative;
    font-size: 15px;
    top: 95px;
    margin: auto;
    background: rgba(248, 248, 248, 0.829);
    padding: 5px;
    overflow: auto;
    }
    .button-box{
        width: 150px;
        margin: 15px auto;
        position: relative;
        text-align: center;
        box-shadow: 0 0 20px 9px #caada11f;
        border-radius: 30px;
    }
    .toggle-btn{
        padding: 10px 7px;
        cursor: pointer;
        background: transparent;
        border: 0;
        outline: none;
        position: relative;
    }
    ::placeholder{
        color: rgb(20, 19, 19);
    }
    #btn{
        top: 0;
        left: 0;
        position: absolute;
        width: 75px;
        height: 100%;
        background: linear-gradient(to right, rgb(235, 240, 209),#f7f7cf);
        border-radius: 30px;
        transition: .7s;
    } 
    .avatar-icons{
        margin: 0px auto;
        text-align: center;
    }
    .avatar-icons img{
        padding: 5px;
        width: 100px;
    }
    .input-group{
        top: 5px;
        position: relative;
        margin: auto;
        width: 200px;
        transition: .7s;
        padding: 10px;
        padding-bottom: 50px;
    }
    .input-field{
        width: 95%;
        height: 20%;
        padding: 10px 0;
        border-left: 0;
        border-top: 0;
        border-right: 0;
        position: relative;
        border-bottom: 1px solid rgb(20, 20, 20);
        outline: none;
        background: transparent;
        padding-bottom: 7px;
    }
    .submit-btn{
        width: 85%;
        padding: 10px;
        cursor: pointer;
        display: block;
        background: linear-gradient(to right, rgb(235, 240, 209),#f7f7cf);
        border: 0;
        outline: none;
        margin: auto;
        border-radius: 30px;
    }
    ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
    }
    li a, .dropbtn {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px 16px; 
        text-decoration: none;
    }
    li a:hover, .dropdowns:hover .dropbtn {
        background-color: #fdfdd4a4;
    }
    li.dropdowns {
        display: inline-block;
    }
    th,td{
    padding: 8px;
    border: 1px solid none;
    }
    tr, td{
        padding: 8px;
        border: 1px solid none;
    }
    table {
        position: relative;
        top: 250px;
        margin: 0;
        text-align:center;
        border-collapse: collapse;
        border: 1px solid white;
    }
    table.center{
        margin-left: auto;
        margin-right: auto;
    }
</style>
<body>
    <div class="div1">
        <ul>
            <li><a style="float: left;" onclick= "location.href = 'welcome.html';">Home</a></li>
            <li><a style="float: left;" onclick= "javascript:history.back()">Previous</a></li>
        </ul>
        <h1 align="center" style="color: white; top: 80px; position:relative; margin:auto;">ADMIN LOGIN</h1>
        <div class = "form-box" >
            <div class="avatar-icons">
                <img src="indexpic2.png">
            </div>
            <form action="" id="login" method="POST" class = "input-group">
                <input type="text" class="input-field" name="ADMIN_ID" value="<?php echo $ADMIN_ID;?>" placeholder="Enter Your ID" required>
                <input type="password" class="input-field" name="ADMIN_PASSWORD" value="<?php echo $_POST['ADMIN_PASSWORD'];?>" placeholder="Password" required>
                <button type="submit" id="btnsubmit" name="btnlogin" class="submit-btn">Log In</button>
            </form>
            <center>
            <a style="position: relative; margin:auto; text-align:center" href="adminregister.php">Do not have an account? Register now</a>
            </center>
        </div>
        
    </div>
</body>
</html>