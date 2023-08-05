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
 if(isset($_SESSION["role"]))
 {
	 if($_SESSION["role"]=='f')
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
                    <h3 class="panel-title"> <h3 class="panel-title">Select The Project To Be  Called For Meet</h3></h3>
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
                        </form>
<form  method="POST" action="meetnext.php">
    
        <button type="submit" >Next</button>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">Select Project</th>
                                    <th scope="col">Project Title</th>
                                   
                                    <th scope="col">Group member</th>
                                    <th scope="col">course</th>
                                  

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'php/connection.php';

                             

                                    $e=$_SESSION["email"];
                                    $q="select faculty_id from faculty where email='$e'";
                                    $result=mysqli_query($conn,$q);
                                    $row=mysqli_fetch_array($result);
                                    $fid=$row["faculty_id"];



                                    if (isset($_POST["searchbtn"])) {
                                        $s = $_POST["search"];
                                        $query = "select * from projectgroup,course where guide_id='$fid' and course.course_id=projectgroup.course_id and concat(project_title,coursename) like '%$s%'";
                                    } else {
                                    $query = "select * from projectgroup,course where guide_id='$fid' and course.course_id=projectgroup.course_id";
                                   
                                    }
                             

                                $result = mysqli_query($conn, $query);
                                
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                   
                                    <tr>
                                    <td ><input type="checkbox" name="projectgroups[]" value="<?php echo $row['group_id']; ?>"></td>
                                        <td ><?php echo $row["project_title"]; ?></td>
                                       
                                        <td>
                                        <?php $g_id=$row["group_id"];
                                        $query="select email,name,groupmember.enrollment as e from groupmember,student where groupmember.enrollment=student.enrollment and group_id='$g_id'";
                                        $result1=mysqli_query($conn,$query);
                                        while ($r1 = mysqli_fetch_array($result1)) {

                                        echo $r1["e"]." :" ?> </t> <?php echo $r1["name"];?><br>
                                       
                                        <?php } ?>
                                        </td>
                                        <td><?php echo $row["coursename"]; ?></td>
                                      
                               

                                </tr>
                            <?php }
                            ?>
                            </tbody>
                        </table>
</form>
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