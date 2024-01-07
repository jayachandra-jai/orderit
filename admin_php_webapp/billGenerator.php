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
      <link rel="stylesheet" type="text/css" href="./css/tab_btn.css" />
      <style type="text/css">
         table{
            width: 50%;
            border: 2px solid black;
            padding: 10px
         }
         th,td{
            padding: 10px;
            text-align: left;
            vertical-align: middle;
            height: 25px;
         }
         @media print{
            .noprint{display: none;}
            .my_btn_bill{display: none;}
         }


         .my_btn_bill{
                   background-color: #4CAF50;
                      text-align: center;
                     font-size: 18px;
               color: #FFFFFF;
                  width:200px ;
             height: 50px;
         }

      </style>
   </head>
   <body>
      <div class="container body-height" id="print_info">
         <?php
          $order_id= $_POST['order_id'];
          $tab_id=$_POST['tab_id'];
                  $query_main = "SELECT * FROM placed_order WHERE  slno=$order_id";
                  $query_main_status = mysqli_query($connection, $query_main);  
                  $data =mysqli_fetch_assoc($query_main_status);        

         ?>
            <br><br><br>
            <h3 align="center">Bill Receipt</h3>
        
            <table border="=1" width="50%" align="center">
                 
                     <tr>
                        <th colspan="2">Customer Name</th><td colspan="4"><?php echo $data['customer_name'];?></td>
                     </tr>
                     <tr>
                        <th >Date</th>  <td ><?php echo date('d/M/Y') ;?></td>
                        <th >Table Id</th>  <td ><?php echo $data['table_id']; ?></td>
                        <th >Receipt No</th><td ><?php echo $data['slno']; ?></td>
                     </tr>     
                  
            </table>   
                          
            <table border="=1" width="50%" align="center">
                  <tr>
                        <th>S.NO</th><th>Item Name</th><th>Price</th><th>Quantity</th><th>Ammount</th>
                  </tr>';               
                  <?php 
                    $sum=0;
                  $query_bill = "SELECT * FROM placed_order_items WHERE  order_id=$order_id";


                  $query_bill_status = mysqli_query($connection, $query_bill);
                    if(mysqli_num_rows($query_bill_status) > 0){

                      $i=1;
                      $sum=0;
                      while($row =mysqli_fetch_assoc($query_bill_status)) {
                        $num=$row['quantity'];
                        $id=$row['food_item_id'];

                        $query_item= "SELECT * FROM food_item WHERE  slno=$id";
                        $query_result = mysqli_query($connection, $query_item);
                        if(mysqli_num_rows($query_result) > 0){

                        $rows =mysqli_fetch_assoc($query_result);
                        $total=($rows['price']*$num);



                                  echo "<tr><td>".$i ."</td><td>"
                                      .$rows['food_title'] ."</td><td>"
                                      .$rows['price'] ."</td><td>"
                                      .$num ."</td><td>"
                                      .$total ."</td></tr>";
                           $i++;
                            $sum=$sum+$total;
                        
                         }

                      }
                       echo "<tr><th colspan='4'>Total Bill(Including GST)</th><td >".$sum."</td></tr>";
                       echo "<tr><th colspan='4'>Bill Passed By </th><td >".$_SESSION['user_name']."</td></tr>";

                    }
                    else{
                      echo '<script> alert("Not Ordered any Thing") </script>';
                    }


         ?>

         </table>
         <br><br>
        <center><input type="button" class="noprint" value="Print" onclick="window.print()">
            <br><br>
            <form method="POST" action="orders.php">
                         <input type='hidden' name='tab_id' value='<?php echo "$tab_id";?>'/> 
                        <input type='hidden' name='order_id' value='<?php echo "$order_id";?>'/> 
                          <input type='hidden' name='tot_amount' value='<?php echo "$sum";?>'/> 
                  <button type="submit" class="my_btn_bill" id="noprint" name='pay_bill' >Payment Done</button>
                </form>

        </center>
      
   </div>

               

     
   
   
   <!--JavaSript code-->
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js""></script>
   <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>