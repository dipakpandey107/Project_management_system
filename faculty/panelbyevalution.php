<?php
$conn = mysqli_connect("localhost","root","","project_managment_system");
$evalution_id = $_POST["evaluation_id"];
$result = mysqli_query($conn, "SELECT * from panel_eval where eval_id='$evalution_id'");
?>
<option value="">Select faculty</option>
<?php
while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row["panel_id"]; ?>"><?php echo $row["panel_desc"]; ?></option>
    <?php
}
?>