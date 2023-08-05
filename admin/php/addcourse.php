<?php
include 'connection.php';
if(isset($_POST["addcourse"]))
{
    $pname=$_POST["program"];
    $sem=(int)$_POST["semester"];
    $year=$_POST["year"];
     $pname=strtolower($pname);
    $coursename=$pname."_".$sem."_".$year;
   
    $query="insert into course(program,semester,year,coursename,status) values('$pname','$sem','$year','$coursename','active')";
    $result=mysqli_query($conn, $query);
   if(mysqli_affected_rows($conn))
     {
         if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
         $_SESSION["cadded"]="yes";

     }
     header("Location: ../projectcourse.php");
    
}


