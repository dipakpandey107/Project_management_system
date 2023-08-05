<!-- 
 Data To be displayed in table -- Project Title, Student Name, Criteria, (Criteria+Marks),Obtained Marks

Validation -- Obtained marks should not be greater than total marks of Criteria

For update -- delete the record and add new one !

Search -- based on project title

                            -->
<html>

<head>
    <title>CBP</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon.ico">
    <script src="assets/scripts/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        .panel {
            margin-top: 10%;
            margin-left: 20%;
        }

        #addf {
            margin-top: -10%;
            margin-left: -15%;
        }

        #datatable {
            margin-left: 18%;
            width: 85%;
        }

        .container {
            padding: 2rem 0rem;

        }

        h4 {
            margin: 2rem 0rem 1rem;
        }
        #sbtn
        {
            
            margin-left: 40%;
            margin-bottom: 5%;
        }


        
        
        
    </style>
    <script>
        window.onload = function() {
            document.getElementById('togglebtn').click();
        }
    </script>
</head>

<body>





    <div class="container" ;>
        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        };
        if (!isset($_SESSION["email"])) {

            header("location: /sem6/project6sem/index.php");
        }
        if (empty($_POST["students"])) {
            $_SESSION["smn"]="yes";
            header("location: /sem6/project6sem/faculty/evaluatestudents.php");
        }

        include 'facultydash.php';
        ?>


        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">


            </div>

            <div class="panel-body" id="addf">
                <?php
                $conn = mysqli_connect("localhost", "root", "", "project_managment_system");
                $eval_id = (int) $_POST["evalution"];

                $group = (int)$_POST["project"];
                $c = (int)$_POST["course"];

                foreach ($_POST["students"] as $e) {

                    $query = "select * from student where enrollment='$e'";
                    $result = mysqli_query($conn, $query);
                    $result = mysqli_fetch_array($result);

                    $query = "select * from sheduleevalution where eval_id='$eval_id'";
                    $ev = mysqli_query($conn, $query);
                    $ev = mysqli_fetch_array($ev);

                    $query = "select * from course where course_id='$c'";
                    $ci = mysqli_query($conn, $query);
                    $ci = mysqli_fetch_array($ci);

                    $cr = "select * from evalutioncriteria,criteriamaster where eval_id='$eval_id' and evalutioncriteria.criteria_id=criteriamaster.id and evalutioncriteria.eval_id='$eval_id'";
                    $result1 = mysqli_query($conn, $cr);



                ?>


                    <!-- INPUT GROUPS -->
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title">Enter Marks of [<?php echo "   " . $result["name"]; ?>]</h3>
                            <h4>EVALUATION NAME: <?php echo "   " . $ev["eval_name"]; ?></h4>
                            <h4>course NAME: <?php echo "   " . $ci["coursename"]; ?></h4>

                        </div>
                        <div class="panel-body">
                            <form action="php/addmarks.php" method="post" id="form1">
                                <input type="hidden" name="group" value="<?php echo $group; ?>">
                                <input type="hidden" name="enrollment[]" value="<?php echo $e; ?>">
                                <input type="hidden" name="evalution" value="<?php echo $eval_id; ?>">


                                <?php
                                include 'php/connection.php';

                                $e = $_SESSION["email"];
                                $q = "select * from faculty where email='$e'";
                                $r = mysqli_query($conn, $q);
                                $r = mysqli_fetch_array($r);

                                $fid = (int)$r["faculty_id"];
                                ?>
                                <input type="hidden" name="faculty" value="<?php echo $fid; ?>">
<?php
                                while ($row = mysqli_fetch_array($result1)) {
                                  

                            ?>
                               
                              

                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary" type="label"><?php echo $row["cname"]; ?> |Out Of <?php echo $row["out_of_marks"]; ?></button>
                                            <input type="hidden" name="cr[]" value="<?php echo $row["id"]; ?>">
                                    </span>
                                    <?php $o = $row["out_of_marks"];
                                    $o = (int)$o;
                                    ?>

<input name="om[]" class="form-control" type="number" min="0" max="<?php echo $o; ?>"  required="" title="number should be positive and under out of marks">
                                </div>
                                <br>
                                <?php  } ?>




                              
                        </div>
                    </div>

                <?php } ?>
               

            </div>
            <br>

<button type="submit" name="addmarks" class="btn btn-success" id="sbtn"><i class="fa fa-check-circle"></i> Submit</button>


</form>


        </div>






    </div> <!-- END INPUT GROUPS -->

    <?php
    if (isset($_SESSION["fadded"])) {
        if ($_SESSION["fadded"] == "yes") {
            $_SESSION["fadded"] = "no";
    ?>
            <script>
                swal("faculty added successfully");
            </script>
    <?php
        }
    }
    ?>
</body>

</html>