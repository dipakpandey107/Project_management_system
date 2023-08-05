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

		if(isset($_POST["projectgroups"]))
		{
			$_SESSION["projectgroups"]=$_POST["projectgroups"];
		}
		else
		{
			header("location: /sem6/project6sem/faculty/meetforguide.php");
		}

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
           
 
       
        </script>
        script>
    <script language="javascript">
        $(document).ready(function () {
            $("#txtdate").datepicker({
                minDate: 0
            });
        });
    </script>
    </head>
    <body>





        <div class="container">
            <?php
            include 'facultydash.php';
            ?>

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"> <h3 class="panel-title">Schedule Zoom Meet</h3></h3>
                    
                </div>
                <div class="panel-body" id="addf">
                    <!-- INPUT GROUPS -->
                    <div class="panel">

                        <div class="panel-heading">
                            <h4>Meet Details</h4>
                        </div>
                        <div class="panel-body">
                            <form action="php/createmeet.php" method="post">



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
                                    <label class="btn btn-primary" type="label">Topic</label>
                                </span> 
								<input name="topic" class="form-control" type="text"  required="" >
                            </div>
                            <br>

                           

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Meet Time</button>
                                </span> 
                                <input id="txtdate"  name="meettime" class="form-control" type="datetime-local"  required=""  >
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Password FOr Meet</button>
                                </span> 
                                <input name="mpassword" class="form-control" type="text" pattern="[a-zA-Z0-9]{1,9}"  required="" title="password should be less than 10 digits and not contain any special character">
                            </div>
                            <br>

                            
							
                            <button type="submit" name="meetbtn" class="btn btn-success" style="margin-right: 20px;"><i class="fa fa-check-circle"></i> Schedule Meet</button>
                        

                            </form>
                        </div>
                    </div>
                    <!-- END INPUT GROUPS -->
                </div>
            </div>




            <!-- BASIC TABLE -->
            

             
            
        </div>
   
    </body>
</html>

<?php
     }
    }


?>