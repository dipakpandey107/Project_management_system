<?php
include 'connection.php';
if(isset($_POST["addcriteria"]))
{
    $name=$_POST["name"];
 
   

    $query="insert into criteriamaster(cname) values('$name')";
    $result=mysqli_query($conn, $query);
    
    if(mysqli_affected_rows($conn))
     {
         if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
         $_SESSION["criteriaadded"]="yes";
     }
     
       
       header("Location: /sem6/project6sem/faculty/criteria.php");
   
}

if(isset($_POST["deletecriteria"]))
{
   
    $id=$_POST["id"];
   

    $query="delete from criteriamaster where id='$id'";
    $result=mysqli_query($conn, $query);

    header("Location: /sem6/project6sem/faculty/criteria.php");
}
