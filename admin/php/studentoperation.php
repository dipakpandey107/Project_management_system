<?php
include 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
$enrollemnt=$_POST["enrollment"];
if(isset($_POST["delete"]))
{
    $query="select email from student where enrollment='$enrollemnt' ";
    $result=mysqli_query($conn, $query);
    while ($row= mysqli_fetch_array($result))
    {
        $email=$row["email"];
        $query="delete from student where enrollment='$enrollemnt'";
        mysqli_query($conn, $query);
        $query="delete from login where email='$email'";
        mysqli_query($conn, $query);
        header("location: ../student.php");
        
    }
}
if(isset($_POST["edit"]))
{
   $query="select * from student,course where enrollment='$enrollemnt' and student.course_id=course.course_id";
   $result=mysqli_query($conn, $query);
   while($row= mysqli_fetch_array($result))
   {
       $_SESSION["studentname"]=$row["name"];
       $_SESSION["studentenrollment"]=$row["enrollment"];
       $_SESSION["studentcontact"]=$row["contact_number"];
       $_SESSION["studentemail"]=$row["email"];
       $_SESSION["studentcourse"]=$row["coursename"];
       $_SESSION["scourseid"]=(int)$row["course_id"];
       
   }
   
   header("location: ../editstudent.php");
   
}

?>

