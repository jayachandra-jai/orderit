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
                     <h1 style="color: #FFFFFF">List Table</h1>
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
                        <th>Sl No</th><th>Name</th><th>Table Id</th><th>Password</th><th>Is Active</th><th>Is Login</th><th>checkout_status</th><th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $i = 1;
                     $result = getTabs();
                     while($row =mysqli_fetch_assoc($result)) {
                     echo
                     "<tr>
                        <td>".$i++."</td>
                        <td>{$row['name']}</td>
                        <td>{$row['table_id']}</td>
                        <td>{$row['password']}</td>
                        <td>";
                        if($row['isactive'] == 1) echo 'Yes'; else echo 'No' . "</td><td>"
                        ;
                        if ($row['islogin'] == 1) echo 'Yes'; else echo 'No' ."</td><td>";
                        if ($row['checkout_status'] == 1) echo 'Pending'; else echo 'Done' ."</td>
                        ";
                        echo '<td>
                                          <form action="TableModify.php" method=post>
                                    <input type="hidden" name="tab_id" value="'.$row['table_id'].'">
                                 <input type="submit" class="btn btn-primary" name="modifyTable" value="Update">
                                 </form></td></tr>';
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
            </body>
         </html>