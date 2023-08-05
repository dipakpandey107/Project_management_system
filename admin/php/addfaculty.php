<?php
include 'connection.php';
if (isset($_POST["bulksubmit"])) {
    $file = $_FILES['doc']['tmp_name'];
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    };

    $ext = pathinfo($_FILES['doc']['name'], PATHINFO_EXTENSION);
    if ($ext == 'xlsx') {
        require('PHPExcel/PHPExcel.php');
        require('PHPExcel/PHPExcel/IOFactory.php');


        $obj = PHPExcel_IOFactory::load($file);
        foreach ($obj->getWorksheetIterator() as $sheet) {
            $getHighestRow = $sheet->getHighestDataRow();
            for ($i = 2; $i <=$getHighestRow; ++$i) {
                $fname = $sheet->getCellByColumnAndRow(0, $i)->getValue();
                $designation = $sheet->getCellByColumnAndRow(1, $i)->getValue();
                $email = $sheet->getCellByColumnAndRow(2, $i)->getValue();
                $contact = $sheet->getCellByColumnAndRow(3, $i)->getValue();
                $program = $sheet->getCellByColumnAndRow(4, $i)->getValue();
                $echeck="/[a-zA-Z.][a-zA-Z0-9]+@gmail.com/";
                $ccheck="/[789][0-9]{9}/";
                $fcheck="/[a-zA-Z]+/";
                $dcheck="(Assistant Professor|Associate Professor)";
                $q="select program from course where program='$program' and status='active'";
                $eq=mysqli_query($conn,$q);
                $isp=mysqli_fetch_array($eq);
                $isp=$isp["program"];
                $test=0;
                $test1=0;

                        if (preg_match($fcheck,$fname) and preg_match($dcheck,$designation) and preg_match($echeck,$email) and preg_match($ccheck,$contact) and $isp==$program ) 
                        {
                            
                            $query = "insert into faculty(faculty_name,designation,contact_number,email,program) values('$fname','$designation','$contact','$email','$isp')";
                            $result = mysqli_query($conn, $query);
                            $query = "insert into login(email,password,user_type) values('$email','password','f')";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_affected_rows($conn) != -1) {
                              
                                $_SESSION["fadded"] = "yes";
                            } else {
                                
                                $_SESSION["duplicatef"] = "yes";
                            }
                           
                        }
                        else
                        {
                            
                                $_SESSION["invalidemail"] = "yes";
                                header("Location: ../faculty.php");
                          
                           
                        }
                       
                
            }
           
        }
    } 
    else {
        echo "Invalid file format";
        $_SESSION["ffileformat"] = "yes";
    }
    header("Location: ../faculty.php");
}





if (isset($_POST["addfaculty"])) {
    $fname = $_POST["fname"];
    $designation = $_POST["designation"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $program = $_POST["program"];


    $query = "insert into faculty(faculty_name,designation,contact_number,email,program) values('$fname','$designation','$contact','$email','$program')";
    $result = mysqli_query($conn, $query);
    $query = "insert into login(email,password,user_type) values('$email','password','f')";
    $result = mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) != -1) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        };
        $_SESSION["fadded"] = "yes";
    } else {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        };
        $_SESSION["duplicatef"] = "yes";
    }

    header("Location: ../faculty.php");
}