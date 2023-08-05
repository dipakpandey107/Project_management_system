<?php
//include connection file
include_once("con2.php");
include_once('libs/fpdf.php');
session_start();
$e=$_SESSION["email"];
 
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.png',20,-1,35);
    $this->SetFont('Helvetica','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(45,10,'Student Marks List',1,0,'C');
    // Line break
    $this->Ln(20);
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
 
$db = new dbObj();
$connString =  $db->getConnstring();
$display_heading = array('project_title'=>'Project Title', 'name'=> 'Name', 'en'=> 'Enrollment', 'm'=> 'Marks','eval_name'=> 'Evaluation Name','coursename'=> 'Course Name');
 
$result = mysqli_query($connString, "select project_title,name,student.enrollment as en,sum(om) as m,eval_name,coursename  from studentmarks,student,projectgroup,sheduleevalution,course where student.course_id=course.course_id and  studentmarks.enrollment=student.enrollment and student.course_id=(select course_id from committe,faculty where email='$e' and faculty.faculty_id=committe.faculty_id) and studentmarks.group_id=projectgroup.group_id and sheduleevalution.eval_id=studentmarks.eval_id group by studentmarks.enrollment,studentmarks.eval_id") or die("database error:". mysqli_error($connString));
//$header = mysqli_query($connString, "SHOW columns FROM student");
 
$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',10);
$header= array("Project Title","Name","Enrollment","Marks","Evaluation Name","Course Name");
//foreach($header as $heading) {
//$pdf->Cell(20,12,$display_heading[$heading['Field']],1);
//}

$pdf->Cell(32,12,$display_heading["project_title"],1);
$pdf->Cell(32,12,$display_heading['name'],1);
$pdf->Cell(32,12,$display_heading['en'],1);
$pdf->Cell(32,12,$display_heading['m'],1);
$pdf->Cell(32,12,$display_heading['eval_name'],1);
$pdf->Cell(32,12,$display_heading['coursename'],1);

foreach($result as $row) {
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(32,12,$column,1);
}
$pdf->Output();
?>