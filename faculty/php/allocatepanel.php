<?php
include 'connection.php';
if(isset($_POST["ap"]))
{
    $eval_id=(int)$_POST["evalution"];
    $panel_id=(int)$_POST["panel_id"];
   
  
    foreach($_POST["project"] as $group)
    {
        $group=(int)$group;
        $query="insert into panelallocation values('$panel_id','$group','$eval_id')";
        $result=mysqli_query($conn, $query);
    }
    
    if(mysqli_affected_rows($conn))
     {
         if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
         $_SESSION["paadded"]="yes";
     }
       
       header("Location: /sem6/project6sem/faculty/allocatepanel.php");
   
}
if(isset($_POST["delete"]))
{
    $panel_id=(int)$_POST["panel_id"];
    $group_id=(int)$_POST["group"];
    $query="delete from panelallocation where panel_id='$panel_id' and group_id='$group_id'";
    mysqli_query($conn,$query);

    if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
    $_SESSION["pdelete"]="yes"; 

    header("Location: /sem6/project6sem/faculty/allocatepanel.php");

}
