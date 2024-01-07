<?php include('DBConnection.php') ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Order It Admin</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./css/animate.css">
	<link rel="stylesheet" type="text/css" href="./css/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

  </head>

  <body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('img/a.png');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					
					<img src="img/iconlogo.png" style="width: 200px; height: 150px;"><br><br>
					Login
				</span>
			<form class="login100-form validate-form p-b-33 p-t-5" method="post" action="index.php">

					<div class="wrap-input100 validate-input" data-validate = "Enter email">
						<input class="input100" type="email" name="email" placeholder="Your email">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Your password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn" type="submit" name="btnLogin">
							Login
						</button>
					</div>
					<div class="container-login100-form">	
							 <a href="forgotpassword.php" class="text-center">
                			<br>
							 	<label style="color: #000;text-align: center;"> Forgot the password? </label>
            			</a>
            		</div>
            		<br>						
						<label style="color: #c52a12;text-align: center;"> <b><?php echo $error; ?></b> </label>
				</form>

			</div>
		</div>
	</div>



	<!-- Global site tag (gtag.js) - Google Analytics -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js""></script> -->
    <script src="js/jquery.min.js""></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>