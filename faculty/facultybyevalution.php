<?php
$conn = mysqli_connect("localhost","root","","project_managment_system");
$evalution_id = $_POST["evaluation_id"];
$result = mysqli_query($conn, "SELECT * from faculty where faculty_id!=14 and  faculty_id not in (select faculty_id from panelmember,panel_eval where panelmember.panel_id=panel_eval.panel_id and eval_id='$evalution_id')");
?>
<option value="">Select faculty</option>
<?php
while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row["faculty_id"]; ?>"><?php echo $row["faculty_name"]; ?></option>
    <?php
}
?>