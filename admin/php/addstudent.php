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
            $getHighestRow = $sheet->getHighestRow();
            for ($i = 2; $i <= $getHighestRow; $i++) {
                $enrollment = $sheet->getCellByColumnAndRow(0, $i)->getValue();
                $name = $sheet->getCellByColumnAndRow(1, $i)->getValue();
                $coursename = $sheet->getCellByColumnAndRow(2, $i)->getValue();
                $q = "select course_id from course where coursename='$coursename' and status='active'";
                $result = mysqli_query($conn, $q);
                if(mysqli_num_rows($result)>0)
                {
                            $result = mysqli_fetch_array($result);
                            $courseid = (int)$result["course_id"];
                            $email = $sheet->getCellByColumnAndRow(3, $i)->getValue();
                            $contact = $sheet->getCellByColumnAndRow(4, $i)->getValue();
                            

                            //verifying inputed data
                            $echeck="/[a-zA-Z.][a-zA-Z0-9]+@gmail.com/";
                            $ccheck="/[789][0-9]{9}/";
                            $ncheck="/[a-zA-Z]+/";
                            $encheck="/[2][0][1-9][0-9]+/";
                            
                            if (preg_match($echeck,$email) and preg_match($ccheck,$contact) and preg_match($ncheck,$name) and preg_match($encheck,$enrollment)) {
                                $query = "insert into student values('$enrollment','$name','$courseid','$email','$contact')";
                                $result = mysqli_query($conn, $query);

                                if (mysqli_affected_rows($conn) != -1) {
                                    
                                    $_SESSION["sadded"] = "yes";

                                    $query = "insert into login(email,password,user_type) values('$email','password','s')";
                                    $result = mysqli_query($conn, $query);
                                } else {
                                
                                    $_SESSION["eduplicates"] = "yes";
                                }
                            }
                            else
                            {
                                $_SESSION["invaliddata"]="yes";
                            }
                        }
                        else
                        {
                            $_SESSION["nocourse"] = "yes";
                        }
            
            }
            
        }
    } else {
        echo "Invalid file format";
        $_SESSION["sfileformat"] = "yes";
    }
    header("Location: ../student.php");
}

if (isset($_POST["addstudent"])) {
    $name = $_POST["name"];
    $enrollment = $_POST["enrollment"];
    $courseid = (int)$_POST["courseid"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $query = "insert into student values('$enrollment','$name','$courseid','$email','$contact')";
    $result = mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) != -1) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        };
        $_SESSION["sadded"] = "yes";

        $query = "insert into login(email,password,user_type) values('$email','password','s')";
        $result = mysqli_query($conn, $query);
    } else {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        };
        $_SESSION["duplicates"] = "yes";
    }

    header("Location: ../student.php");
}
