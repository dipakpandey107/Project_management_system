<?php
include 'connection.php';

if(!isset($_POST["faculties"]))
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    };
                    $_SESSION["fns"]="yes";
                    header("Location: /sem6/project6sem/faculty/createpanel.php");
                }
                
              

else
{
if(isset($_POST["addpanel"]))
{
    $eval=(int)$_POST["eval_id"];
    $course=(int)$_POST["course"];
    $desc="";
  
    foreach($_POST["faculties"] as $faculty)
    {
        $query="select * from faculty where faculty_id='$faculty'";
        $result=mysqli_query($conn, $query);
        $result=mysqli_fetch_array($result);
        $desc.=$result["faculty_name"]." ";
    }

            $query="insert into panel_eval(eval_id,course_id,panel_desc) values('$eval','$course','$desc')";
            $result=mysqli_query($conn, $query);

            $query="select panel_id from panel_eval ORDER by panel_id desc LIMIT 1";
            $result=mysqli_query($conn, $query);
            $result=mysqli_fetch_array($result);
            $id=$result["panel_id"];

            foreach($_POST["faculties"] as $faculty)
            {
                $query="insert into panelmember(panel_id,faculty_id) values('$id','$faculty')";
                $result=mysqli_query($conn, $query);
            }
           
           
            if(mysqli_affected_rows($conn))
            {
                if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
                $_SESSION["padded"]="yes";
            }
            
            header("Location: /sem6/project6sem/faculty/createpanel.php");
}
}    

if(isset($_POST["delete"]))
{
    $panel_desc=$_POST["panel_desc"];
    $query="select panel_id from panel_eval where panel_desc='$panel_desc'";
    $result=mysqli_query($conn,$query);
    $result=mysqli_fetch_array($result);
    $panel_id=$result["panel_id"];
    $query="delete from panel_eval where panel_id='$panel_id'";
    mysqli_query($conn,$query);
    $query="delete from panel_member where panel_id='$panel_id'";
    mysqli_query($conn,$query);

    header("Location: /sem6/project6sem/faculty/createpanel.php");
}
