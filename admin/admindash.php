<?php
if (session_status() === PHP_SESSION_NONE) {
    
    session_start();
};

if(!isset($_SESSION["email"]))
{
	header("location: /sem6/project6sem/index.php");
}
include 'php/connection.php';

 if(isset($_SESSION["id"]))
{
    $email=$_SESSION["email"];
    $query="select * from faculty where email='$email'";
    $result=mysqli_query($conn, $query);
  

    
    while($row= mysqli_fetch_array($result))
    {
           
   
        

 ?>

<html lang="en">

<head>
<?php


?>
	<title>Admin Dashboard</title>
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
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
	<style>
	#sidebar-nav
	{
		margin-top:1%;
		
		color:red;
	}

	</style>
	<script>
	$(document).ready(function(){
  $(".btn-toggle-fullwidth").click(function(){
      $(this).next('.collapse').slideToggle();
  });
});

	</script>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
                            <label>CBP</label>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth" active=""><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<form class="navbar-form navbar-left">
					
				</form>
				
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
					
						
			<!--	<li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user.png" class="img-circle" alt="Avatar"> <span><?php echo $row["faculty_name"]; ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
								<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
								<li><a href="/sem6/project6sem/php/logout.php"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul> -->
							<br>
							<h5>
							<a href="/sem6/project6sem/php/logout.php">Logout</a></h5>
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
						<li><a href="#" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="projectcourse.php" class=""><i class="lnr lnr-cloud"></i> <span>Project Courses</span></a></li>
						<li><a href="faculty.php" class=""><i class="lnr lnr-user"></i> <span>Faculties</span></a></li>
						<li><a href="student.php" class=""><i class="lnr lnr-users"></i> <span>Students</span></a></li>
						<li><a href="createcommittee.php" class=""><i class="lnr lnr-users"></i> <span>Committee</span></a></li>
						<li><a href="addtechnology.php" class=""><i class="lnr lnr-cloud"></i> <span>Manage Technology</span></a></li>
						
						
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
	<script src="assets/scripts/Klorofil-common.js"></script>
     
	
	
</body>
<?php
    }
}
?>

</html>
