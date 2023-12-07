<?php
include 'config.php';

session_start();

error_reporting(0);

if (isset($_POST['btnlogin'])) {

    if (isset($_SESSION['USERNAME'])) {
        header("Location: welcome.php");
    }
	$usrname = $_POST['usrname'];
	$password1 = $_POST['password1'];
    $email = $_POST['email'];

	$sql = "SELECT * FROM CUSTOMER WHERE USERNAME='$usrname' AND PASSWORD='$password1'";
	$result = mysqli_query($con, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['USERNAME'] = $row['USERNAME'];
        $_SESSION['PASSWORD'] = $row['PASSWORD'];
		header("Location: welcome.php");
       
	} else {
		echo "<script>alert('Woops! Username or Password is Wrong.')</script>";
	}
}

            
                if (isset($_POST['btnregister'])) {

                    if(isset($_SESSION['USERNAME'])){
                        header("Location: index.php");
                    }
    
                   
                    $usrname = $_POST['username'];
                    $name = $_POST['name'];
                    $address = $_POST['address'];
                    $email = $_POST['email'];
                    $phonenum = $_POST['phonenum'];
                    $password1 = $_POST['password1'];
                    $password2 = $_POST['password2'];

                    $con = mysqli_connect($servername, $username, $password, $dbname);
                    $reg_cust = "INSERT INTO customer (username, name, address, email, phonenum, password) 
                                    VALUES ('$usrname', '$name', '$address', '$email', '$phonenum', '$password1')";
                    $usrcheck = "SELECT * FROM customer WHERE username='$usrname'";
                    $resultreg = mysqli_query($con, $usrcheck);

                    //check password reconfirmation
                    if (($password1!=$password2)){
                        $message="Password is incorrect. Please try again.";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                    else if ($resultreg->num_rows > 0) {
                        $row = mysqli_fetch_assoc($resultreg);
                        $_SESSION['USERNAME'] = $row['USERNAME'];
                        echo "<script>alert('Woops! Username is already exist')</script>";
                    }
                    else{
                        $result_reg = mysqli_query($con, $reg_cust);
                        if($result_reg){
                            $message="Register success. You can login now.";
                            echo "<script type='text/javascript'>alert('$message');</script>";
                        }
                        else{
                            $message="Registration fail. Please try again.";
                            echo "<script type='text/javascript'>alert('$message');</script>";
                        }
                    }
                }

                ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in | Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="div1">
        <ul>
            <li><a style="float: left;" onclick= "location.href = 'welcome.html';">Home</a></li>
            <li><a style="float: left;" onclick= "javascript:history.back()">Previous</a></li>
        </ul>

        <div style="text-align: left;">
            <div class="login_container">
                <p style= "color: black; background-color: #f5f3d4; border-bottom: 1px solid white; padding: 5px;">
                <b>Log in</b></p>
                     
                <p style="padding: 5px; background-color: rgba(165, 42, 42, 0.24)">Please fill in the<br>
                        ID and Password field in <br>
                        the login box to continue as a <br>
                        regular customer to place<br>
                        your service request.</p>
            </div>
        </div>
        <div style="text-align: left;">
            <div class="register_container">
                <p style= "border-bottom: 1px solid white; padding: 5px; background-color: rgba(165, 42, 42, 0.24);">
                <b>Register</b></p>
                     
                <p style="color: black; padding: 5px; background-color: #f5f3d4;">Filling in the register<br>
                        box with your details will<br>
                        make it easier for us to<br>
                        contact you. Register to <br>
                        continue the process.</p>
                        
            </div>
        </div>
        <div class = "form-box" >
        <center>
            <button style="margin: 10px"onclick= "location.href = 'forgetpassword.php';">Forgot password</button>
        </center>
            <div class = "button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <div class="avatar-icons">
                <img src="indexpic2.png">
            </div>
            <form style="top: 200px;" action="" id="login" method="POST" class = "input-group">
                <input type="text" class="input-field" id="cust" name="usrname" value="<?php echo $usrname;?>" placeholder="Enter your username" required>
                <input type="text" class="input-field" id="cust" name="email" value="<?php echo $email;?>" placeholder="Enter your e-mail" required>
                <input type="password" class="input-field" id="cust" name="password1" value="<?php echo $_POST['password1'];?>" placeholder="Password" required>
                <button type="submit" id="btnsubmit" name="btnlogin" class="submit-btn">Log In</button>
            </form>
           
            <form style="top: 200px;"action="" id="register" method="POST" class = "input-group">
                <input type="text" class="input-field" id="cust" name="username" placeholder="Username" required>
                <input type="text" class="input-field" id="cust" name="name" placeholder="Name" required>
                <input type="text" class="input-field" id="cust" name="address" placeholder="Address" required>
                <input type="email" class="input-field" id="cust" name="email" placeholder="Email" required>
                <input type="text" class="input-field" id="cust" name="phonenum" placeholder="Phone Number" required>
                <input type="password" class="input-field" id="cust" name="password1" placeholder="Enter Password" required>
                <input type="password" class="input-field" id="cust" name="password2" placeholder="Password Confirmation" required>
                <button type="submit" id="btnsubmit" name="btnregister" class="submit-btn">Register</button>
            </form>
            
        </div>


    </div>
    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        function register(){
            x.style.left= "-400px";
            y.style.left= "45px";
            z.style.left= "75px";
        }
        function login(){
            x.style.left= "45px";
            y.style.left= "-400px";
            z.style.left= "1px";
        }
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
</body>
</html>
