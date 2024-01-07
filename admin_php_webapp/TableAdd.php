<?php include('DBConnection.php') ?>
<?php if(!isset($_SESSION['email'])) :?>
<?php header("location: index.php"); ?>
<?php elseif($_SESSION['type'] == "User") :?>
<?php header("location: orders.php"); ?>
<?php endif ?>
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
      <div class="container body-height">
         <?php include_once('header.php'); ?>
         <!-- Jumbotron -->
         <div class="jumbotron" style="background-image: url('img/fade.jpg');">
            <div class="page-header">
               <div class="row">
                  <div class="col-sm-9">
                     <h1 style="color: #FFFFFF; " >Add a new Table</h1>
                  </div>
               </div>
            </div>
         </div>
         <!-- Content of the page -->
         <div class="row">
            <div class="col-xs-12">
               <!--Registration Form-->
               <form action="TableAdd.php" method="POST">
                  <div class="form-group">
                     <label for="tableName">Table Name</label>
                     <input id="tableName" name="tableName" type="text" class="form-control" required>
                  </div>
                  
                  <div class="form-group">
                     <label for="tableID">Table ID</label>
                     <input id="tableID" name="tableID" type="text" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" name="password" id="password" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label for="rePassword">Re-Password</label>
                     <input type="password" name="rePassword" id="rePassword" class="form-control" required>
                  </div>
                  <input type="submit" name="btnAddTable" class="btn btn-primary">
               </form>
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