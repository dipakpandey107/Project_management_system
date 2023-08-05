<?php
include 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
$enrollment=$_POST["enrollment"];
$name=$_POST["name"];
$email=$_POST["email"];
$contact=$_POST["contact"];
$cid=(int)$_POST["courseid"];
$aemail=$_SESSION["studentemail"];

if($email!=$aemail){
//checkduplicate mail before update
$t="select count(email)as n from login where email='$email'";
$rr=mysqli_query($conn, $t);
$rr=mysqli_fetch_array($rr);
$s=(int)$rr["n"];

}

//actual updates
if($s==0)
{
$query="update student set name='$name',email='$email',contact_number='$contact',course_id='$cid' where enrollment='$enrollment'";
mysqli_query($conn, $query);
$query="update login set email='$email' where email='$aemail'";
mysqli_query($conn, $query);
$_SESSION["updatedf"]="no";
}
else
{
    $_SESSION["updatedf"]="yes";
}
header("location: ../student.php");
 
?>