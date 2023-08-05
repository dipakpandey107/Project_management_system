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
        include 'facultydash.php';
        ?>

        <!-- INPUT GROUPS -->
        <div class="panel" id="editframe">
           

            <div class="panel-heading">
                <h3 class="panel-title">Edit Log</h3>
            </div>
            <div class="panel-body">
                <form method="post" action="php/addlog.php">
                <div class="input-group">
                    <span class="input-group-btn">
                        <label class="btn btn-primary" type="label">Discussion</button>
                    </span> 
                    <input class="form-control"  name="discussion" value="<?php echo $_SESSION["discussion"]; ?>"  pattern="[a-zA-Z ]{5,}" required="" title="minimum 5 character needed">
                </div>
                <br>

                <div class="input-group">
                    <span class="input-group-btn">
                        <label class="btn btn-primary" type="label">Instruction</button>
                    </span> 
                    <input class="form-control"  name="instruction" value="<?php echo $_SESSION["instruction"]; ?>" >
                </div>
                <br>

                <div class="input-group">
                    <span class="input-group-btn">
                        <label class="btn btn-primary" type="label">Remark</button>
                    </span> 
                    <input class="form-control" name="remark" value="<?php echo $_SESSION["remark"]; ?>" >
                    </div>
                    <br>

                   

                 
                <br>

                <button type="submit" name="editlogbtn" class="btn btn-success" style="margin-right: 20px;"><i class="fa fa-check-circle"></i> Save Edit</button>

                <br>
                </form>
            </div>
        </div>
        <!-- END INPUT GROUPS -->
    </div>

</body>
</html>