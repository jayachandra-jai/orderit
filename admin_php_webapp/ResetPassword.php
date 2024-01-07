<?php include('DBConnection.php') ?>
<?php
                  $mykey=$_GET["key"];
                   $query_find = "SELECT * FROM reset WHERE my_key = '$mykey'";
              $query_find_status = mysqli_query($connection, $query_find);
              if(mysqli_num_rows($query_find_status) == 1) {
                       $row = $query_find_status->fetch_assoc();
                                           $email=$row['email'];
                        date_default_timezone_set('Asia/Kolkata');

                     $from_time = strtotime($row['time_value']);
                        $date = date('Y-m-d H:i:s');
                        $to_time = strtotime($date);
                        $minutes   = round(abs($to_time - $from_time) / 60);
                       if($minutes > 10){
                              header('Location: expired.php');
                                echo '<script>window.location.href ="http://orderit.000webhostapp.com/expired.php";</script>';  

                       }
                       
              }
        ?>
        <?php

                if(isset($_POST['resetPassword'])) {
                   $pass = mysqli_real_escape_string($connection, $_POST['rePassword']);
                            $query_insert =   "UPDATE users SET password='$pass' WHERE  email='$email'";

                           $query_status = mysqli_query($connection, $query_insert);

                           if($query_status) {

                            $query_delete =   "DELETE from reset  WHERE  my_key='$mykey'";
                             $my_query_status = mysqli_query($connection, $query_delete);
                               echo '<script>window.location.href ="http://orderit.000webhostapp.com/index.php";</script>';  
                
                           } else {
                                       $msg = "Error...! Please try again.";
                                   echo '<script>alert("'.$msg.'");</script>';  
                                 }
                        
                            
                     }

         ?>
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
         

          <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #00CED1; color: #FFFFFF">
      <div class="navbar-header" style="background-color: #00CED1;">
        <a href="home.php">
          <span class="h3" style="position: relative; top: 11px; left: 10px; margin-right: 10px;color: #FFFFFF">Order It Web Pannel</span>
        </a>
     </div>
  </nav>
         <!-- Content of the page -->

         <div class="row" style="margin: 50px 0 0 0;">
         </div>
         <div class="row">
            <div class="col-10">
               <!--Registration Form-->
               <div class="card border-primary mb-3" style="max-width: 30rem; margin: 0 auto; float: none;margin-bottom: 10px">
                    <div class="card-header text-center" ><h4>Reset Password</h4></div>
                    <div class="card-body text-secondary">

               <form method="POST">
                  
                  <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" name="password" id="password" class="form-control" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Invalid Password It must have at least one UpperCase, LowerCase, Number/SpecialChar and min 8 Chars" required>
                  </div>
                  <div class="form-group">
                     <label for="rePassword">Retype-Password</label>
                     <input type="password" name="rePassword" id="rePassword" class="form-control" required
                      data-fv-identical="true"
                data-fv-identical-field="password"
                data-fv-identical-message="The password and its confirm are not the same">
                  </div>
                  <input type="submit" name="resetPassword" id="resetPassword" value="Reset" class="btn btn-success center-block">
               </form>
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
            rePassword.onkeyup = validatePassword;
         </script>
      </body>
   </html>
   