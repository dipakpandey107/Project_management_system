<?php
include 'connection.php';
if(isset($_POST["addguide"]))
{
   
    $faculty_id=$_POST["guide_id"];
   

    foreach($_POST["projects"] as $group)
    {
        $group_id=(int)$group;
        $query="update projectgroup set guide_id='$faculty_id' where group_id='$group_id'";
        $result=mysqli_query($conn, $query);
    }
    
    
    if(mysqli_affected_rows($conn))
     {
         if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
         $_SESSION["guideadded"]="yes";
     }
       
       header("Location: /sem6/project6sem/faculty/allocateguide.php");
   
}

if(isset($_POST["deleteguide"]))
{
   
    $group_id=$_POST["groupid"];
   

    $query="update projectgroup set guide_id=null where group_id='$group_id'";
    $result=mysqli_query($conn, $query);

    header("Location: /sem6/project6sem/faculty/allocateguide.php");
}
