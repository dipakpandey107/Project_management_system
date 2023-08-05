<?php
include 'connection.php';
include 'sendmailformeet.php';
if(isset($_POST["meetbtn"]))
{

    
if (session_status() === PHP_SESSION_NONE) {
    session_start();

	
};
    $topic=$_POST["topic"];
    $time=$_POST["meettime"];
    $meettime=strtotime($_POST["meettime"]);
    $mpassword=$_POST["mpassword"];
    $y=date('Y',$meettime);
    $m=date('m',$meettime);
    $d=date('d',$meettime);
    $h=date('H',$meettime);
    $i=date('i',$meettime);
    $ty=date("Y");
    $tm=date("m");
    $td=date("d");
    if($y>=$ty and $m>=$tm and $d>=$td)
    {
    $h=$h+5;
    $i=$i+30;
if(isset($_SESSION["m1"]))
{
    if($_SESSION["m1"]!=$topic and $_SESSION["m2"]!=$meettime and $_SESSION["m3"]!=$mpassword )
    {
                            include('config.php');
                    include('api.php');
                    $arr['topic']=$topic;
                    $arr['start_date']=date("$y-$m-$d\T$h:$i:00");
                    $arr['duration']=30;

                    $arr['password']=$mpassword;
                    $arr['type']='2';
                    $result=createMeeting($arr);
                    if(isset($result->id)){

                        
                        //send mail
                        smtp_mailer($_SESSION["projectgroups"],$result->join_url,$result->password,$topic,$time,$result->start_url);
                        smtp_mailerforfaculty($_SESSION["projectgroups"],$result->join_url,$result->password,$topic,$time,$result->start_url);
                        $_SESSION["meetsent"]="yes";
                        $_SESSION["m1"]=$topic;
                        $_SESSION["m2"]=$meettime;
                        $_SESSION["m3"]=$mpassword;
                        header("Location: /sem6/project6sem/faculty/underyourguidance.php");
                        

                        /*echo "Join URL: <a href='".$result->join_url."'>".$result->join_url."</a><br/>";
                        echo "start URL: <a href='".$result->start_url."'>".$result->start_url."</a><br/>";
                        echo "Password: ".$result->password."<br/>";
                        echo "Start Time: ".$result->start_time."<br/>";
                        echo "Duration: ".$result->duration."<br/>";
                        echo $meettime;
                    
                        echo '<pre>';
                        print_r($result);*/
                    }else{
                        $_SESSION["meetsenterror"]="yes";
                        header("Location: /sem6/project6sem/faculty/underyourguidance.php");
                        
                    }
   

    }
    else
    {
        //duplicate datadouble click
        header("Location: /sem6/project6sem/faculty/underyourguidance.php");
    }
}
else
{
    include('config.php');
include('api.php');
$arr['topic']=$topic;
$arr['start_date']=date("$y-$m-$d\T$h:$i:00");
$arr['duration']=30;

$arr['password']=$mpassword;
$arr['type']='2';
$result=createMeeting($arr);
if(isset($result->id)){

    
    //send mail
    smtp_mailer($_SESSION["projectgroups"],$result->join_url,$result->password,$topic,$time,$result->start_url);
    $_SESSION["meetsent"]="yes";
    $_SESSION["m1"]=$topic;
    $_SESSION["m2"]=$meettime;
    $_SESSION["m3"]=$mpassword;
    header("Location: /sem6/project6sem/faculty/underyourguidance.php");
    

	/*echo "Join URL: <a href='".$result->join_url."'>".$result->join_url."</a><br/>";
	echo "start URL: <a href='".$result->start_url."'>".$result->start_url."</a><br/>";
	echo "Password: ".$result->password."<br/>";
	echo "Start Time: ".$result->start_time."<br/>";
	echo "Duration: ".$result->duration."<br/>";
    echo $meettime;
   
	echo '<pre>';
	print_r($result);*/
}else{
    $_SESSION["meetsenterror"]="yes";
    header("Location: /sem6/project6sem/faculty/underyourguidance.php");
	
}
   

}   


    }
    //prevous date
    else
    {
        $_SESSION["pd"]="yes";
        header("Location: /sem6/project6sem/faculty/underyourguidance.php");
    }
   
}

?>