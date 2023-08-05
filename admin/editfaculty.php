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
                <h3 class="panel-title">Edit Faculty</h3>
            </div>
            <div class="panel-body">
                <form method="post" action="php/updatefaculty.php">
                <div class="input-group">
                    <span class="input-group-btn">
                        <label class="btn btn-primary" type="label">Name</button>
                    </span> 
                    <input class="form-control"  name="name" value="<?php echo $_SESSION["facultyname"]; ?>"  pattern="[a-zA-Z ]+" required="" title="name should not contain number or special characters">
                </div>
                <br>

                <div class="input-group">
                    <span class="input-group-btn">
                        <label class="btn btn-primary" type="label">Email</button>
                    </span> 
                    <input class="form-control" type="text" name="email" value="<?php echo $_SESSION["facultyemail"]; ?>" required pattern="[a-zA-Z.][a-zA-Z0-9.]+@(gmail.com|cbpcc@gmail.com)" title="invalid email">
                </div>
                <br>

                <div class="input-group">
                    <span class="input-group-btn">
                        <label class="btn btn-primary" type="label">Designation</button>
                    </span> 
                    <select class="form-control" name="designation">
                        <option selected="" value="<?php echo $_SESSION["facultydesignation"]; ?>"><?php echo $_SESSION["facultydesignation"]; ?></option>
                       
                        <option  value="<?php if($_SESSION['facultydesignation']=='Assistant Professor'){echo 'Associate Professor';}else{echo 'Assistant Professor';} ?>"><?php if($_SESSION["facultydesignation"]=="Assistant Professor"){echo 'Associate Professor';}else{echo 'Assistant Professor';} ?></option>
                      
                        </select>
                    </div>
                    <br>
                    <div class="input-group">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary" type="label">Program</button>
                                    </span> 
                                    <select class="form-control" name="program">
                                    <option selected value="<?php echo $_SESSION["program"]; ?>"><?php echo $_SESSION["program"]; ?></option>
                                        <?php
                                        include 'php/connection.php';
                                        if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
                                        $p=$_SESSION["program"];
                                        $query = "select distinct program from course where status='active' and program!='$p'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row["program"]; ?>"><?php echo $row["program"]; ?></option>

                                        <?php }
                                        ?>
                                    </select>
                                </div>

                    <br>

                    <div class="input-group">
                        <span class="input-group-btn">
                            <label class="btn btn-primary" type="label">contact</button>
                        </span> 
                        <input class="form-control" name="contact" type="text" value="<?php echo $_SESSION["facultycontact"]; ?>" required pattern="[9876][0-9]{9}" title="invalid contact number">
                    </div>
                    <br>

                 
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