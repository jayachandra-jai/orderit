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
td
{
    padding:0 15px 0 15px;
}
</style>
	</head>
	<body>
		<div class="container">
			<?php include_once('header.php'); ?>
			<!-- Jumbotron -->
			<div class="jumbotron" style="background-image: url('img/fade.jpg');">
				<div class="page-header">
					<div class="row">
						<div class="col-sm-9">
							<h1 style="color: #FFF">Welcome <?php echo ucfirst($_SESSION['user_name']) ?></h1>
						</div>
						<div class="col-sm-3">
							<img src="./img/item.png" id="pic" width="250px">
						</div>
					</div>
						
				</div>
			</div>
			<div class="row">
		        <marquee behavior="scroll" direction="left">
                    <table cellpadding="20" >
                        <tr>
                            <td>
                                <img src="./img/f1.jpg" width="350" height="200" alt="Natural" />
                            </td>
                            <td>
                                <img src="./img/f2.png" width="350" height="200" alt="Natural" /> 
                            </td>
                            <td>
                                <img src="./img/f3.jpg" width="350" height="200" alt="Natural" /> 
                            </td>
                             <td>
                                <img src="./img/f4.jpg" width="350" height="200" alt="Natural" /> 
                            </td>
                             <td>
                                <img src="./img/f5.jpg" width="350" height="200" alt="Natural" /> 
                            </td>
                        </tr>
                    </table>
                </marquee>			    
			</div>			
		</div>
		
			
			<!-- Content of the page -->
			

			<!--JavaSript code-->
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
			<script src="./js/jquery.min.js"></script>
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="js/bootstrap.min.js"></script>
			<script src="js/jquery.bootstrap-dropdown-hover"></script>
			<!-- <script type="text/javascript" -->
		</body>
	</html>