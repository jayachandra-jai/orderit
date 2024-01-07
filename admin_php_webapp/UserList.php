<?php include('DBConnection.php') ?>
<?php if(!isset($_SESSION['email'])) :?>
<?php header("location: index.php"); ?>
<?php elseif($_SESSION['type'] == "User") :?>
<?php header("location: user.php"); ?>
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
                     <h1 style="color: #FFFFFF">Users List</h1>
                  </div>
               </div>
            </div>
         </div>
         <!-- Content of the page -->
         <div class="row">
            <div class="col-xs-12">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th>Sl No</th><th>Name</th><th>Mobile</th><th>Email</th><th>Password</th><th>Create Date</th><th>User Type</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $i = 1;
                     $result = getUsers();
                     while($row =mysqli_fetch_assoc($result)) {
                     echo
                     "
                     <tr>
                        <td>".$i++."</td>
                        <td>{$row['user_name']}</td>
                        <td>{$row['mobile']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['password']}</td>
                        <td>{$row['create_date']}</td>
                        <td>{$row['user_type']}</td>
                     
                   
                                 </tr>";
                        }
                        ?>
                  </tbody>
               </table>
            </div>
         </div>
         
         <!--Footer Area-->
         <?php include('footer.php');?>
         
         <!--JavaSript code-->
         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js""></script>
         <!-- Include all compiled plugins (below), or include individual files as needed -->
         <script src="js/bootstrap.min.js"></script>
         <a href="" style="text-decoration-color: #000000"></a>
      </body>
   </html>