<?php
$conn = mysqli_connect("localhost","root","","project_managment_system");
$eval_id =(int) $_POST["eval_id"];


if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
$_SESSION["seval_id"]=$eval_id;
$email=$_SESSION["email"];
$query="select faculty_id from faculty where email='$email'";
$result=mysqli_query($conn,$query);
$result=mysqli_fetch_array($result);
$faculty_id=(int)$result["faculty_id"];

$result = mysqli_query($conn, "SELECT *  from panelallocation,projectgroup,panelmember where eval_id='$eval_id' and panelallocation.group_id=projectgroup.group_id and panelallocation.panel_id=panelmember.panel_id and panelmember.faculty_id='$faculty_id'");
?>
<option value="">Select Project</option>
<?php
while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row["group_id"]; ?>"><?php echo $row["project_title"]; ?></option>
    <?php
}
?>