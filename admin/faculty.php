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

        <title>ProLink</title>
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
            include 'admindash.php';
            ?>

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"> <h3 class="panel-title">Add Faculty</h3></h3>
                    <div class="right">
                        
                        <button type="button" id="togglebtn" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                       
                    </div>
                </div>
                <div class="panel-body" id="addf">
                    <!-- INPUT GROUPS -->
                    <div class="panel">

                        <div class="panel-heading">
                            <h4>Add Faculty</h4>
                        </div>
                        <div class="panel-body">
                            <form action="php/addfaculty.php" method="post">

                            <div class="input-group">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary" type="label">Program</button>
                                    </span> 
                                    <select class="form-control" name="program">
                                        <?php
                                        include 'php/connection.php';
                                        if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
                                        $query = "select distinct program from course where status='active'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row["program"]; ?>"><?php echo $row["program"]; ?></option>

                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <br>



                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Faculty Name</button>
                                </span> 
                                <input name="fname" class="form-control" type="text" pattern="[a-zA-Z ]+" required="" title="name should not contain number or special characters">
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Designation</button>
                                </span> 
                               <select class="form-control" name="designation" required="">
                                        <option value="Assistant Professor">Assistant professor</option>
                                        <option value="Associate Prosessor">Associate prosessor</option>
                                       
                                    </select>
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Email-ID</button>
                                </span> 
                                <input name="email" class="form-control" type="text" required pattern="[a-zA-Z.][a-zA-Z0-9.]+@gmail.com" title="invalid email">
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Contact</button>
                                </span> 
                                <input name="contact" class="form-control" type="text" required pattern="[9876][0-9]{9}" title="invalid contact number">
                            </div>
                            <br>

                            <button type="submit" name="addfaculty" class="btn btn-success" style="margin-right: 20px;"><i class="fa fa-check-circle"></i> Add Faculty</button>
                        

                            </form>
                        </div>
                    </div>
                    <!-- END INPUT GROUPS -->
                </div>
            </div>




            <!-- BASIC TABLE -->
                     <!-- BASIC TABLE -->
            <div class="container" id="datatable">
            <div>
                <form  method="post" enctype="multipart/form-data" action="php/addfaculty.php">
                        <input type="file" name="doc">
                        <br>
                        <button type="submit" name="bulksubmit" style="color: green;">Upload </button>

                    </form>
                </div>
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
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">contact</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">program</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'php/connection.php';

                                if (isset($_POST["searchbtn"])) {
                                    $s = $_POST["search"];
                                    $query = "select * from faculty where concat(faculty_name,email,contact_number,program) like '%$s%' and faculty_id!=14";
                                } else {
                                    $query = "select * from faculty where faculty_id!=14 ";
                                }

                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td ><?php echo $row["faculty_name"]; ?></td>
                                        <td><?php echo $row["email"]; ?></td>
                                        <td><?php echo $row["contact_number"]; ?></td>
                                        <td><?php echo $row["designation"]; ?></td>
                                        <td><?php echo $row["program"]; ?></td>
                                <form action="php/facultyoperation.php" method="post">
                                    <input type="hidden" value="<?php echo $row["email"]; ?>" name="email">

                                    <td>  

                                        <button type="submit" value="edit" name="edit" class="btn btn-primary">Edit</button>
                                      

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

<?php
    if(isset($_SESSION["duplicatef"]))
    {
        if($_SESSION["duplicatef"]=="yes")
        {
            $_SESSION["duplicatef"]="no";
        ?>
    <script>
        
 swal("Duplicate details(email,contact) can not be added");
    
    </script>
    <?php
        }
    }
    ?>
    <?php
    if(isset($_SESSION["updatedf"]))
    {
        if($_SESSION["updatedf"]=="yes")
        {
            $_SESSION["updatedf"]="no";
        ?>
    <script>
        
 swal("Sorry this email already exist");
    
    </script>
    <?php
        }
    }
    ?>





<?php
    if(isset($_SESSION["ffileformat"]))
    {
        if($_SESSION["ffileformat"]=="yes")
        {
            $_SESSION["ffileformat"]="no";
        ?>
    <script>
        
 swal("You can upload Excel(.xlsx)  File only");
    
    </script>
    <?php
        }
    }
    ?>



<?php
    if(isset($_SESSION["invalidemail"]))
    {
        if($_SESSION["invalidemail"]=="yes")
        {
            $_SESSION["invalidemail"]="no";
        ?>
    <script>
        
 swal("fully or some data are not as per required or course not active");
    
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