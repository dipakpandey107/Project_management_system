<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
include 'connection.php';
$otp=$_POST["otp"];
$password=$_POST["password"];
$email=$_SESSION["remail"];

if($_SESSION["otp"]==$otp)
{
    $query="update login set password='$password' where email='$email'";
    mysqli_query($conn, $query);
    $_SESSION["updates"]="yes";
    header("location: /sem6/project6sem/login.php");
}
else
{
    $_SESSION["invalidotp"]="yes";
    header("location: /sem6/project6sem/verifyotp.php");
}


