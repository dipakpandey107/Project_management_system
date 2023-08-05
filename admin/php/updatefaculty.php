<?php
include 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
$aemail=$_SESSION["facultyemail"];
$name=$_POST["name"];
$email=$_POST["email"];
$contact=$_POST["contact"];
$designation=$_POST["designation"];
$program=$_POST["program"];
if($aemail!=$email)
{
//checkduplicate mail before update
$t="select count(email)as n from login where email='$email'";
$rr=mysqli_query($conn, $t);
$rr=mysqli_fetch_array($rr);
$s=(int)$rr["n"];


}

//actual update
if($s==0)
{
    $query="update faculty set faculty_name='$name',email='$email',contact_number='$contact',designation='$designation',program='$program' where email='$aemail'";
    mysqli_query($conn, $query);
    $query="update login set email='$email' where email='$aemail'";
    mysqli_query($conn, $query);
    $_SESSION["updatedf"]="no";
}
else
{
    $_SESSION["updatedf"]="yes";
}

header("location: ../faculty.php");
 
?>