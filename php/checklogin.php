<?php
include 'connection.php';
$username=$_POST["username"];
$password=$_POST["password"];
$query="select * from login where email='$username' and password='$password'";
$result=mysqli_query($conn, $query);

  if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
        while($row= mysqli_fetch_array($result))
            {

               if($row["password"]=="password")
               {
                   $_SESSION["dpassword"]="yes";
               } 
               
                $_SESSION["id"]=$row["id"];
                $_SESSION["email"]=$username;
                $_SESSION["role"]=$row["user_type"];

                if($_SESSION["role"]=='a')
                {

                    header("Location:/sem6/project6sem/admin/projectcourse.php");
                }
                elseif ($_SESSION["role"]=='f') 
                {
                    $query="select count(committee_id) as a from committe,faculty where faculty.email='$username' and faculty.faculty_id=committe.faculty_id";
                    $result=mysqli_query($conn,$query);
                    $row=mysqli_fetch_array($result);
                    if($row['a']>=1)
                    {
                       
                        $_SESSION["committeemember"]="yes";
                    }
                    else
                    {
                  
                        $_SESSION["committeemember"]="no";
                    }
                            //echo 'sorry faculties ... page under construction';
                            header("Location: /sem6/project6sem/faculty/underyourguidance.php");
                }
                elseif ($_SESSION["role"]=='s') 
                {
             
                        //echo 'sorry students...page under construction';
                        header("Location: /sem6/project6sem/student/viewevaluation.php");
                }
               
                
            }
            if(mysqli_affected_rows($conn)<=0)
            {
               $_SESSION["lfail"]="yes";
               header("Location: /sem6/project6sem/login.php");
            }
            
           
            

?>