<!doctype html>
<html lang="en">
<?php
if (session_status() === PHP_SESSION_NONE) {
   
    session_start();
};

if(!isset($_SESSION["email"]))
{
	
	header("location: /sem6/project6sem/index.php");
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
 
 if(isset($_SESSION["role"]))
 {
	 if($_SESSION["role"]=='f')
	 {
		 ?>



<head>
<?php

?>
	<title>faculty Dashboard</title>
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
				$q="select * from faculty where email='$e'";
				$r=mysqli_query($conn,$q);
				$r=mysqli_fetch_array($r);
				$fname=$r["faculty_name"];
				$fid=(int)$r["faculty_id"];

				if(isset($_SESSION["committeemember"]))
				{
					if($_SESSION["committeemember"]=="yes")
					{
						$q="select * from course,committe where course.course_id=committe.course_id and faculty_id='$fid'";
						$r=mysqli_query($conn,$q);
						$r=mysqli_fetch_array($r);
						$course_id=$r["coursename"];
					}
				}

			?>


				<form class="navbar-form navbar-left">
					<div class="text-label" id="title">
					<?php 
					if(isset($_SESSION["committeemember"]))
					{
					if($_SESSION["committeemember"]=="yes")
					{
					?>
						<img src="http://localhost/sem6/project6sem/images/user.png" height="35px" width="35px" /><input type="text" value="" class="form-control" placeholder="<?php echo "Welcome(Faculty)  : " .$fname." | Committe Member of :  ".$course_id ?> " style="width:500px">
						<?php } 
						else
						{
							?>
						<input type="text" value="" style="color: black;" class="form-control" placeholder="<?php echo "Welcome(Faculty) : " .$fname?> ">

						<?php }} ?>
						
						
						
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
						
						<li><a href="underyourguidance.php" class=""><i class="lnr lnr-code"></i> <span>Under Your Guidance</span></a></li>
						<li><a href="addlog.php" class=""><i class="lnr lnr-cog"></i> <span>Log Book</span></a></li>
						<li><a href="viewevaluationfaculty.php" class=""><i class="lnr lnr-alarm"></i> <span>View Evaluation</span></a></li>
						<?php if(isset($_SESSION["committeemember"]))
						{
							if($_SESSION["committeemember"]=="yes")
							{
								
					
						
						
						?>
						<li>
							<a href="#subPages1" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Committee</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages1" class="collapse ">
								<ul class="nav">
									<li><a href="viewallprojects.php" class="">View All Project</a></li>
									<li><a href="allocateguide.php" class="">Allocate Guides</a></li>
									<li><a href="criteria.php" class="">Create Criterias</a></li>
									<li><a href="createevaluation.php" class="">Create Evaluation</a></li>
									<li><a href="createpanel.php" class="">Create Panel</a></li>
									<li><a href="allocatepanel.php" class="">Allocate Panel</a></li>
									<li><a href="viewmarkscommittee.php" class="">View Marks</a></li>
								</ul>
							</div>
						</li>
						<?php } } ?>
						<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Panel</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="underyourpanel.php" class="">Under Your Panel</a></li>
									<li><a href="evaluatestudents.php" class="">Evaluate Students</a></li>
								</ul>
							</div>
						</li>
						
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
<?php 
	 }
	}
	?>