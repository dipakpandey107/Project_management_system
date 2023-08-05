<html>
    <head>
        
        <title>Faculty DashBoard | Admin</title>
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
        <style>
            .panel{
                margin-top: 100px;
                margin-left: 200px;;
            }
            #editframe{
               padding-left: 200px;
               padding-right: 200px;
               background-color:#F8F8F8;
            }
            #addf{
                margin-top:-200px;
                margin-left:-170px;
            }

        </style>

       
    </head>
    <body>
        <?php
        if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
        if(!isset($_SESSION["email"]))
{
	
	header("location: /sem6/project6sem/index.php");
}
        include 'facultydash.php';
        if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
        ?>



<div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <h3 class="panel-title"></h3>
                </h3>
                
            </div>
            <div class="panel-body" id="addf">
                <!-- INPUT GROUPS -->
                <div class="panel">

                    <div class="panel-heading">
                        <h4>update Evaluation</h4>
                    </div>
                    <div class="panel-body">
                        <form action="php/addevalution.php" method="post">




                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Evaluation Name</button>
                                </span>
                                <input name="name" value="<?php echo $_SESSION["ename"]; ?>" class="form-control" type="text" pattern="[a-zA-Z ]{5,}+" required=""
                                    title="minimum 10 character needed">
                            </div>
                            <br>



                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Date</button>
                                </span>
                                <input name="date" value="<?php echo $_SESSION["edate"]; ?>" class="form-control" min='<?php echo date("Y-m-d"); ?>' type="date" required="">
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
                                <input name="description" value="<?php echo $_SESSION["description"]; ?>" class="form-control" type="text"
                                    required="">
                            </div>
                            <br>
<?php
$eval_id=(int)$_SESSION["eval_id"];
include 'php/connection.php';

$q="select * from evalutioncriteria,criteriamaster where criteria_id=id and eval_id='$eval_id'";
$result12=mysqli_query($conn,$q);


                           while ($row = mysqli_fetch_array($result12)) {
                                ?>
                                
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Criteria 1</button>
                                </span>
                               
                                <select class="form-control" name="cr[]" required="" id="cr[]">
                               

                                <option selected="" value="<?php echo $row["id"]; ?>"><?php echo $row["cname"]; ?></option>
                                    <?php
                                        include 'php/connection.php';
                                        $crid=(int)$row["id"];
                                        $srn=(int)$row["srn"];
                                        $marks=(int)$row["out_of_marks"];
                                        $query = "select * from criteriamaster where id!='$crid'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row2 = mysqli_fetch_array($result)) {
                                            ?>
                                    <option value="<?php echo $row2["id"]; ?>"><?php echo $row2["cname"]; ?></option>

                                    <?php }
                                        ?>

                                </select>
                                <input Type='hidden' name="srn[]" value="<?php echo $srn; ?>">
                            </div>
                            <br>


                            <div class="input-group">
                                <span class="input-group-btn">
                                    <label class="btn btn-primary" type="label">Marks of Criteria 1</button>
                                </span>
                                <input name="mr[]" value="<?php echo $marks; ?>" class="form-control" type="text" pattern="[1-9][0-9]+" required=""
                                    title="marks should be positive numebre">
                            </div>
                            <br>




<?php } ?>




                            <button type="submit" name="updateeval" class="btn btn-success"
                                style="margin-right: 20px;"><i class="fa fa-check-circle"></i> update Evaluation</button>


                        </form>
                    </div>
                </div>
                <!-- END INPUT GROUPS -->
            </div>
        </div>
        


</body>
</html>