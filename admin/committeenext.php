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
if(isset($_SESSION["role"]))
{
    if($_SESSION["role"]=='a')
    {
         if(isset($_POST["next"]))
         {
             
             $course_id=$_POST["course"];
         }
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
                margin-left: 200px;
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
            #in{
                margin-left:0px;.
                width:100%;
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
            <?php
            include 'php/connection.php';
                $result = mysqli_query($conn, "SELECT * from course where course_id='$course_id'");
                $result=mysqli_fetch_array($result);
                ?>
                    <h3 class="panel-title"> <h3 class="panel-title"></h3>Course : <?php echo $result["coursename"]; ?></h3>
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
                            
                            <br>                                
                        </form>

                        <form action="php/addcommittee.php" method="post">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Select Faculty As Committee Members</th>
                                   
                                   
                                    
                                   

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'php/connection.php';
                             
                                $e=$_SESSION["email"];

                                
                               
                                   

                                       $q="select faculty_id,faculty_name from faculty,course where course.program=faculty.program and course.course_id='$course_id'  and faculty_id not in (select faculty_id from committe)  and faculty_id!=14";
                                       
                                        $result = mysqli_query($conn,$q);


                             

                              
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                       

                                      
                                        <td ><input id="in" type="checkbox" name="faculties[]" value="<?php echo $row["faculty_id"]; ?>" ><?php echo "    ".$row["faculty_name"]; ?></td>
                                     

                                </tr>
                            <?php }
                            ?>
                            <input type="hidden" name="course" value="<?php echo $course_id; ?>">
                          
                            <input type="submit" value="Create Committee" style="color:green" name="addcommittee" >
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