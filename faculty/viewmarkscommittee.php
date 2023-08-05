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
 if(isset( $_SESSION["committeemember"]))
 {
	 if($_SESSION["committeemember"]=="yes")
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
            .form{
                margin-top: 100px;
                margin-left: 200px;;
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
            include 'facultydash.php';
            ?>

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"> <h3 class="panel-title">All Projects</h3></h3>
                    <div class="right">  
                    </div>
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
                            <br>                                
                        </form>

                        <form method="post" action="pdf/generate_pdf.php" >                                
<button type="submit" name="addcriteria" class="btn btn-success" style="margin-right: 20px;"><i class="fa fa-check-circle"></i> Download Report</button>
                        </form>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Project Title</th>
                                    <th scope="col">Enrollment</th>
                                    <th scope="col">marks</th>
                                    <th scope="col">evalution</th>
                                    
                                   

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'php/connection.php';
                             
                                $e=$_SESSION["email"];

                                if (isset($_POST["searchbtn"])) {
                                    $s = $_POST["search"];
                                    $query = "select *,sum(om) as m from studentmarks,student,projectgroup,sheduleevalution where studentmarks.enrollment=student.enrollment and student.course_id=(select course_id from committe,faculty where email='$e' and faculty.faculty_id=committe.faculty_id) and studentmarks.group_id=projectgroup.group_id and sheduleevalution.eval_id=studentmarks.eval_id  and concat(student.enrollment,project_title,name,eval_name) like '%$s%' group by studentmarks.enrollment,studentmarks.eval_id";
                                } else {
                                   
                                    $e=$_SESSION["email"];
                                    $query = "select *,sum(om) as m from studentmarks,student,projectgroup,sheduleevalution where studentmarks.enrollment=student.enrollment and student.course_id=(select course_id from committe,faculty where email='$e' and faculty.faculty_id=committe.faculty_id) and studentmarks.group_id=projectgroup.group_id and sheduleevalution.eval_id=studentmarks.eval_id group by studentmarks.enrollment,studentmarks.eval_id";
                                }

                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                       

                                      
                                        <td ><?php echo $row["project_title"]; ?></td>
                                        <td ><?php echo $row["name"]." :".$row["enrollment"]; ?></td>
                                        <td ><?php echo $row["m"]; ?></td>
                                        <td ><?php echo $row["eval_name"]; ?></td>

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
    if(isset($_SESSION["fadded"]))
    {
        if($_SESSION["fadded"]=="yes")
        {
            $_SESSION["fadded"]="no";
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

<?php
     }
    }
    ?>