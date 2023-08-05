<?php
$conn = mysqli_connect("localhost","root","","project_managment_system");
$course_id =(int) $_POST["course_id"];
$date=date("Y-m-d");
$result = mysqli_query($conn, "SELECT * from sheduleevalution where course_id='$course_id' and edate='$date'");

?>
<option value="">Select evalution</option>
<?php
while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row["eval_id"]; ?>"><?php echo $row["eval_name"]; ?></option>
    <?php
}
?>