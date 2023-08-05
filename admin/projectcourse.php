<html>
    <head>
<script lang="javascript" type="text/javascript"> window.history.forward();
        </script>
    
    <?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
    if(!isset($_SESSION["email"]))
    {
        header("location: /sem6/project6sem/index.php");
        
    }
?>

<?php

 if(isset($_SESSION["role"]))
 {
	 if($_SESSION["role"]=='a')
	 {
		 ?>



        <title>Project Courses | Admin</title>
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
            .panel{
                margin-top: 10%;
                margin-left: 20%;
            }
            #addp{
                margin-top: -10%;
                margin-left: -15%;
            }
            #datatable{
                margin-left:18%;
		width:85%;
            }
            .container {
                padding: 2rem 0rem;

            }

            h4 {
                margin: 2rem 0rem 1rem;
            }

            .table-image {
                td, th {
                    vertical-align: middle;
                }
            }


        </style>
        <script>
            window.onload = function () {
                document.getElementById('togglebtn').click();
            }
        </script>
    </head>
    <body>
        <div class="container";>
            <?php
            include 'admindash.php';
            ?>


            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"> <h3 class="panel-title">Add course</h3></h3>
                    <div class="right">
                        <button type="button" id="togglebtn" class="btn-toggle-collapse"><i class="lnr lnr-chevron-down"></i></button>

                    </div>
                </div>
                <div class="panel-body" id="addp">
                    <!-- INPUT GROUPS -->
                    <!-- INPUT GROUPS -->
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title">Add Project Courses</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="php/addcourse.php"> 
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary" type="label">Program</button>
                                    </span> 
                                    <input class="form-control" name="program" type="text" pattern="[a-zA-Z][a-zA-Z0-9]+" required="" title="invalid program name">
                                </div>
                                <br>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary" type="label">Semester</button>
                                    </span> 
                                    <select class="form-control" name="semester" required="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>


                                    </select>
                                </div>
                                <br>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary" type="label">Year</button>
                                    </span> 
                                    <input class="form-control" name="year" type="text" pattern="[0-9]{4}-[0-9]{4}" required="" title="invalid year format">
                                </div>
                                <br>

                                <button type="submit" name="addcourse" class="btn btn-success" style="margin-right: 20px;"><i class="fa fa-check-circle"></i> Add Course</button>
                                

                            </form>
                        </div>
                    </div>
                    <!-- END INPUT GROUPS -->
                </div>
            </div>








            <!-- BASIC TABLE -->
            <div class="container" id="datatable">
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="#" >
                            <div class="input-group">
                                <input type="text" name="search"  class="form-control" placeholder="Search ">
                                <span class="input-group-btn"><button type="submit" value="yes" name="searchbtn" class="btn btn-primary">Go</button></span>
                            </div>
                        </form>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Program</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">CourseName</th>
                                    <th scope="col">Active Status</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'php/connection.php';

                                if (isset($_POST["searchbtn"])) {
                                    $s = $_POST["search"];
                                    $query = "select * from course where concat(program,semester,year,coursename,status) like '%$s%'";
                                } else {
                                    $query = "select * from course ";
                                }

                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td ><?php echo $row["program"]; ?></td>
                                        <td><?php echo $row["semester"]; ?></td>
                                        <td><?php echo $row["year"]; ?></td>
                                        <td><?php echo $row["coursename"]; ?></td>
                                        <td><?php echo $row["status"]; ?></td>
                                <form action="php/courseoperation.php" method="post">

                                    <input type="hidden" name="cname" value="<?php echo $row["coursename"]; ?>">

                                    <td>
                                        <?php
                                        if ($row['status'] == 'active') {
                                            ?>
                                            <button type="submit" value="inactive" name="inactive" class="btn btn-danger"><i class="">Inactivate</i></button>
                                            <?php
                                        } else {
                                            ?>
                                            <button type="submit" value="active" name="active" class="btn btn-primary"><i class="">Activate</i></button>
                                            <?php
                                        }
                                        ?>



                                    </td>
                                </form>

                                </tr>
<?php }
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
if (isset($_SESSION["cadded"])) {
    if ($_SESSION["cadded"] == "yes") {
        $_SESSION["cadded"] = "no";
        ?>
            <script>

                swal("course added successfully");

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