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
		<link rel="stylesheet" type="text/css" href="./css/tab_btn.css" />
		<meta  http-equiv="refresh" content="10">
	</head>
	<body>
		<div class="container body-height">
			<?php include('header.php') ?>
			<div class="row" style="background-image: url('img/fade.jpg');">
				<div class="col-sm-9">
					<br>
					<h1 style="color: #FFFFFF;  font-size: 42px; font-weight: 200; ""><br>Tables Status</h1>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12">
					
					<?php
							$query_find = "SELECT * FROM tabs WHERE isdelete=0";
						    $query_execute = mysqli_query($connection, $query_find);

						    $num=mysqli_num_rows($query_execute);
						//
						      if ($num == 0) {
						  
						            echo '<script>alert("No tables added yet");</script>';
						            echo '<br><br><h1 color="red" >No Tables</h1>';

						      }else{
						              echo ' <table align="center" width="100%" class="container">';

						      for($i=0;$i<ceil($num/3);$i++)
						      {     echo '<tr><form action="viewFullTable.php" method="post"> ';
						  
						            for($j=0;$j<3;$j++)
						            { 
						                  $row = $query_execute->fetch_assoc();
						                  if($row==0)
						                    break;
						      
						                if($row["islogin"]){
						                  if($row["isactive"])
						                    $tab_color="btn_yellow";
						                  else
						                    $tab_color="btn_green";
						                }
						                else
						                     $tab_color="btn_red";


						                  if($row["water_req"])
						                    $water_color="my_btn_green";
						                  else
						                    $water_color="my_btn_red";


						             	if($row["bowl_req"])
						                    $bowl_color="my_btn_green";
						                  else
						                    $bowl_color="my_btn_red";

						                if($row["helper_req"])
						                    $helper_color="my_btn_green";
						                  else
						                    $helper_color="my_btn_red";

						                if($row["bowl_req"])
						                    $bowl_color="my_btn_green";
						                  else
						                    $bowl_color="my_btn_red";

						                if($row["isorder"])
						                    $order_color="my_btn_green";
						                  else
						                    $order_color="my_btn_red";

						                if($row["checkout_status"])
						                    $tab_color="btn_pink";




						                echo '<th><BUTTON class="'.$tab_color.'" type="submit" height="10px" name="'.$row["table_id"].'" id="'.$row["table_id"].'"> '.$row["name"].'</BUTTON><br>
						                		
						                		  <button  class="'.$order_color.'" disabled><img src="img/order.png" width="18px" height="18px"></button>
						                		  <button class="'.$water_color.'" disabled><img src="img/water.png" width="18px" height="18px"></button>
						                		  <button  class="'.$bowl_color.'" disabled><img src="img/bowl.png" width="18px" height="18px"></button>
						                		  <button  class="'.$helper_color.'" disabled><img src="img/helper.png" width="18px" height="18px"></button>

						                </th>';
						          }
						          echo '</form></tr>';

						      }
						          echo '</table>';
						  } 
					?>
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
  <!-- <button type="'.$but_water.'" class="my_btn_red">Water</button> -->