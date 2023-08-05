<!-- 
 Data To be displayed in table -- Project Title, Student Name, Criteria, (Criteria+Marks),Obtained Marks

Validation -- Obtained marks should not be greater than total marks of Criteria

For update -- delete the record and add new one !

Search -- based on project title

                            -->
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
 if(isset( $_SESSION["role"]))
 {
	 if($_SESSION["role"]=='s')
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
		margin-top: 5%;
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
            include 'studentdash.php';
            ?>



            <!-- BASIC TABLE -->
                     <!-- BASIC TABLE -->
            <div class="container" id="datatable">
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="php/marksoperation.php" >
                            
                        </form>

                         <!-- 
                            Data To be displayed in table -- Project Title, Student Name, (Criteria+Marks),Obtained Marks
                            -->

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    
                                    <th scope="col">Evalution</th>
                                    <th scope="col">marks</th>
                                    <th scope="col">Date</th>
                               
                                 

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                               
                               
                               

                                if (isset($_POST["searchbtn"])) {
                                    $s = $_POST["search"];
                                    $query = "select * from faculty where concat(faculty_name,email,contact_number) like '%$s%' and faculty_id!=14";
                                } else {
                                   
                                    $e=$_SESSION["email"];
                                    $q="select * from student where email='$e'";
                                    $re=mysqli_query($conn,$q);
                                    $re=mysqli_fetch_array($re);
                                    $ee=$re["enrollment"];
                                    
                                    $query = "select *,sum(om) as m  from studentmarks,sheduleevalution where studentmarks.enrollment='$ee' and studentmarks.eval_id=sheduleevalution.eval_id group by studentmarks.eval_id";
                                }

                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                       
                                        <td><?php echo $row["eval_name"]; ?></td>
                                        <td><?php echo $row["m"]; ?></td>
                                        <td><?php echo $row["edate"]; ?></td>
                                 

                                      
                                       </tr>
                                        
                                
                                

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