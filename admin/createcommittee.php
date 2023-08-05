<html>
    <head>
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
            .panel{
                margin-top: 10%;
                margin-left: 20%;
            }
            #addf{
                margin-top: -10%;
                margin-left: -15%;
            }
            #datatable{
                margin-left:18%;
		width:85%;
            }
            #in{
                margin-top:20px;
                margin-bottom:10px;
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
        window.onload=function(){
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
                    <h3 class="panel-title"> <h3 class="panel-title">Create Committee</h3></h3>
                    <div class="right">
                        
                        <button type="button" id="togglebtn" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                       
                    </div>
                </div>
                <div class="panel-body" id="addf">
                    <!-- INPUT GROUPS -->
                    <div class="panel">

                        <div class="panel-heading">
                            <h4>Add committee's member </h4>
                        </div>
                        <div class="panel-body">
                            <form action="committeenext.php" method="post" id="form1">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Select Course</button>
                                </span> 
                               <select class="form-control" name="course" required="">
                               <?php
                                        include 'php/connection.php';
                                        if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
                                        $query = "select course_id,coursename from course where status='active'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row["course_id"]; ?>"><?php echo $row["coursename"]; ?></option>

                                        <?php }
                                        ?>
                                       
                                    </select>
                            </div>
                            <br>


                            



                            <br>
                            <br>

                            <button type="submit" name="next" class="btn btn-success" style="margin-right: 20px;"><i class="fa fa-check-circle"></i>Next</button>
                        
        
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
                        <form method="post" action="#" >
                            <div class="input-group">
                                <input type="text" name="search"  class="form-control" placeholder="Search ">
                                <span class="input-group-btn"><button type="submit" value="yes" name="searchbtn" class="btn btn-primary">Go</button></span>
                            </div>
                        </form>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Course</th>
                                    <th scope="col">Committee's Member</th>
                                    <th scope="col">contact</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Action</th>
                                   

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'php/connection.php';

                                if (isset($_POST["searchbtn"])) {
                                    $s = $_POST["search"];
                                    $query = "select * from committe,faculty,course where committe.course_id=course.course_id and committe.faculty_id=faculty.faculty_id and concat(faculty_name,coursename,contact_number) like '%$s%' and faculty.faculty_id!=14";
                                } else {
                                    $query = "select * from committe,faculty,course where committe.course_id=course.course_id and committe.faculty_id=faculty.faculty_id";
                                }

                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td ><?php echo $row["coursename"]; ?></td>
                                        <td><?php echo $row["faculty_name"]; ?></td>
                                        <td><?php echo $row["contact_number"]; ?></td>
                                        <td><?php echo $row["designation"]; ?></td>
                                <form action="php/addcommittee.php" method="post">
                                    <input type="hidden" value="<?php echo $row["committee_id"]; ?>" name="id">

                                    <td>
                                       
                                      

                                        <?php
                                        echo "<button type='submit' value='delete' name='delete' class='btn btn-danger'  onClick=\"javascript: return confirm('Do you want to delete this record');\"><i class=''>Delete</i></button>";
                                        ?>   </td>
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
      
    if(isset($_SESSION["duplicatem"]))
    {
        if($_SESSION["duplicatem"]=="yes")
        {
            $_SESSION["duplicatem"]="no";
        ?>
    <script>
        
 swal("duplicate member is not allowed");
    
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