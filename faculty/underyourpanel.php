<!-- 
 Data To be displayed in table -- CourseID, Project Title, Student Name (Both Member) // where panel=current faculty
                            -->

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
 Data To be displayed in table -- CourseID, Project Title, Student Name (Both Member) // where panel=current faculty
                            -->

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">group member</th>
                                    <th scope="col">course</th>
                                    <th scope="col">project_title</th>
                                    <th scope="col">evalution</th>
                                    <th scope="col">panel partner</th>
                                   
                                    

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'php/connection.php';

                               
                                $email=$_SESSION["email"];
                                $query="select faculty_id from faculty where email='$email'";
                                $result=mysqli_query($conn,$query);
                                $result=mysqli_fetch_array($result);
                                $faculty_id=$result["faculty_id"];


                                
                                $query = "select * from panelmember where faculty_id='$faculty_id'";
                                

                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    $panel=$row["panel_id"];

                                    if (isset($_POST["searchbtn"])) {
                                        $s = $_POST["search"];
                                        $q = "select * from panelallocation,projectgroup,sheduleevalution,course where panel_id='$panel' and panelallocation.group_id=projectgroup.group_id and panelallocation.eval_id=sheduleevalution.eval_id and projectgroup.course_id=course.course_id  and  concat(project_title,coursename,eval_name) like '%$s%' order by course.course_id,sheduleevalution.eval_id";
                                    } else {
                                        $q=  "select * from panelallocation,projectgroup,sheduleevalution,course where panel_id='$panel' and panelallocation.group_id=projectgroup.group_id and panelallocation.eval_id=sheduleevalution.eval_id and projectgroup.course_id=course.course_id order by course.course_id,sheduleevalution.eval_id";
                                    }
                                    $r=mysqli_query($conn,$q);
                                        while($rr=mysqli_fetch_array($r))
                                {
                                        ?>
                                        <tr>
                                            <td >
                                                <?php $g_id=(int)$rr["group_id"];
                                                $query="select *,name,groupmember.enrollment as e from groupmember,student where groupmember.enrollment=student.enrollment and group_id='$g_id' ";
                                                $result1=mysqli_query($conn,$query);
                                                while ($r1 = mysqli_fetch_array($result1)) {
                                                
                                                echo $r1["e"] ?> </t> <?php echo $r1["name"];?><br>
                                                <?php } ?>
                                                </td>
                                            
                                            </td>
                                            <td><?php echo $rr["coursename"]; ?></td>
                                            <td><?php echo $rr["project_title"]; ?></td>
                                            <td><?php echo $rr["eval_name"]; ?></td>

                                            <?php
                                                $ev_id=(int)$rr["eval_id"];
                                                $qrt="select * from panelallocation,faculty,panelmember where panelallocation.group_id='$g_id' and panelallocation.eval_id='$ev_id' and panelallocation.panel_id=panelmember.panel_id and panelmember.faculty_id=faculty.faculty_id and faculty.faculty_id!='$faculty_id'";
                                                $w=mysqli_query($conn,$qrt);
                                                $w=mysqli_fetch_array($w);
                                            ?>
                                            <td><?php if($w!=null){ echo $w["faculty_name"]; }?></td>
                                            </tr>
                            <?php
                                } 
                            }
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