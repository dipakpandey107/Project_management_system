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
                    <h3 class="panel-title"> <h3 class="panel-title">Guide Allocation</h3></h3>
                    <div class="right">
                        
                        <button type="button" id="togglebtn" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                       
                    </div>
                </div>
                <div class="panel-body" id="addf">
                    <!-- INPUT GROUPS -->
                    <div class="panel">

                        <div class="panel-heading">
                            
                        </div>
                        <div class="panel-body">
                            <form action="allocateguidenext.php" method="post">
                            
                           

        
                            <br>

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Select Guide</button>
                                </span> 
                               <select class="form-control" name="guide_id" required="">
                               <?php
                                        include 'php/connection.php';
                                        if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
                                        $e=$_SESSION["email"];
                                        $pq="select program from faculty where email='$e'";
                                        $pr=mysqli_query($conn,$pq);
                                        $pr=mysqli_fetch_array($pr);
                                        $program=$pr["program"];
                                        $query = "select *  from faculty where program='$program' and  faculty_id!=14;";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row["faculty_id"]; ?>"><?php echo $row["faculty_name"]; ?></option>

                                        <?php }
                                        ?>
                                    </select>
                            </div>
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
                                   
                                    <th scope="col">Project Title</th>
                                    <th scope="col">Guide Name</th>
                                    
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'php/connection.php';

                                $e=$_SESSION["email"];
                                $q="select * from faculty where email='$e'";
                                $r=mysqli_query($conn,$q);
                                $r=mysqli_fetch_array($r);
                                $fid=(int)$r["faculty_id"];

                                $q="select * from committe where faculty_id='$fid'";
                                $r=mysqli_query($conn,$q);
                                $r=mysqli_fetch_array($r);
                                $cid=(int)$r["course_id"];

                                if (isset($_POST["searchbtn"])) {
                                    $s = $_POST["search"];
                                    $query = "select * from projectgroup,faculty where guide_id=faculty_id and  concat(faculty_name,email,project_title) like '%$s%'  and course_id='$cid'";
                                } else {
                                    $query = "select * from projectgroup,faculty where guide_id is not null and guide_id=faculty_id and course_id='$cid' ";
                                }

                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td ><?php echo $row["project_title"]; ?></td>
                                        <td><?php echo $row["faculty_name"]; ?></td>
                                        
                                <form action="php/addguide.php" method="post">
                                    <input type="hidden" value="<?php echo $row["group_id"]; ?>" name="groupid">

                                    <td>
                                       
                                      

                                        <?php
                                        echo "<button type='submit' value='delete' name='deleteguide' class='btn btn-danger'  onClick=\"javascript: return confirm('Do you want to delete this record');\"><i class=''>Delete</i></button>";
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
    if(isset($_SESSION["guideadded"]))
    {
        if($_SESSION["guideadded"]=="yes")
        {
            $_SESSION["guideadded"]="no";
        ?>
    <script>
        
 swal("guide added successfully");
    
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