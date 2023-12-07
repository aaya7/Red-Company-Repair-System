<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "redcompany";

$con = new mysqli($servername, $username, $password, $dbname);

if (!$con){
  echo "<script>alert('Connection failed!');</script>";
}

?>