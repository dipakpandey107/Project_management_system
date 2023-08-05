<?php
include('smtp/PHPMailerAutoload.php');



function smtp_mailer( $students){
	include("connection.php");

	
	foreach($students as $en)
	{
        $q="select * from student where enrollment='$en'";
        $qe=mysqli_query($conn,$q);
        $r=mysqli_fetch_array($qe);
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
		$mail->Subject = "Project Evalution Marks";
		
	
		$mail->SMTPOptions=array('ssl'=>array(
			'verify_peer'=>false,
			'verify_peer_name'=>false,
			'allow_self_signed'=>false
		));




		$e=$r["email"];
		

		//p info
		$sname=$r["name"];
		
			$msg="Dear $sname Your project evalution marks has been submitted .\r\n For more information kindly refer  marks section in your student portal \n Thank You.. ";
		
		
		$mail->Body =$msg;

		$mail->addAddress($r["email"]);
		$mail->Send();
		
		
	}

	

}
?>