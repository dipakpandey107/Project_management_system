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
                
                    <h3 class="panel-title"> <h3 class="panel-title">evalute student </h3></h3>
                    <label>NOTE : evalutiion can be done only  on shedule evalution date.</label>
                    <div class="right">
                        
                        <button type="button" id="togglebtn" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                       
                    </div>
                </div>
                <div class="panel-body" id="addf">
                    <!-- INPUT GROUPS -->
                    <div class="panel">

                        <div class="panel-heading">
                            <h4>select student</h4>
                        </div>
                        <div class="panel-body">
                            <form action="evaluatestudentnext.php" method="post" id="form1">

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Select Course</button>
                                </span> 
                               <select class="form-control" id="course" name="course" required="">
                               <option>Select course</option>
                               <?php
                                        include 'connection.php';
                                        if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
$pq="select program from faculty where email='$e'";
                                        $pr=mysqli_query($conn,$pq);
                                        $pr=mysqli_fetch_array($pr);
                                        $program=$pr["program"];
                                        $query = "select course_id,coursename from course where program='$program' and status='active'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row["course_id"]; ?>"><?php echo $row["coursename"]; ?></option>

                                        <?php }
                                        ?>
                                       
                                    </select>
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Select evalution</button>
                                </span> 
                               <select class="form-control" id="evalution" name="evalution" required="">
                                       
                                       
                                    </select>
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Select project</button>
                                </span> 
                               <select class="form-control" id="project" name="project" required="">
                                       
                                       
                                    </select>
                            </div>
                            <br>

                           
                            <br>
                            

                            

                            <button type="submit" name="next" class="btn btn-success" style="margin-right: 20px;"><i class="fa fa-check-circle"></i> Enter Matks</button>
                        
              
                            </form>
                        </div>
                    </div>
                    <!-- END INPUT GROUPS -->
                </div>
            </div>




            <script>
            $(document).ready(function () {
                $('#course').on('change', function () {
                    var course_id = this.value;
                    $.ajax({
                        url: "evalutionbycourse.php",
                        type: "POST",
                        data: {
                            course_id: course_id

                        },
                        cache: false,
                        success: function (result) {
                            $("#evalution").html(result);
                           
                            
                        }
                    });
                });
            });
                </script>


<script>
            $(document).ready(function () {
                $('#evalution').on('change', function () {
                    var eval_id = this.value;
                    $.ajax({
                        url: "evalutionwiseproject.php",
                        type: "POST",
                        data: {
                            eval_id: eval_id

                        },
                        cache: false,
                        success: function (result) {
                            $("#project").html(result);
                           
                            
                        }
                    });
                });
            });
                </script>


<script>
            $(document).ready(function () {
                $('#project').on('change', function () {
                    var group_id = this.value;
                    $.ajax({
                        url: "projectwisestudent.php",
                        type: "POST",
                        data: {
                            group_id: group_id

                        },
                        cache: false,
                        success: function (result) {
                            $("#student").html(result);
                           
                            
                        }
                    });
                });
            });
                </script>



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
                            Data To be displayed in table -- Project Title, Student Name, (Criteria+Marks),Obtained Marks
                            -->

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Student</th>
                                    <th scope="col">Evalution</th>
                                    <th scope="col">course</th>
                                    <th scope="col">marks</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                               
                                $email=$_SESSION["email"];
                                $query="select faculty_id from faculty where email='$email'";
                                $result=mysqli_query($conn,$query);
                                $result=mysqli_fetch_array($result);
                                $fid=(int)$result["faculty_id"];
                               

                                if (isset($_POST["searchbtn"])) {
                                    $s = $_POST["search"];
                                    $query = "select *,studentmarks.enrollment as enrollment from student,sheduleevalution,studentmarks,course,panelmember where student.enrollment=studentmarks.enrollment and studentmarks.eval_id=sheduleevalution.eval_id  and studentmarks.panel_id=panelmember.panel_id and panelmember.faculty_id='$fid' and student.course_id=course.course_id  and concat(student.enrollment,eval_name,name,coursename) like '%$s%' group by studentmarks.enrollment,studentmarks.eval_id";
                                } else {
                                    $query = "select *,studentmarks.enrollment as enrollment from student,sheduleevalution,studentmarks,course,panelmember where student.enrollment=studentmarks.enrollment and studentmarks.eval_id=sheduleevalution.eval_id  and studentmarks.panel_id=panelmember.panel_id and panelmember.faculty_id='$fid' and student.course_id=course.course_id group by studentmarks.enrollment,studentmarks.eval_id";
                                }

                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td ><?php echo $row["enrollment"]." :".$row["name"]; ?></td>
                                        <td><?php echo $row["eval_name"]; ?></td>
                                        <td><?php echo $row["coursename"]; ?></td>

                                        <td>
                                       
                                        <?php 
                                        $id=$row["eval_id"];
                                        $e=$row["enrollment"];
                                        
                                        $query="select * from studentmarks,criteriamaster,evalutioncriteria where studentmarks.enrollment='$e' and studentmarks.eval_id='$id' and criteriamaster.id=studentmarks.criteria_id and evalutioncriteria.eval_id=studentmarks.eval_id and evalutioncriteria.criteria_id=studentmarks.criteria_id";
                                        $result1=mysqli_query($conn,$query);
                                        while ($r1 = mysqli_fetch_array($result1)) {

                                        echo $r1["cname"]."-->" ?> </t> <?php echo $r1["om"]." out of ".$r1["out_of_marks"] ?><br>
                                    <?php } ?>
                                        
                                        </td>
                                <form action="php/marksoperation.php" method="post">
                                <input type="hidden" name="enrollment" value="<?php echo $row["enrollment"]; ?>">
                                        <input type="hidden" name="eval_id" value="<?php echo $row["eval_id"]; ?>">

                                    <td>
                                        <button type="submit" value="edit" name="edit" class="btn btn-primary"><i class="">Edit</i></button>
                                      

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
    if(isset($_SESSION["smn"]))
    {
        if($_SESSION["smn"]=="yes")
        {
            $_SESSION["smn"]="no";
        ?>
    <script>
        
 swal("Please do select member before proceding");
    
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