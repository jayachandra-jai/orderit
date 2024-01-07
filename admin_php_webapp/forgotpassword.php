<?php include('DBConnection.php') ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>E-Menu</title>
      <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="styles.css">
      <link rel="stylesheet" type="text/css" href="./css/animate.css">
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #00CED1; color: #FFFFFF">
      <div class="navbar-header" style="background-color: #00CED1;">
        <a href="home.php">
          <span class="h3" style="position: relative; top: 11px; left: 10px; margin-right: 10px;color: #FFFFFF">Order It Web Pannel</span>
        </a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynav">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
     </div>
  </nav>
      </div>
         <div class="container" style="margin: 100px" >
            <div class="row">
               <div class="col-md-4 col-md-offset-4">
                     <div class="panel panel-default">
                       <div class="panel-body">
                         <div class="text-center">
                           <h3><i class="fa fa-lock fa-4x"></i></h3>
                           <h2 class="text-center">Forgot Password?</h2>
                           <p>You can reset your password here. Please Enter Ur Registered Email Address</p>
                           <div class="panel-body">
             
                             <form id="register-form" role="form" autocomplete="off" class="form" method="post">
             
                               <div class="form-group">
                                 <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                   <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                 </div>
                               </div>
                               <div class="form-group">
                                 <input name="forgotpassword" id="forgotpassword" class="btn btn-lg btn-block" value="Reset Password" type="submit" style="background: #00CED1; color: #FFFFFF">
                               </div>
                               
                               <a href="http://orderit.000webhostapp.com/"><input name="forgotpassword" id="forgotpassword" class="btn btn-sm btn-danger " value="Back to Login" type="button"></a>
                             </form>
             
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
            </div>
         </div>
         
         <!--Footer Area-->
         <?php include('footer.php');?>
         
         <!--JavaSript code-->
         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js""></script>
         <!-- Include all compiled plugins (below), or include individual files as needed -->
         <script src="js/bootstrap.min.js"></script>

         <script>
            var password = document.getElementById("password"), confirm_password = document.getElementById("rePassword");

      function validatePassword(){
               if(password.value != confirm_password.value) {
                     confirm_password.setCustomValidity("The password and its confirm are not the same");
            } else {
                     confirm_password.setCustomValidity('');
            }
      }

password.onchange = validatePassword;
rePassword.onkeyup = validatePassword;</script>
      </body>
   </html>
   