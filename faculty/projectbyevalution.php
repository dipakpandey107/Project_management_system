<?php
$conn = mysqli_connect("localhost","root","","project_managment_system");
$evalution_id =(int)$_POST["evaluation_id"];
if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
$cid=$_SESSION["course_id"];
$result = mysqli_query($conn, "SELECT * from projectgroup where course_id='$cid' and  group_id not in (select group_id from panelallocation where eval_id='$evalution_id')");
?>

<?php
while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row["group_id"]; ?>"><?php echo $row["project_title"]; ?></option>
    <?php
}
?>