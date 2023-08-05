<?php

include 'connection.php';
if(isset($_POST["addmarks"]))
{
$group_d=(int)$_POST["group"];

$fid=(int)$_POST["faculty"];
$eid=(int)$_POST["evalution"];
$q="select panel_id from panelallocation where group_id='$group_d' and eval_id='$eid'";
$rrr=mysqli_query($conn,$q);
$rrr=mysqli_fetch_array($rrr);
$panel_id=(int)$rrr["panel_id"];

$qq="select count(criteria_id) as id from evalutioncriteria where eval_id='$eid'";
$qe=mysqli_query($conn,$qq);
$qee=mysqli_fetch_array($qe);
$c_id=(int)$qee["id"];

$i=0;

$j=0;
$students=array();
foreach ($_POST["enrollment"] as $en) {
       

    while ($c_id!=0) {

     

        $cr=(int)$_POST["cr"][$i];
        $om=(int)$_POST["om"][$i];

        //prevent duplicate entry
        $dup="select * from studentmarks where enrollment='$en' and eval_id='$eid' and criteria_id='$cr'";
        $dupr=mysqli_query($conn,$dup);
    if(!mysqli_num_rows($dupr)>0)
    {

        



            $q="insert into studentmarks values('$group_d','$en','$panel_id','$eid','$cr','$om')";
            mysqli_query($conn,$q);
        $c_id=$c_id-1;
            $i=$i+1;
    }
        }

        $c_id=(int)$qee["id"];
        $students[]=$en;
        
    }
   
    //send email
    include("sendmailformarks.php");
    smtp_mailer($students);


    
}

if(isset($_POST["updatemarks"]))
{
    $e=$_POST["enrollment"];
    $eval_id=(int)$_POST["eval_id"];
    $i=0;
    $j=0;





mysqli_query($conn,$q);
foreach ($_POST["cr"]  as $cr) {
    $om=(int)$_POST["om"][$i];
    


    $q="update studentmarks set om='$om' where enrollment='$e' and eval_id='$eval_id' and criteria_id='$cr'";
    mysqli_query($conn,$q);
   
    $i=$i+1;
    }



}

header("Location: /sem6/project6sem/faculty/evaluatestudents.php")


?>