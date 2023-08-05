<?php
include 'connection.php';
if(isset($_POST["addcommittee"]))
{
    $course=(int)$_POST["course"];
    

          if (session_status() === PHP_SESSION_NONE) {
    session_start();
          };
   
  

   
        foreach($_POST["faculties"] as $group)
        {
            $group=(int)$group;
            $query="insert into committe(course_id,faculty_id) values('$course','$group')";
            $result=mysqli_query($conn, $query);
        }

   
         
   
}
else
if(isset($_POST["delete"]))
{
    $id=(int)$_POST["id"];
    $query="delete from committe where committee_id='$id'";
    $result=mysqli_query($conn, $query);
   

}
header("Location: ../createcommittee.php");