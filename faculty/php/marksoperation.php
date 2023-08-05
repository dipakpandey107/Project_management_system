<?php
include 'connection.php';
$e=$_POST["enrollment"];
$eval_id=(int)$_POST["eval_id"];

if(isset($_POST["delete"]))
{
    $q="delete from studentmarks where enrollment='$e' and eval_id='$eval_id'";
    mysqli_query($conn,$q);
    header("Location: /sem6/project6sem/faculty/evaluatestudents.php");
}
if(isset($_POST["edit"]))
{
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
    $_SESSION["estudente"]=$e;
    $_SESSION["estudenteval"]=$eval_id;
    header("Location: /sem6/project6sem/faculty/editmarks.php");

}


?>