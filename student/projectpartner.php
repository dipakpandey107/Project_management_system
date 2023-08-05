<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
$email = $_SESSION["email"];  ?>
<html>

<head>
    <?php

    if (isset($_SESSION["role"])) {
        if ($_SESSION["role"] == 's') {
    ?>
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

                .table-image {

                    td,
                    th {
                        vertical-align: middle;
                    }
                }
            </style>
            <script>
                window.onload = function() {
                    document.getElementById('togglebtn').click();

                }
            </script>
</head>

<body>


    <?php
            include 'studentdash.php';
    ?>


    <div class="container" ;>


        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <h3 class="panel-title">Project Partner</h3>
                </h3>
                <div class="right">

                    <button type="button" id="togglebtn" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>

                </div>
            </div>
            <div class="panel-body" id="addf">
                <!-- INPUT GROUPS -->
                <div class="panel">

                    <div class="panel-heading">
                        <h4> Choose Your partner </h4>
                    </div>
                    <div class="panel-body">
                        <form action="php/addpartner.php" method="post">


                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Select Student</button>
                                </span>
                                <select class="form-control" name="enrollment" >
                                    <?php
                                    include 'php/connection.php';
                                    if (session_status() === PHP_SESSION_NONE) {
                                        session_start();
                                    };
                                    $e = $_SESSION["email"];
                                    $query = "select * from student where course_id=(select course_id from student where email='$e') and email!='$e' and enrollment  not in (select enrollment from groupmember)";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <option value="<?php echo $row["enrollment"]; ?>"><?php echo $row["name"]; ?></option>

                                    <?php }
                                    ?>

                                </select>
                            </div>
                            <br>
                            <h3>OR</h3>
                            <br>
                            <div>
                            <label > No partner needed(Self Only) </label> 

                            <?php
                                    include 'php/connection.php';
                                    if (session_status() === PHP_SESSION_NONE) {
                                        session_start();
                                    };
                                    $e = $_SESSION["email"];
                                    $query = "select * from student where email='$e'";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
<input type="checkbox" id="selfonly" name="selfonly" value="<?php echo $row["enrollment"]; ?>">
                                
                                       

                                    <?php }
                                    ?>
                               
                            </div>
                            <br>


                            <button type="submit" name="addpartner" class="btn btn-success" style="margin-right: 20px;"><i class="fa fa-check-circle"></i> Add Your Partner !</button>


                        </form>
                    </div>
                </div>
                <!-- END INPUT GROUPS -->
            </div>
        </div>




        <!-- BASIC TABLE -->
        <!-- BASIC TABLE -->
        <div class="container" id="datatable">
            <div class="row">
                <div class="col-12">


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Your Partner</th>
                                <th scope="col">Partner Enrollment</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'php/connection.php';

                            $e = $_SESSION["email"];
                            $q = "select enrollment from student where email='$e'";
                            $result = mysqli_query($conn, $q);
                            $row = mysqli_fetch_array($result);
                            $myenroll = $row["enrollment"];
                            
                            $q = "select group_id from groupmember where enrollment='$myenroll'";
                            $result = mysqli_query($conn, $q);
                            $row = mysqli_fetch_array($result);
                            if($row!=null)
                            {
                                $group_id = $row["group_id"];
                            
                           

                            $q = "select * from projectgroup where group_id='$group_id'";
                            $result = mysqli_query($conn, $q);
                            $row = mysqli_fetch_array($result);
                            
                            $self = (int)$row["self"];

                            if($self==0){
                                $query = "select * from groupmember,student where groupmember.enrollment=student.enrollment and group_id=(select group_id from groupmember where enrollment='$myenroll') and groupmember.enrollment!='$myenroll'";
                            }
                            else{
                                $query = "select * from groupmember,student where groupmember.enrollment=student.enrollment and group_id=(select group_id from groupmember where enrollment='$myenroll')";
                            }

                            


                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $row["name"]; ?></td>
                                    <td><?php echo $row["enrollment"]; ?></td>
                                    <td><?php echo $row["contact_number"]; ?></td>
                                    <td><?php echo $row["email"]; ?></td>
                                    <form action="php/addpartner.php" method="post">
                                        <input type="hidden" value="<?php echo $row["enrollment"]; ?>" name="enrollment">

                                        <td>


                                            <?php


                                            $e = $_SESSION["email"];
                                            $q = "select enrollment from student where email='$e'";
                                            $result1 = mysqli_query($conn, $q);
                                            $row1 = mysqli_fetch_array($result1);
                                            $myenroll = $row1["enrollment"];


                                            $query = "select group_id from groupmember where enrollment='$myenroll'";
                                            $result1 = mysqli_query($conn, $query);
                                            $row1 = mysqli_fetch_array($result1);

                                            $group_id = (int)$row1["group_id"];

                                            $q = "select * from projectgroup,faculty where group_id='$group_id' and guide_id=faculty_id";
                                            $result1 = mysqli_query($conn, $q);
                                            $row1 = mysqli_fetch_array($result1);

                            

                                           



                                           
                                            if (!isset($row1["faculty_name"])) {

                                                echo "<button type='submit' value='delete' name='deletepartner' class='btn btn-danger'  onClick=\"javascript: return confirm('Do you want to delete this record');\"><i class=''>Delete</i></button>";
                                            
                                            }
                                            else{
                                                ?>
                                                <script>
                                                    window.onload = function() {
                                                       var div= document.getElementById("addf");
                                                       div.style.visibility="hidden";
                                                       document.getElementById('togglebtn').click();
                                                    }
                                                    
                    

                
                                                </script>
                                            <?php

                                            }
                                            ?>
                                        </td>
                                    </form>

                                </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- END BASIC TABLE -->


    </div>
    <?php
            if (isset($_SESSION["partneradded"])) {
                if ($_SESSION["partneradded"] == "yes") {
                    $_SESSION["partneradded"] = "no";
    ?>
            <script>
                swal("partner added successfully");
            </script>
    <?php
                }
            }
    ?>

<?php
            if (isset($_SESSION["partnerexist"])) {
                if ($_SESSION["partnerexist"] == "yes") {
                    $_SESSION["partnerexist"] = "no";
    ?>
            <script>
                swal("First delete your existance partner");
            </script>
    <?php
                }
            }
    ?>


<?php
            if (isset($_SESSION["selfdeclare"])) {
                if ($_SESSION["selfdeclare"] == "yes") {
                    $_SESSION["selfdeclare"] = "no";
    ?>
            <script>
                swal("Sorry You can not add partner as u choosen to be Single Only. in order to add please remove yourself first ");
            </script>
    <?php
                }
            }
    ?>
</body>

</html>

<?php
        }
    }

?>