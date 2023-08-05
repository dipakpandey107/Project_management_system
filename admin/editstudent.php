<html>
    <head>
        <title>Student dashBoard | Admin</title>
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
        include 'admindash.php';
        ?>

        <!-- INPUT GROUPS -->
        <div class="panel" id="editframe">
           

            <div class="panel-heading">
                <h3 class="panel-title">Edit Student</h3>
            </div>
            <div class="panel-body">
                <form method="post" action="php/updatestudent.php">
                <div class="input-group">
                    <span class="input-group-btn">
                        <label class="btn btn-primary" type="label">Enrollment</button>
                    </span> 
                    <input class="form-control" readonly="" name="enrollment" value="<?php echo $_SESSION["studentenrollment"]; ?>" placeholder="Not Editable" pattern="[0-9]{10,}" title="invalid Enrollment Number">
                </div>
                <br>

                <div class="input-group">
                    <span class="input-group-btn">
                        <label class="btn btn-primary" type="label">Name</button>
                    </span> 
                    <input class="form-control" type="text" name="name" value="<?php echo $_SESSION["studentname"]; ?>" placeholder="Not Editable" pattern="[a-zA-Z ]+" title="name should not contain number or characters" required="">
                </div>
                <br>

                <div class="input-group">
                    <span class="input-group-btn">
                        <label class="btn btn-primary" type="label">Course-ID</button>
                    </span> 
                    <select class="form-control" name="courseid">
                        <option selected value="<?php echo $_SESSION["scourseid"]; ?>"><?php echo $_SESSION["studentcourse"]; ?></option>
                        <?php
                        include 'php/connection.php';;
                        $course=$_SESSION["studentcourse"];
                        $query = "select * from course where coursename!='$course' and status='active'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                        <option  value="<?php echo $row["course_id"]; ?>"><?php echo $row["coursename"]; ?></option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-btn">
                            <label class="btn btn-primary" type="label">Email-ID</button>
                        </span> 
                        <input class="form-control" name="email" type="email" value="<?php echo $_SESSION["studentemail"]; ?>" placeholder="Not Editable" pattern=".+@gmail.com" title="invalid Email" required="">
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-btn">
                            <label class="btn btn-primary" type="label">Contact</button>
                        </span> 
                        <input class="form-control" name="contact" type="text" value="<?php echo $_SESSION["studentcontact"]; ?>" pattern="[9876][0-9]{9}" title="invalid Contact Number" required="" >
                </div>
                <br>

                <button type="submit" name="updatebtn" class="btn btn-success" style="margin-right: 20px;"><i class="fa fa-check-circle"></i> Save Edit</button>

                <br>
                </form>
            </div>
        </div>
        <!-- END INPUT GROUPS -->
    </div>

</body>
</html>