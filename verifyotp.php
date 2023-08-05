<html>
    <head>
    <title>CBP</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style>
 .form-gap {
    padding-top: 70px;
}

    </style>
    </head>
    <body>
        <?php
        if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
        if(isset($_SESSION["invalidotp"]))
        {
            if($_SESSION["invalidotp"]=="yes")
            {
                 $_SESSION["invalidotp"]="no";
                 ?>
        <script>alert("invalid otp");</script>
        
        <?php
            }
           
        }
        
        ?>
        <div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-unlock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                      <form  action="php/verifyotp.php" role="form"  class="form" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="otp" placeholder="Enter OTP" class="form-control"  type="text" required >
                        </div>
                      </div>
                          <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="password" placeholder="password" class="form-control"  type="password" required pattern=".{8,}" title="password should be greater than 8 digit">
                        </div>
                      </div>
                      <div class="form-group">
                        <input  name="reset" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                        </br>
                        <a href="/sem6/project6sem/login.php">Back TO Login</a>
                      </div>
                      
                      
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>

</body>
</html>