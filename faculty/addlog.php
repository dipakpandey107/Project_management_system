<html>
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


    <head>
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
                    <h3 class="panel-title"> <h3 class="panel-title">Log Register</h3></h3>
                    <div class="right">
                        
                        <button type="button" id="togglebtn" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                       
                    </div>
                </div>
                <div class="panel-body" id="addf">
                    <!-- INPUT GROUPS -->
                    <div class="panel">

                        <div class="panel-heading">
                            <h4>Add Log</h4>
                        </div>
                        <div class="panel-body">
                            <form action="php/addlog.php" method="post">



                            <?php 
                                   include 'php/connection.php';  
                                    
                                    $e=$_SESSION["email"];
                                    $q="select faculty_id from faculty where email='$e'";
                                    $result=mysqli_query($conn,$q);
                                    $row=mysqli_fetch_array($result);
                                    $fid=$row["faculty_id"];

                                ?>
                            
                            <input type='hidden' name="guideid" value="<?php echo $fid; ?>">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Select Project</button>
                                </span> 
                               <select class="form-control" name="groupid" required="">
                               <?php
                                        include 'php/connection.php';
                                        
                                      

                                        $e=$_SESSION["email"];
                                        $q="select faculty_id from faculty where email='$e'";
                                        $result=mysqli_query($conn,$q);
                                        $row=mysqli_fetch_array($result);
                                        $fid=$row["faculty_id"];
                                

                                       

                                     
                                        $query = "select *  from projectgroup where guide_id='$fid'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row["group_id"]; ?>"><?php echo $row["project_title"]; ?></option>

                                        <?php }
                                        ?>
                                    </select>
                            </div>
                            <br>

                           

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Discussions</button>
                                </span> 
                                <input name="discussion" class="form-control" type="text" pattern="[a-zA-Z ]{10," required="" title="minimum 10 character needed">
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Instructions</button>
                                </span> 
                                <input name="instruction" class="form-control" type="text" pattern="[a-zA-Z ]{10," required="" title="instruction can not be empty">
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Remarks</button>
                                </span> 
                                <input name="remark" class="form-control" type="text" pattern="[a-zA-Z ]+" required="" title="remark can not be empty">
                            </div>
                            <br>

                            <button type="submit" name="addlog" class="btn btn-success" style="margin-right: 20px;"><i class="fa fa-check-circle"></i> Add Log</button>
                        

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
                                    <th scope="col">Project title</th>
                                    <th scope="col">Meeting date</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">discussion</th>
                                    <th scope="col">Instruction</th>
                                    <th scope="col">Action</th>

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
                                    $query = "select * from projectguidance,projectgroup where projectguidance.guide_id='$fid' and projectgroup.group_id=projectguidance.group_id and concat(dom,project_title) like '%$s%' order by id desc";
                                } else {
                                    $query = "select * from projectguidance,projectgroup where projectguidance.guide_id='$fid' and projectgroup.group_id=projectguidance.group_id order by id desc";
                                }

                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td ><?php echo $row["project_title"]; ?></td>
                                        <td><?php echo $row["dom"]; ?></td>
                                        <td><?php echo $row["remark"]; ?></td>
                                        <td><?php echo $row["discussion"]; ?></td>
                                        <td><?php echo $row["instruction"]; ?></td>
                                <form action="php/addlog.php" method="post">
                                    <input type="hidden" value="<?php echo $row["id"]; ?>" name="id">

                                    <td>
                                        <button type="submit" value="edit" name="editlog" class="btn btn-primary"><i class="">Edit</i></button>
                                      

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