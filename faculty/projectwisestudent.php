<?php
$conn = mysqli_connect("localhost","root","","project_managment_system");
$group_id =(int) $_POST["group_id"];
if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
$eid=$_SESSION["seval_id"];


$result = mysqli_query($conn, "SELECT name,student.enrollment as e  from groupmember,student where group_id='$group_id' and groupmember.enrollment=student.enrollment and groupmember.enrollment not in (select enrollment from studentmarks where eval_id='$eid' and group_id='$group_id')");
?>

<option value="">Select Student</option>

<?php
while ($r= mysqli_fetch_array($result)) {
    ?>
      <option value="<?php echo $r["e"]; ?>"><?php echo $r["name"]; ?></option>
    <?php
}
?>