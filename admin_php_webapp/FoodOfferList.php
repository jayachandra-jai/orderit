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
                     <h1 style="color: #FFFFFF">Food Offers List</h1>
                  </div>
               </div>
            </div>
         </div>
         <!-- Content of the page -->
         <div class="row">
            <div class="col-xs-12">
               <div class="table-responsive">
                  <table class="table table-hover">
                     <thead>
                        <th>Image</th><th>Title</th><th>Desc</th><th>Price</th><th>Views</th><th>Rating</th><th>Type</th><th>Category</th><th>IsAvailable</th><th>Action</th>
                     </thead>
                     <tbody>
                        <?php
                           $count = 0;
                           $result = getFoodOffers();
                           while($row =mysqli_fetch_array($result)) {
                              echo '<tr><td><img src="uploads/'.$row['food_image'].'" width=80px/>
                                 <td>'. $row['food_title'] . '
                                 <td>'. $row['description'] . '
                                 <td>'. $row['price'] . '
                                 <td>'. $row['views_no'] . '
                                 <td>'. $row['rating'] . '
                                 <td>' . $row['food_type'] .'
                                 <td>' . $row['food_category'] .'<td>';
                                 if($row['isavailable'] == 1) 
                                    echo 'Yes';
                                 else 
                                    echo 'No';
                                 echo '<td>
                                          <form action="FoodItemModify.php" method=post>
                                    <input type="hidden" name="item_id" value="'.$row['slno'].'">
                                 <input type="submit" class="btn btn-primary" name="modifyItem" value="Update">
                                 </form></td></tr>';
                           }
                        ?>

                     </tbody>
                  </table>
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
   </body>
</html>