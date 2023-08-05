<?php
$conn = mysqli_connect("localhost","root","","project_managment_system");



if (session_status() === PHP_SESSION_NONE) {
    session_start();
};

$email=$_SESSION["email"];
$query="select * from criteriamaster";
$result=mysqli_query($conn,$query);


?>
<option value="">Select Project</option>
<?php
while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row["id"]; ?>"><?php echo $row["cname"]; ?></option>
    <?php
}
?>