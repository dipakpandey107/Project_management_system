<html>

<head>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    };
    if (!isset($_SESSION["email"])) {

        header("location: /sem6/project6sem/index.php");
    }
    if (isset($_SESSION["committeemember"])) {
        if ($_SESSION["committeemember"] == "yes") {
    ?>
            <title>CBP</title>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
            <!-- VENDOR CSS -->
            <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
            <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
            <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
            <!-- MAIN CSS -->
            <link rel="stylesheet" href="assets/css/main.css">
            <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
            <link rel="stylesheet" href="assets/css/demo.css">
            <!-- GOOGLE FONTS -->
            <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
            <!-- ICONS -->
            <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
            <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon.ico">
            <script src="assets/scripts/sweetalert.min.js"></script>
            <style>
                .panel {
                    margin-top: 10%;
                    margin-left: 20%;
                }

                #addf {
                    margin-top: -10%;
                    margin-left: -15%;
                }

                #datatable {
                    margin-left: 18%;
                    width: 85%;
                }

                .container {
                    padding: 2rem 0rem;

                }

                h4 {
                    margin: 2rem 0rem 1rem;
                }

                .table-image {

                    td,
                    th {
                        vertical-align: middle;
                    }
                }
            </style>
            <script>
                window.onload = function() {
                    document.getElementById('togglebtn').click();
                }
            </script>
</head>

<body>





    <div class="container" ;>
        <?php
            include 'facultydash.php';
        ?>

        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <h3 class="panel-title">Evaluations</h3>
                </h3>
                <div class="right">

                    <button type="button" id="togglebtn" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>

                </div>
            </div>
            <div class="panel-body" id="addf">
                <!-- INPUT GROUPS -->
                <div class="panel">

                    <div class="panel-heading">
                        <h4>Add Evaluation</h4>
                    </div>
                    <div class="panel-body">
                        <form action="php/addevalution.php" method="post" >




                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Evaluation Name</button>
                                </span>
                                <input name="name" class="form-control" type="text" pattern="[a-zA-Z ]{5,}+" required="" title="minimum 10 character needed">
                            </div>
                            <br>



                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Date</button>
                                </span>
                                <input name="date" class="form-control" type="date" min='<?php echo date("Y-m-d"); ?>' required="">
                            </div>
                            <br>

                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Type</button>
                                </span>
                                <select class="form-control" name="type" required="">
                                    <option value="Presentation">Presentation</option>
                                    <option value="Submission">Submission</option>

                                </select>
                            </div>
                            <br>


                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Description</button>
                                </span>
                                <input name="description" class="form-control" type="text" required="">
                            </div>
                            <br>
                            
                           
                            
<div id="fieldList"></div>

<button type="button" id="addMore" name="addMore" class="btn btn-success" style="margin-right: 20px;"><i class="fa fa-check-circle"></i> Add Criteria</button>




                            <button type="submit"  id="addevalution" name="addevalution" class="btn btn-success" style="margin-right: 20px;"><i class="fa fa-check-circle"></i> Add Evaluation</button>


                        </form>
                    </div>
                </div>
                <!-- END INPUT GROUPS -->
            </div>
        </div>



        <?php
                            $conn = mysqli_connect("localhost", "root", "", "project_managment_system");



                            if (session_status() === PHP_SESSION_NONE) {
                                session_start();
                            };

                            $email = $_SESSION["email"];
                            $query = "select * from criteriamaster";
                            $results = mysqli_query($conn, $query);
                           
                            ?>
                            




                            <br>



                            <br>
                            <script>
                                $(function() {
                                    $("#addMore").click(function(e) {
                                        e.preventDefault();

                                        $("#fieldList").append('<div class="input-group"><span class="input-group-btn"><label class="btn btn-primary" type="label">Criteria 1</button></span><select class="form-control" name="cr[]" required=""><?php while ($row = mysqli_fetch_array($results)) { ?> <option value="<?php echo $row["id"]; ?>"><?php echo $row["cname"]; ?></option> <?php } ?></select></div>');
                                        
                                        $("#fieldList").append('<div class="input-group" id="last"><span class="input-group-btn"><label class="btn btn-primary" type="label">Marks of Criteria 1</button></span><input name="mr[]" class="form-control" type="text" pattern="[1-9][0-9]+" required=""title="marks should be positive numebre"></div>');
                                        $("#fieldList").append("&nbsp;");

                                    });
                                });
                            </script>



        <!-- BASIC TABLE -->
        <!-- BASIC TABLE -->
        <div class="container" id="datatable">
            <div class="row">
                <div class="col-12">
                    <form method="post" action="#">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search ">
                            <span class="input-group-btn"><button type="submit" value="yes" name="searchbtn" class="btn btn-primary">Go</button></span>
                        </div>
                    </form>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Evalution Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">description</th>
                                <th scope="col">criterias</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'php/connection.php';

                            $e = $_SESSION["email"];
                            $q = "select * from faculty where email='$e'";
                            $r = mysqli_query($conn, $q);
                            $r = mysqli_fetch_array($r);
                            $fid = (int)$r["faculty_id"];

                            $q = "select * from committe where faculty_id='$fid'";
                            $r = mysqli_query($conn, $q);
                            $r = mysqli_fetch_array($r);
                            $cid = (int)$r["course_id"];


                            if (isset($_POST["searchbtn"])) {
                                $s = $_POST["search"];
                                $query = "select * from sheduleevalution where course_id='$cid' and concat(eval_name,edate) like '%$s%'";
                            } else {

                                $query = "select * from sheduleevalution where course_id='$cid'";
                            }

                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $row["eval_name"]; ?></td>
                                    <td><?php echo $row["edate"]; ?></td>
                                    <td><?php echo $row["description"]; ?></td>
                                    <td>
                                        <?php $id = $row["eval_id"];
                                        $query = "select * from evalutioncriteria,criteriamaster where eval_id='$id'and  criteria_id=id";
                                        $result1 = mysqli_query($conn, $query);
                                        while ($r1 = mysqli_fetch_array($result1)) {

                                            echo $r1["cname"] ?> </t> ,marks: <?php echo $r1["out_of_marks"]; ?><br>
                                        <?php } ?>
                                    </td>

                                    <form action="php/addevalution.php" method="post">
                                        <input type="hidden" value="<?php echo $id; ?>" name="eval_id">


                                        <td>
                                            <button type="submit" value="edit" name="editeval" class="btn btn-primary"><i class="">Edit</i></button>



                                            <?php
                                            echo "<button type='submit' value='deleteeval' name='deleteeval' class='btn btn-danger'  onClick=\"javascript: return confirm('Do you want to delete this record');\"><i class=''>Delete</i></button>";
                                            ?>
                                        </td>
                                    </form>




                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- END BASIC TABLE -->


    </div>
    <?php
            if (isset($_SESSION["evalutionadded"])) {
                if ($_SESSION["evalutionadded"] == "yes") {
                    $_SESSION["evalutionadded"] = "no";
    ?>
            <script>
                swal("evalution added successfully");
            </script>
    <?php
                }
            }
    ?>


    <?php
            if (isset($_SESSION["duplicatecr"])) {
                if ($_SESSION["duplicatecr"] == "yes") {
                    $_SESSION["duplicatecr"] = "no";
    ?>
            <script>
                swal("duplicate criteria is not allowed ");
            </script>
    <?php
                }
            }
    ?>


<?php
            if (isset($_SESSION["nocr"])) {
                if ($_SESSION["nocr"] == "yes") {
                    $_SESSION["nocr"] = "no";
    ?>
            <script>
                swal("Please do add criteria to evaltuion...try again ");
            </script>
    <?php
                }
            }
    ?>
</body>

</html>

<?php
        }
    }
?>