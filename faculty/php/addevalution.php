<?php
include 'connection.php';
if (isset($_POST["addevalution"])) {

    if (!isset($_POST["cr"])) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        };
        $_SESSION["nocr"] = "yes";
        header("Location: /sem6/project6sem/faculty/createevaluation.php");
    } else {




        if (count(array_unique($_POST["cr"])) == count($_POST["cr"])) {
            $name = $_POST["name"];
            $date = $_POST["date"];

            $desc = $_POST["description"];
            $type = $_POST["type"];
            $course_id;
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            //prevent duplicate entry
            $q="select eval_name,edate from sheduleevalution where eval_name='$name' and edate='$date'";
            $rrr=mysqli_query($conn,$q);
            if(!mysqli_num_rows($rrr)>0)
            {

            



            $email = $_SESSION["email"];
            $query = "select faculty_id from faculty where email='$email'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result);
            $fid = $row["faculty_id"];

           

            $q = "select course_id from committe where faculty_id='$fid'";
            $result = mysqli_query($conn, $q);
            $row = mysqli_fetch_array($result);
            $course_id = (int)$row["course_id"];



            $q = "insert into sheduleevalution(course_id,edate,type,description,eval_name) values('$course_id','$date','$type','$desc','$name')";
            $result = mysqli_query($conn, $q);
            $q = "select max(eval_id) as id from sheduleevalution";
            $result = mysqli_query($conn, $q);
            $row = mysqli_fetch_array($result);
            $id = $row["id"];
            $i = 0;



            foreach ($_POST["cr"] as $cr) {


                $cr = (int)$cr;
                $mr = (int)$_POST["mr"][$i];


                $q = "insert into evalutioncriteria(eval_id,criteria_id,out_of_marks) values('$id','$cr','$mr')";
                $result = mysqli_query($conn, $q);

                $i = $i + 1;
            }

            if (mysqli_affected_rows($conn)) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                };
                $_SESSION["evalutionadded"] = "yes";
                
             //sending mails to all students
             include("sendmail.php");
             $ename=$_POST["name"];
            
             smtp_mailer($ename,$course_id,"create");
            }

           
        } else {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            };
            $_SESSION["duplicatecr"] = "yes";
            header("Location: /sem6/project6sem/faculty/createevaluation.php");
        }
    }
    }
}



if (isset($_POST["deleteeval"])) {

    $eval_id = $_POST["eval_id"];

     //sending mails to all students
     include("sendmail.php");
     $query = "select * from sheduleevalution where eval_id='$eval_id'";
     $result = mysqli_query($conn, $query);

    
     $r=mysqli_fetch_array($result);
     $ename=$r["eval_name"];
     $course_id=$r["course_id"];
    
     smtp_mailer($ename,$course_id,"delete");

    $query = "delete from sheduleevalution where eval_id='$eval_id'";
    $result = mysqli_query($conn, $query);
    $query = "delete from evalutioncriteria where eval_id='$eval_id'";
    $result = mysqli_query($conn, $query);
    $query = "delete from panel_eval where eval_id='$eval_id'";
    $result = mysqli_query($conn, $query);
    $query = "delete from studentmarks where eval_id='$eval_id'";
    $result = mysqli_query($conn, $query);
    $query = "select * from panelallocation where eval_id='$eval_id'";
    $result = mysqli_query($conn, $query);
    $pid=(int)mysqli_fetch_array($result)["panel_id"];


    $query = "delete from panelmember where panel_id='$pid'";
    $result = mysqli_query($conn, $query);

    $query = "delete from panelallocation where eval_id='$eval_id'";
    $result = mysqli_query($conn, $query);

   
}


if (isset($_POST["editeval"])) {

    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    };
    $eval_id = $_POST["eval_id"];
    $_SESSION["eval_id"] = $eval_id;
    $q = "select * from sheduleevalution where eval_id='$eval_id'";
    $result = mysqli_query($conn, $q);
    $row = mysqli_fetch_array($result);
    $_SESSION["edate"] = $row["edate"];
    $_SESSION["type"] = $row["type"];
    $_SESSION["description"] = $row["description"];
    $_SESSION["ename"] = $row["eval_name"];





    header("Location: /sem6/project6sem/faculty/editevalution.php");
}


if (isset($_POST["updateeval"])) {

    if (count(array_unique($_POST["cr"])) == count($_POST["cr"])) {
    $name = $_POST["name"];
    $date = $_POST["date"];

    $desc = $_POST["description"];
    $type = $_POST["type"];
    $course_id;
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    };


    $i = 0;
    foreach ($_POST["cr"] as $cr) {
        $cr = (int)$cr;
        $mr = (int)$_POST["mr"][$i];
        $srn = (int)$_POST["srn"][$i];

        $eid = $_SESSION["eval_id"];
        $q = "update sheduleevalution set edate='$date',type='$type',description='$desc',eval_name='$name' where eval_id='$eid'";
        $result = mysqli_query($conn, $q);


        $q = "update evalutioncriteria set criteria_id='$cr',out_of_marks='$mr' where srn='$srn'";
        $result = mysqli_query($conn, $q);

        $i = $i + 1;
    }



    header("Location: /sem6/project6sem/faculty/createevaluation.php");
}
else{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    };
    $_SESSION["duplicatecr"] = "yes";
    header("Location: /sem6/project6sem/faculty/createevaluation.php");

}
}
