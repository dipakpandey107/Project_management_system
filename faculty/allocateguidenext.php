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
         if(isset($_POST["next"]))
         {
             
             $guide_id=$_POST["guide_id"];
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
            include 'facultydash.php';
            ?>

            <div class="panel">
                <div class="panel-heading">
            <?php
            include 'php/connection.php';
                $result = mysqli_query($conn, "SELECT * from faculty where faculty_id='$guide_id'");
                $result=mysqli_fetch_array($result);
                ?>
                    <h3 class="panel-title"> <h3 class="panel-title"></h3>Guide Name : <?php echo $result["faculty_name"]; ?></h3>
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

                        <form action="php/addguide.php" method="post">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Select The Projects </th>
                                    <th scope="col">Project Members</th>
                                   
                                   
                                    
                                   

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'php/connection.php';
                             
                                $e=$_SESSION["email"];

                                
                               
                                   
                                      
                                       $q="select *  from projectgroup where guide_id is null and course_id=(select course_id from committe,faculty where email='$e' and faculty.faculty_id=committe.faculty_id)";
                                       
                                        $result = mysqli_query($conn,$q);


                             

                              
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                       

                                      
                                        <td ><input id="in" type="checkbox" name="projects[]" value="<?php echo $row["group_id"]; ?>" ><?php echo "    ".$row["project_title"]; ?></td>
                                        <td>
                                        <?php $g_id=$row["group_id"];
                                        $query="select name from student,projectgroup,groupmember where projectgroup.group_id=groupmember.group_id and groupmember.enrollment=student.enrollment and projectgroup.group_id='$g_id'";
                                        $result1=mysqli_query($conn,$query);
                                        while ($r1 = mysqli_fetch_array($result1)) {

                                         ?> </t> <?php echo $r1["name"];?><br>
                                        <?php } ?>
                                        </td>
                                     

                                </tr>
                            <?php }
                            ?>
                            <input type="hidden" name="guide_id" value="<?php echo $guide_id; ?>">
                          
                            <input type="submit" value="Allocate Guide" style="color:green" name="addguide" >
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