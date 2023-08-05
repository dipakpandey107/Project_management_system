<?php
include('smtp/PHPMailerAutoload.php');



function smtp_mailer( $projectgroups,$joinurl,$password,$topic,$time,$s_url){
  if (session_status() === PHP_SESSION_NONE) {
    session_start();

    
};
	include("connection.php");

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
		$mail->Subject = "Project Guide Zoom Meet";
		
	
		$mail->SMTPOptions=array('ssl'=>array(
			'verify_peer'=>false,
			'verify_peer_name'=>false,
			'allow_self_signed'=>false
		));
	
	
    

	foreach($projectgroups as $groupid)
	{

		$q="select * from student,groupmember where group_id='$groupid' and groupmember.enrollment=student.enrollment";
        $r=mysqli_query($conn,$q);
        while($row=mysqli_fetch_array($r))
        {
            $mail->addBcc($row["email"]);
        }

    }

		

		//p i
		$test=$_SESSION["email"];
	  $msg="Dear student  Your Guide Call For meet At $time \r\n subject : $topic \r\n Link: $joinurl \r\n password For Meet : $password  " ;
		
		$msg=nl2br($msg);
		
		$mail->Body =$msg;

		
		$mail->Send();
  }
		
	function smtp_mailerforfaculty( $projectgroups,$joinurl,$password,$topic,$time,$s_url){

    if (session_status() === PHP_SESSION_NONE) {
      session_start();
  
      
  };
    include("connection.php");
  
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
      $mail->Subject = "Project Guide Zoom Meet";
      
    
      $mail->SMTPOptions=array('ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false
      ));
    
    $mail->AddAddress($_SESSION["email"]);


    $msg=" You Have Schedule  meet At $time \r\n subject : $topic \r\n Link: $s_url \r\n password For Meet : $password ";
		
		$msg=nl2br($msg);
		
		$mail->Body =$msg;

		
		$mail->Send();
    
	
}

?>