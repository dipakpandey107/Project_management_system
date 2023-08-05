
<!doctype html>
<html lang="en">

<head>
<?php
if (session_status() === PHP_SESSION_NONE) {
   
    session_start();
};


if(!isset($_SESSION["email"]))
{
	header("location: /sem6/project6sem/index.php");
	echo 'no session';
}
if(isset($_SESSION["dpassword"]))
{
	if($_SESSION["dpassword"]=="yes")
	{
		echo "<script>
alert('Please first change your default password');
window.location.href='/sem6/project6sem/php/forgetpassword.php';
</script>";
	}
	
}
?>
	<title>Student Dashboard</title>
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
	<style>
	#sidebar-nav
	{
		margin-top:1%;
		
		color:red;
	}

	</style>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			
			<div class="container-fluid">
			<?php
				include 'php/connection.php';
				
				$e=$_SESSION["email"];
				$q="select * from student where email='$e'";
				$r=mysqli_query($conn,$q);
				$r=mysqli_fetch_array($r);
				$cid=$r["course_id"];
				$q="select * from course where course_id='$cid'";
				$rr=mysqli_query($conn,$q);
				$rr=mysqli_fetch_array($rr);




			?>


				<form class="navbar-form navbar-left">
					<div class="text-label">
						<img src="http://localhost/sem6/project6sem/images/user.png" /><input type="text" readonly value="" class="form-control" placeholder="<?php echo "welcome(Student) " .$r["name"]."     course:  ".$rr["coursename"]?> " style="width:500px">
						
						
						
					</div>
				</form>
				
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							
							
						<li class="dropdown">
							
							
								<li><a href="/sem6/project6sem/php/logout.php"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
						
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="#"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="viewevaluation.php" class=""><i class="lnr lnr-code"></i> <span>Evaluation Schedule</span></a></li>
						<li><a href="projectpartner.php" class=""><i class="lnr lnr-chart-bars"></i> <span>Project Partner</span></a></li>
						<?php 
							include 'php/connection.php';

							$e=$_SESSION["email"];
							$q="select enrollment from student where email='$e'";
							$result=mysqli_query($conn,$q);
							$row=mysqli_fetch_array($result);
							$myenroll=$row["enrollment"];

							$q="select count(group_id) as id from groupmember where enrollment='$myenroll'";
							$result=mysqli_query($conn,$q);
							$row=mysqli_fetch_array($result);
							if($row["id"]>=1)
							{
							

						?>
						<li><a href="projectdetails.php" class=""><i class="lnr lnr-cog"></i> <span>Project Details</span></a></li>
						<?php } ?>
						<li><a href="viewlogbook.php" class=""><i class="lnr lnr-cog"></i> <span>Guidance/Log Book</span></a></li>
						<li><a href="viewmarksstudent.php" class=""><i class="lnr lnr-alarm"></i> <span>Marks</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<?php
			//include 'myelements.php'; 
		?>
		<!--  Enter Main  -->
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2022 <a href="#" target="_blank">Developed by Dipak Pandey , Jainam Shah & Jeet panchal</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
	<script>
	</script>
</body>

</html>
