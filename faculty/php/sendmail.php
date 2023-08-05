<?php
include('smtp/PHPMailerAutoload.php');



function smtp_mailer( $ename,$course,$mode){
	include("connection.php");

	
	$courseid=(int)$course;
    $q="select * from student where course_id='$courseid'";
	$qe=mysqli_query($conn,$q);
	while($r=mysqli_fetch_array($qe))
	{

		$mail = new PHPMailer(); 
		$mail->SMTPDebug  = 0;
		$mail->IsSMTP(); 
		$mail->SMTPAuth = true; 
		$mail->SMTPSecure = 'tls'; 
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587; 
		$mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->Username = "cbpatelcollege107@gmail.com";
		$mail->Password = "cbpatel107";
		$mail->SetFrom("cbpatelcollege107@gmail.com");
		$mail->Subject = "Project Evalution";
		
	
		$mail->SMTPOptions=array('ssl'=>array(
			'verify_peer'=>false,
			'verify_peer_name'=>false,
			'allow_self_signed'=>false
		));




		$e=$r["email"];
		

		//p info
		$sname=$r["name"];
		if($mode=="delete"){
			$msg="Dear Student $sname  Evalution '$ename' has been cancelled.. \r\n For more information kindly refer the Evalution section in your student portal \n Thank You.. ";
		}
		else{
			$msg="Dear Student $sname Evalution '$ename' has been scheduled..\r\n For more information kindly refer  Evalution section in your student portal \n Thank You.. ";
		}
		
		$mail->Body =$msg;

		$mail->addAddress($r["email"]);
		$mail->Send();
		
		
	}

	header("Location: /sem6/project6sem/faculty/createevaluation.php");
	

}
?>