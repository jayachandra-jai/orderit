<?php include('DBConnection.php') ?>
<?php if(!isset($_SESSION['email'])) :?>
<?php header("location: index.php"); ?>
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
                     <h1 style="color: #FFFFFF">Modify User : <?php echo $_SESSION['user_name'] ?></h1>
                  </div>
               </div>
            </div>
         </div>
         <!-- Content of the page -->

         <div class="row">
            <div class="col-sm-9">
               <table class="container"><tr><td align="left"><h2>Login Id / Email:<label style="font-weight: normal; font-size: 25px; opacity: 0.8"><?php echo $_SESSION['email'] ?></label></h2></td>
                  <td style="text-align: right; padding-right: 25px"><h2>User Type:<label style="font-weight: normal; font-size: 25px; opacity: 0.8"><?php echo $_SESSION['type'] ?></label></h2></td>
               </tr>
               </table>
            </div>
         </div>
         <div class="row">
            <center>
                     <form method="POST" action="changepassword.php">
                        <input type="hidden" name="email" id="email" value="<?php echo $_SESSION['email'] ?>">
                        <input type="submit" name="changePass" id="changePass" value="Change Password" class="btn btn-primary">
               </form>
            </center>
         </div>
         <div class="row">
            <div class="col-xs-12">
               <!--Registration Form-->
               <form   method="POST">
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input id="name" name="name" type="text" value="<?php echo $_SESSION['user_name'] ?>" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" title="Invalid Name only Letters, Spaces & Dots are Allowed" class="form-control" required>
                  </div>
                  
                  <div class="form-group">
                     <label for="mobile">Mobile</label>
                     <input id="mobile" name="mobile" type="mobile" value="<?php echo $_SESSION['mobile'] ?>"  pattern="[6-9]{1}[0-9]{9}" title="Invalid Mobile Number" class="form-control" required>
                  </div>

                  <input type="submit" name="updateUser" id="updateUser" value="Modify" class="btn btn-primary">
               </form>
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
      </body>
   </html>