<?php
include 'connection.php';
if(isset($_POST["addproject"]))
{
    $name=$_POST["title"];
    $technology=$_POST["technology"];
    $description=$_POST["description"];
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
    $e=$_SESSION["email"];
    $q="select enrollment,course_id from student where email='$e'";
    $result=mysqli_query($conn,$q);
    $row=mysqli_fetch_array($result);
    $myenroll=$row["enrollment"];
    $mycourse=(int)$row["course_id"];


    $query="select group_id from groupmember where enrollment='$myenroll'";
    $result= mysqli_query($conn, $query);
    $row=mysqli_fetch_array($result);

    $group_id=(int)$row["group_id"];
    //prevent duplicate project in same course
    $dupq="select project_title from projectgroup where project_title='$name' and course_id='$mycourse' and group_id!='$group_id'";
    $dupr=mysqli_query($conn,$dupq);
    if(!mysqli_num_rows($dupr)>0)
    {
        $query="update projectgroup set project_title='$name',technology='$technology',description='$description' where group_id='$group_id'";
        $result= mysqli_query($conn, $query);
        if(mysqli_affected_rows($conn))
        {
            
            $_SESSION["projectadded"]="yes";
        }
    }
    else
    {
        //duplicate project
        $_SESSION["duplicatep"]="yes";
        
    }

   
    header("Location: /sem6/project6sem/student/projectdetails.php");
}


?>