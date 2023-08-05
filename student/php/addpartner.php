<?php
include 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
};

if(isset($_POST["addpartner"]))
{


    if(isset($_POST["selfonly"]))
    {

        $myenroll=$_POST["selfonly"];
        //check there should not be partner before
           $qdp="select group_id from groupmember where enrollment='$myenroll'";
           $rdp=mysqli_query($conn,$qdp);
           $rdp=mysqli_fetch_array($rdp);
           //first time
           if($rdp==null)
           {
            $q="select course_id from student where enrollment='$myenroll'";
            $result=mysqli_query($conn,$q);
            $row=mysqli_fetch_array($result);
            $course=$row["course_id"];


            $query="insert into projectgroup(course_id,self) values('$course',1)";
            $result=mysqli_query($conn,$query);

            $q="select max(group_id) as id from projectgroup";
            $result=mysqli_query($conn,$q);
            $row=mysqli_fetch_array($result);
            $group=$row["id"];

            $query="insert into groupmember(group_id,enrollment) values('$group','$myenroll')";
            $result=mysqli_query($conn, $query);

           }
           else
           {
               $group_id=(int)$rdp["group_id"];
               $qcp="select count(group_id) as p from groupmember where enrollment!='$myenroll' and group_id='$group_id'";
               $rcp=mysqli_query($conn,$qcp);
               $rcp=mysqli_fetch_array($rcp);
               if($rcp["p"]==0)
               {
                
    
                }
               
               else
               {
                $_SESSION["partnerexist"]="yes";
               }
           }




            
                      
            
            header("Location: /sem6/project6sem/student/projectpartner.php");
        
    }
    else
    {
    

    $enrollment=$_POST["enrollment"];
    if(!empty($enrollment)){

    
    $e=$_SESSION["email"];
    $q="select enrollment from student where email='$e'";
    $result=mysqli_query($conn,$q);
    $row=mysqli_fetch_array($result);
    $myenroll=$row["enrollment"];

    
    $q="select course_id from student where enrollment='$enrollment'";
    $result=mysqli_query($conn,$q);
    $row=mysqli_fetch_array($result);
    $course=$row["course_id"];


    $q="select count(enrollment) as e from groupmember where enrollment='$myenroll'";
    $result=mysqli_query($conn,$q);
    $row=mysqli_fetch_array($result);

    $group_id;
    if($row["e"]==0)
    {
        $query="insert into projectgroup(course_id) values('$course')";
        $result=mysqli_query($conn,$query);

    $q="select max(group_id) as id from projectgroup";
    $result=mysqli_query($conn,$q);
    $row=mysqli_fetch_array($result);
    $group=(int)$row["id"];

    }
    else
    {
       
       
    $q="select projectgroup.group_id as id from projectgroup,groupmember where projectgroup.group_id=groupmember.group_id and enrollment='$myenroll'";
    $result=mysqli_query($conn,$q);
    $row=mysqli_fetch_array($result);
    $group=(int)$row["id"];

    }

    //check self declarre
    $qsd="select self from projectgroup where group_id='$group'";
    $rsd=mysqli_query($conn,$qsd);
    $rsd=mysqli_fetch_array($rsd);
    if($rsd[self]==0)
    {
        $query="insert into groupmember(group_id,enrollment) values('$group','$enrollment')";
        $result=mysqli_query($conn, $query);
    
        $q="select count(enrollment) as e from groupmember where enrollment='$myenroll'";
        $result=mysqli_query($conn,$q);
        $row=mysqli_fetch_array($result);
        if($row["e"]==0)
        {
    
        
    
        $query="insert into groupmember(group_id,enrollment) values('$group','$myenroll')";
        $result=mysqli_query($conn, $query);
        }
        if(mysqli_affected_rows($conn))
         {
             if (session_status() === PHP_SESSION_NONE) {
        session_start();
    };
             $_SESSION["partneradded"]="yes";
         }
        
    }
    else
    {
        $_SESSION["selfdeclare"]="yes";
    }
    
   
       
       header("Location: /sem6/project6sem/student/projectpartner.php");
    }
}
    header("Location: /sem6/project6sem/student/projectpartner.php");
}
if(isset($_POST["deletepartner"]))
{
    $enroll=$_POST["enrollment"];
    $q="select group_id from groupmember where enrollment='$enroll'";
    $result=mysqli_query($conn,$q);
    $row=mysqli_fetch_array($result);
    $group_id=(int)$row["group_id"];

    $q = "select * from projectgroup where group_id='$group_id'";
    $result = mysqli_query($conn, $q);
    $row = mysqli_fetch_array($result);
    $self = (int)$row["self"];
 
   

    // deleting member
    $q="delete from groupmember where enrollment='$enroll'";
    $result=mysqli_query($conn,$q);

//counting member if  no member exist other than a user it self the delete user enrty too
    $q="select count(group_id) as id from groupmember where group_id='$group_id'";
    $result=mysqli_query($conn,$q);
    $row=mysqli_fetch_array($result);

    if($row["id"]==1)
    {
        $q="delete from groupmember where group_id='$group_id'";
        $result=mysqli_query($conn,$q);

        $q="delete from projectgroup where group_id='$group_id'";
        $result=mysqli_query($conn,$q);

        $q="delete from projectguidance where group_id='$group_id'";
        $result=mysqli_query($conn,$q);




    }
    else
    {
        if($self==1)
        {
        $q="delete from projectgroup  where group_id='$group_id'";
        $result = mysqli_query($conn, $q);
        }

    }

    
    header("Location: /sem6/project6sem/student/projectpartner.php");
}