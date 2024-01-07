<?php include('DBConnection.php') ?>


<?php 


      $order_id='';

    $result =getTabs(); 
    while($row =mysqli_fetch_assoc($result)) {
        if(isset($_POST[$row['table_id']])){
                    $tab_id=$row['table_id'];
                    $tab_name=$row['name'];
                    $isactive=$row['isactive'];
                    $islogin=$row['islogin'];
                    $checkout_status=$row['checkout_status'];
                    $water_req=$row['water_req'];
                    $helper_req=$row['helper_req'];
                    $bowl_req=$row['bowl_req'];
                    $isorder=$row['isorder'];


                        $query_ordered = "SELECT slno FROM placed_order WHERE table_id = '$tab_id' AND isActive=1 ";
                        $query_ordered_status = mysqli_query($connection, $query_ordered);

                        if(mysqli_num_rows($query_ordered_status) == 1){
                          $rows =mysqli_fetch_assoc($query_ordered_status);
                          $order_id=$rows['slno'];
                        }
                        else{
                          $order_id=-999;
                        }

                            if($row["islogin"]){
                              if($row["isactive"])
                                $tab_color="btn btn-warning btn-block";
                              else
                                $tab_color="btn btn-success btn-block";
                            }
                            else
                                 $tab_color="btn btn-danger btn-block";


                              if($row["water_req"])
                                $water_color="btn btn-success btn-block";
                              else
                                $water_color="btn btn-danger btn-block";


                          if($row["bowl_req"])
                                $bowl_color="btn btn-success btn-block";
                              else
                                $bowl_color="btn btn-danger btn-block";

                            if($row["helper_req"])
                                $helper_color="btn btn-success btn-block";
                              else
                                $helper_color="btn btn-danger btn-block";

                            if($row["bowl_req"])
                                $bowl_color="btn btn-success btn-block";
                              else
                                $bowl_color="btn btn-danger btn-block";

                              if($row["isorder"])
                                $order_color="btn btn-success btn-block";
                              else
                                $order_color="btn btn-danger btn-block";

                            if($row["checkout_status"])
                                $btn_type="btn btn-primary btn-block";
                            else

                                $btn_type="my_btn_hidden";
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
      <link rel="stylesheet" type="text/css" href="./css/tab_btn.css" />
      <style type="text/css">
        
         .my_btn_back{
          margin-top: 20px;
                   background-color: #f4511e;
                      text-align: center;
                      border-radius: 10px;
                     font-size: 18px;
               color: #FFFFFF;
                  width:200px ;
             height: 50px;
         }
      </style>
   </head>
   <body>

      <div class="container body-height">
         <?php include('header.php') ?>
         <div class="row" style="background-image: url('img/fade.jpg');">
            <div class="col-sm-9">
               <h1 style="color: #FFFFFF;  font-size: 54px; font-weight: 200; ""><br><?php echo"".$tab_name;?> Status</h1>
            </div>
         </div>
         <div>
           <a href="orders.php"><input type="button" name="back" value="Back to Orders" class="my_btn_back"></a>
         </div>
         
         <div class="row">
            <div class="container-fluid mt-10" style="border: 2px solid;margin-top: 15px">

        <div class="row" style="margin-top:15px">
            <div class="col-md-12 text-center"><button type="button" class="<?php echo $tab_color ?>"><?php echo"".$tab_name; ?></button></div>

        </div>




        <div class="row" style="margin: 20px">
            <div class="col-sm-3" style="margin: 0px"><button type="button" class="<?php echo $order_color ?>"><img src="img/order.png" width="18px" height="18px"></button></div>
            <div class="col-sm-3" style="margin: 0px"><button type="button" class="<?php echo $water_color ?>"><img src="img/water.png" width="18px" height="18px"></button></div>
            <div class="col-sm-3" style="margin: 0px"><button type="button" class="<?php echo $bowl_color ?>"><img src="img/bowl.png" width="18px" height="18px"></button></div>
            <div class="col-sm-3" style="margin: "><button type="button" class="<?php echo $helper_color ?>"><img src="img/helper.png" width="18px" height="18px"></button></div>
        </div>

        <div class="row">
            <div class="col-md-12">
              <button type="button" class="btn btn-primary btn-block">Items Ordered</button>
               <table class="table table-hover">
                     <thead>
                        <th>S.NO</th><th>Title</th><th>Price</th><th>Type</th><th>Category</th><th>Quantity</th><th>Process</th>
                     </thead>
                     <tbody>
                       <?php
                           
                           
                            $query_order = "SELECT * FROM placed_order_items WHERE  order_id='$order_id'";

                            $query_result = mysqli_query($connection, $query_order);

                            if(mysqli_num_rows($query_result) >0){
                              $i=1;
                                while($rows =mysqli_fetch_array($query_result)) {

                                   $query_item = "SELECT * FROM food_item WHERE  slno=".$rows['food_item_id']."";

                                    $result  = mysqli_query($connection, $query_item);
                                         
                                        
                                          $row =mysqli_fetch_array($result);
                                              echo '<tr>
                                                <td>'.$i.'
                                                 <td>'.$row['food_title'].'
                                                 <td>'.$row['price'] .'
                                                 <td>' .$row['food_type'] .'
                                                 <td>' .$row['food_category'] .'
                                                 <td>'.$rows['quantity'] .' <td>';
                                                 if($rows['process'] == 1) 
                                                       echo 'Done';
                                                  else 
                                                       echo 'Not Done';
                                              echo'</td></tr>';
                                           
                                           $i++;


                                }



                            }

                        ?>
                      </tbody>
                  </table>

            </div>
        </div>

        <div class="row" style="margin: 25px">
             <div class="col-sm-3" ><form method="POST" action="orders.php">
                        <input type='hidden' name='tab_id' value='<?php echo "$tab_id";?>'/> 
                        <input type='hidden' name='order_id' value='<?php echo "$order_id";?>'/> 
                        <button type="submit" name="isOrderSent" class="btn btn-info btn-block">Order sent</button></form>
            </div>

            <div class="col-sm-3" ><form method="POST" action="orders.php"><input type='hidden' name='tab_id' value='<?php echo "$tab_id";?>'/> <button type="submit" name="iswaterSent" class="btn btn-info btn-block">Water sent</button></form></div>
            
            <div class="col-sm-3" ><form method="POST" action="orders.php"><input type='hidden' name='tab_id' value='<?php echo "$tab_id";?>'/> <button type="submit" name="isbowlSent" class="btn btn-info btn-block">FingerBowl sent</button></form></div>
          
            <div class="col-sm-3" ><form method="POST" action="orders.php"><input type='hidden' name='tab_id' value='<?php echo "$tab_id";?>'/> <button type="submit" name="ishelperSent" class="btn btn-info btn-block">Helper sent</button></form></div>



        </div>

        <div class="row" style="margin-bottom: 30px">
            <div class="col-md-12 text-center">
                <form method="POST" action="billGenerator.php">
                         <input type='hidden' name='tab_id' value='<?php echo "$tab_id";?>'/> 
                        <input type='hidden' name='order_id' value='<?php echo "$order_id";?>'/> 
                  <button type="submit" class="<?php echo $btn_type ?>" name='send_bill' >Send Bill</button>
                </form>

            </div>
        </div>

    </div>
            <div class="col-xs-12">

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