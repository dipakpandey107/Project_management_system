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
            include 'studentdash.php';
            ?>

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"> <h3 class="panel-title">Your All Evaluation Schedules</h3></h3>
                    <div class="right">  
                    </div>
                </div>
                
            </div>




            <div class="container" id="datatable">
            <div class="row">
                <div class="col-12">
                    <form method="post" action="#">
                        <div class="input-group">
                            
                                   
                        </div>
                    </form>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Evalution Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">description</th>
                                <th scope="col">criterias</th>
                                <th scope="col">panel</th>
                              

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include 'php/connection.php';
                                $e=$_SESSION["email"];
                                    $q="select course_id from student where email='$e'";
                                    $re=mysqli_query($conn,$q);
                                    $re=mysqli_fetch_array($re);
                                    $cid=$re["course_id"];

                               
                                    $query = "select * from sheduleevalution where course_id='$cid'";
                                

                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                            <tr>
                                <td><?php echo $row["eval_name"]; ?></td>
                                <td><?php echo $row["edate"]; ?></td>
                                <td><?php echo $row["description"]; ?></td>
                                <td>
                                    <?php $id=$row["eval_id"];
                                        $query="select * from evalutioncriteria,criteriamaster where eval_id='$id'and  criteria_id=id";
                                        $result1=mysqli_query($conn,$query);
                                        while ($r1 = mysqli_fetch_array($result1)) {

                                        echo $r1["cname"].",Marks :" ?> </t> <?php echo $r1["out_of_marks"];?><br>
                                    <?php } ?>
                                </td>


                                <td>
                                    <?php $id=$row["eval_id"];
                                        
                                        $e=$_SESSION["email"];
                                        $q="select enrollment from student where email='$e'";
                                        $r=mysqli_query($conn,$q);
                                        $r=mysqli_fetch_array($r);
                                        $enrollment=$r["enrollment"];

                                        $q="select group_id from groupmember where enrollment='$enrollment'";
                                        $rr=mysqli_query($conn,$q);
                                        $rr=mysqli_fetch_array($rr);
                                        $group_id=$rr["group_id"];
                                

                                        $query="select * from panelallocation,faculty,panelmember where group_id='$group_id' and eval_id='$id' and panelallocation.panel_id=panelmember.panel_id and panelmember.faculty_id=faculty.faculty_id";
                                        $result1=mysqli_query($conn,$query);
                                        while ($r1 = mysqli_fetch_array($result1)) {

                                         ?> </t> <?php echo $r1["faculty_name"];?><br>
                                    <?php } ?>
                                </td>

                             




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