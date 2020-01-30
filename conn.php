<?php

$servername = "localhost";
$username = "root";
$password = "";
$db_name="twitter";



$link = mysqli_connect($servername, $username, $password,$db_name);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";




?>