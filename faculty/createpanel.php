<!-- 
Data To be displayed in table -- Panel ID, FacultyName, // where condition= coursename
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
                    <h3 class="panel-title"> <h3 class="panel-title">Evaluation Panel</h3></h3>
                    <div class="right">
                        
                        <button type="button" id="togglebtn" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                       
                    </div>
                </div>
                <div class="panel-body" id="addf">
                    <!-- INPUT GROUPS -->
                    <div class="panel">

                        <div class="panel-heading">
                            <h4>Add Panel</h4>
                        </div>
                        <div class="panel-body">
                            <form action="createpanelnext.php" method="post" id="form1">

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Select Evaluation</button>
                                </span> 
                               <select class="form-control" name="evalution" id="evalution" required="">
                             
                               <?php
                                        include 'php/connection.php';
                                        if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
                                        $e=$_SESSION["email"];
                                        $q="select * from faculty where email='$e'";
                                        $r=mysqli_query($conn,$q);
                                        $r=mysqli_fetch_array($r);
                                        $fid=(int)$r["faculty_id"];
        
                                        $q="select * from committe where faculty_id='$fid'";
                                        $r=mysqli_query($conn,$q);
                                        $r=mysqli_fetch_array($r);
                                        $cid=(int)$r["course_id"];
        
                                       
                                            $query = "select * from sheduleevalution where course_id='$cid'";
                                       
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row["eval_id"]; ?>"><?php echo $row["eval_name"]; ?></option>

                                        <?php }
                                        ?>
                                      
                                       
                                    </select>
                            </div>
                            <br>
                            <?php
                            include 'php/connection.php';
                                       
                                        $e=$_SESSION["email"];
                                        $query = "select faculty_id from faculty where email='$e'";
                                        $result = mysqli_query($conn, $query);
                                        $result=mysqli_fetch_array($result);
                                        $id=$result["faculty_id"];
                                        $query = "select course_id from committe where faculty_id='$id'";
                                        $result = mysqli_query($conn, $query);
                                        $row=mysqli_fetch_array($result);
                                        $id=$row["course_id"];
                                        ?>
                                       
                            <input type="hidden" name="course" value="<?php echo $id ; ?>" >

                            

                     



                            <button type="submit" name="next" class="btn btn-success" style="margin-right: 20px;"><i class="fa fa-check-circle"></i> Next</button>
                        
                  
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

                         <!-- 
                            Data To be displayed in table -- Panel ID, FacultyName, // where condition= coursename
                            -->

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">panel member</th>
                                    <th scope="col">course </th>
                                    <th scope="col">evalution </th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'php/connection.php';

                                if (isset($_POST["searchbtn"])) {
                                    $s = $_POST["search"];
                                    $query = "select * from panel_eval,course,sheduleevalution where panel_eval.course_id=course.course_id and panel_eval.eval_id=sheduleevalution.eval_id and  sheduleevalution.course_id='$cid' and concat(coursename,panel_desc,eval_name) like '%$s%'";
                                } else {
                               
                                    $query = "select * from panel_eval,course,sheduleevalution where panel_eval.course_id=course.course_id and panel_eval.eval_id=sheduleevalution.eval_id and  sheduleevalution.course_id='$cid'";
                              
                                }
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                    <td>
                                    <?php $p_id=$row["panel_desc"];
                                        $query="select panel_id from panel_eval where panel_desc='$p_id'";
                                        $result1=mysqli_query($conn,$query);
                                        $result1=mysqli_fetch_array($result1);
                                        $pid=(int)$result1["panel_id"];

                                        $query="select * from panelmember,faculty where  panel_id='$pid' and faculty.faculty_id=panelmember.faculty_id";
                                        $result1=mysqli_query($conn,$query);
                                       
                                        while ($r1 = mysqli_fetch_array($result1)) {
                                            ?>
                                          <?php echo $r1["faculty_name"];?><br>
                                        <?php } ?>
                                        </td>
                                        <td><?php echo $row["coursename"]; ?></td>
                                        <td><?php echo $row["eval_name"]; ?></td>
                                        <td><?php echo $row["panel_desc"]; ?></td>
                                <form action="php/addpanel.php" method="post">
                                    <input type="hidden" value="<?php echo $row["panel_desc"]; ?>" name="panel_desc">

                                    <td>
                                       
                                      

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
    if(isset($_SESSION["padded"]))
    {
        if($_SESSION["padded"]=="yes")
        {
            $_SESSION["padded"]="no";
        ?>
    <script>
        
 swal("panel created successfully");
    
    </script>
    <?php
        }
    }
    ?>

<?php
    if(isset($_SESSION["fns"]))
    {
        if($_SESSION["fns"]=="yes")
        {
            $_SESSION["fns"]="no";
        ?>
    <script>
        
 swal("Please Do select faculty as panel member. try again..");
    
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