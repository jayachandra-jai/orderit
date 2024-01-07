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
      <title>Order It</title>
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
       <style type="text/css">
#datepicker{width:180px; margin: 0 20px 20px 20px;}
#datepicker > span:hover{cursor: pointer;}
         @media print{
            .noprint{display: none;}
            .my_btn_bill{display: none;}
         }
      </style>

       <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
   </head>
   <body>
      <div class="container body-height">
         <?php include_once('header.php'); ?>
         <!-- Jumbotron -->
         <div class="jumbotron" style="background-image: url('img/fade.jpg');">
            <div class="page-header">
               <div class="row">
                  <div class="col-sm-9">
                     <h1 style="color: #FFFFFF; " >Sales Report</h1>
                  </div>
               </div>
            </div>
         </div>
         <!-- Content of the page -->
          <div class="noprint">
            
    <div class="row">
            <div class="col-xs-12">
               <!--Registration Form-->
               <form method="POST">
                  <div class="form-group">
                        <label for="from_day">Select From Date: </label>
                           <div id="day_from" class="input-group date" data-date-format="dd-MM-yyyy">
                               <input class="form-control" type="text" readonly id="from_day" name="from_day"/>
                               <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                           </div>
                           <br>
                  </div>
                        <div class="form-group">
                              <label for="day_to">Select To Date: </label>
                                 <div id="day_to" class="input-group date" data-date-format="dd-MM-yyyy">
                                     <input class="form-control" type="text" readonly id="to_day" name="to_day"/>
                                     <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                 </div>
                                 <br>
                        </div>
                  
                  <div class="form-group">
                                 <input type="submit" name="btnSale" class="btn btn-primary">
                  </div>

               </form>
            </div>
          </div>
       </div>
         <div class="row">
          <?php ?>
            <div class="col-xs-12">
              
            <?php
            $sum=0;
             $count = 1;
               if(isset($_POST['btnSale'])) {
                      $timestamp = strtotime($_POST['from_day']);
                      $FromDate = date('y-m-d', $timestamp); 
                      $timestamp = strtotime($_POST['to_day']);
                      $ToDate = date('y-m-d', $timestamp); 
                        $query_order = "SELECT * FROM placed_order WHERE  DATE(bill_date) BETWEEN '$FromDate' AND '$ToDate'";
                        $query_order_status = mysqli_query($connection, $query_order);
            
                if(!$query_order_status ){
                      echo '<script> alert("Db error") </script>';
                }
                else{
                  echo "<center><h3>From ".$_POST['from_day']." to ".$_POST['to_day']."</h3></center>";

                  echo '<div class="table-responsive">
                  <table class="table table-hover">
                     <thead>
                        <th>S.no</th><th>Date</th><th>Customer name</th><th>Bill Passesd</th><th>Amount</th>
                     </thead>
                     <tbody>';
                           $count = 1;
                           $sum=0;
                           while($row =mysqli_fetch_array($query_order_status)) {
                              echo '<tr>
                                 <td>'. $count++ . '
                                 <td>'. $row['bill_date'] . '
                                 <td>'. $row['customer_name'] . '
                                 <td>'. $row['bill_passed_by'] . '
                                 <td>' . $row['amount'] .'<td>';    
                                 $sum=$sum+ $row['amount'] ;    
                           }
                        
                     }
                  
                  echo '
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="row"><center><h2>';
         echo 'Total Orders : '.($count-1);
         echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Total Sales : Rs.'.$sum.'/-';
         echo '  </h2> <br><input type="button" class="noprint" value="Print" onclick="window.print()"></center> 
         </div>';
       }
                     ?>

       
    

         
         <!--Footer Area-->
         <?php include('footer.php');?>
         
         <!--JavaSript code-->
         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js""></script>
         <!-- Include all compiled plugins (below), or include individual files as needed -->
         <script src="js/bootstrap.min.js"></script>
<script type="text/javascript">

   $(function () {
  $("#day_from").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());
});

$(function () {
  $("#day_to").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());
});
</script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

      </body>
   </html>