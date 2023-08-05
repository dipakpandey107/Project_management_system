<?php
include 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
$email=$_POST["email"];
if(isset($_POST["delete"]))
{
    
    $query="delete from faculty where email='$email'";
    mysqli_query($conn, $query);
     $query="delete from login where email='$email'";
    mysqli_query($conn, $query);
    header("location: ../faculty.php");
    
}
if(isset($_POST["edit"]))
{
   $query="select * from faculty where email='$email' ";
   $result=mysqli_query($conn, $query);
   while($row= mysqli_fetch_array($result))
   {
       $_SESSION["facultyname"]=$row["faculty_name"];
       $_SESSION["facultyemail"]=$row["email"];
       $_SESSION["facultycontact"]=$row["contact_number"];
       $_SESSION["facultydesignation"]=$row["designation"];
       $_SESSION["program"]=$row["program"];
      
       
   }
   
   header("location: ../editfaculty.php");
   
}
