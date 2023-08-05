<?php
include 'connection.php';
if(isset($_POST["active"]))
{
    $coursename=$_POST["cname"];
    $query="update course set status='active' where coursename='$coursename'";
    mysqli_query($conn, $query);
}
if(isset($_POST["inactive"]))
{
    $coursename=$_POST["cname"];
    $query="update course set status='inactive' where coursename='$coursename'";
     mysqli_query($conn, $query);
}
header("location: ../projectcourse.php");
?>