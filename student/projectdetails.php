<html>
    <head>
   
    <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
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
                    <h3 class="panel-title"> <h3 class="panel-title">Project Description</h3></h3>
                    <div class="right">
                        
                        <button type="button" id="togglebtn" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                       
                    </div>
                </div>
                <div class="panel-body" id="addf">
                    <!-- INPUT GROUPS -->
                    <div class="panel">

                        <div class="panel-heading">
                            <h4>Add/update Project Description</h4>
                        </div>
                        <div class="panel-body">
                            <form action="php/addprojectdetails.php" method="post">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Project Title</button>
                                </span> 
                                <input name="title" class="form-control" type="text" pattern="[a-zA-Z ]+" required="" title="name should not contain number or special characters">
                            </div>
                            <br>

                            <div class="input-group">
                            <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Technology</button>
                                </span>
                                <select class="form-control" name="technology" required="">
                                    <?php
                                        include 'php/connection.php';
                                        
                                      
                                        $query = "select * from technologymaster";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                    <option value="<?php echo $row["technology"]; ?>"><?php echo $row["technology"]; ?></option>

                                    <?php }
                                        ?>

                                </select>
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Description</button>
                                </span> 
                                <input name="description" class="form-control" type="text" pattern="[a-zA-Z ]{20," required="" title="minimum 20 character required">
                            </div>
                            <br>

                           

                            <button type="submit" name="addproject" class="btn btn-success" style="margin-right: 20px;"><i class="fa fa-check-circle"></i> Submit Details</button>
                        

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
                           
                        </form>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Project Title</th>
                                    <th scope="col">Technology</th>
                                    <th scope="col">Desciption</th>
                              
                      

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'php/connection.php';

                               
                               
                                    $e=$_SESSION["email"];
                                    $q="select enrollment from student where email='$e'";
                                    $result=mysqli_query($conn,$q);
                                    $row=mysqli_fetch_array($result);
                                    $myenroll=$row["enrollment"];


                                    $query="select group_id from groupmember where enrollment='$myenroll'";
                                    $result= mysqli_query($conn, $query);
                                    $row=mysqli_fetch_array($result);

                                    $group_id=(int)$row["group_id"];

                                    $query = "select * from projectgroup where group_id='$group_id'";
                                

                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td ><?php echo $row["project_title"]; ?></td>
                                        <td><?php echo $row["technology"]; ?></td>
                                        <td><?php echo $row["description"]; ?></td>
                                       
                                

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
    if(isset($_SESSION["projectadded"]))
    {
        if($_SESSION["projectadded"]=="yes")
        {
            $_SESSION["projectadded"]="no";
        ?>
    <script>
        
 swal("project added successfully");
    
    </script>
    <?php
        }
    }
    ?>

<?php
    if(isset($_SESSION["duplicatep"]))
    {
        if($_SESSION["duplicatep"]=="yes")
        {
            $_SESSION["duplicatep"]="no";
        ?>
    <script>
        
 swal("This Project is already Exist");
    
    </script>
    <?php
        }
    }
    ?>

    </body>
</html>

<?php
     }

    }?>