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
      <?php
            $tab_id=$_POST['tab_id'];
                $query_find = "SELECT * FROM tabs WHERE table_id='$tab_id'";
               $query_result = mysqli_query($connection, $query_find);
                  $row =mysqli_fetch_array($query_result) ;                        
      ?>
      <div class="container body-height">
         <?php include_once('header.php'); ?>
         <!-- Jumbotron -->
         <div class="jumbotron" style="background-image: url('img/fade.jpg');">
            <div class="page-header">
               <div class="row">
                  <div class="col-sm-9">
                     <h1 style="color: #FFFFFF">Modify Table </h1>
                  </div>
               </div>
            </div>
         </div>
         <!-- Content of the page -->
         <div class="row">
            <div class="col-xs-12">
               <!--Registration Form-->
               <form action="TableList.php" method="POST">
                  <div class="form-group">
                     <label for="tableName">Table Name</label>
                     <input id="tableName" name="tableName" type="text" class="form-control" value="<?php echo $row['name']?>" required>
                  </div>
                  <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" name="password" id="password" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label for="rePassword">Re-Password</label>
                     <input type="password" name="rePassword" id="rePassword" class="form-control" required>
                  </div>
    
                 
                  <input type="hidden" value="<?php echo $tab_id; ?>" name="tab_id">
                  <input type="submit" name="btnUpdateTable" value="Update" class="btn btn-primary">
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
      <script type="text/javascript">
      function readURL(input) {
      if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
      $('#logo').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
      }
      }

      </script>

 <script type="text/javascript">
      
      var itemsList = new Array(2);
      itemsList["Veg"] = ["Soups","Biryani Items","Starters","Main Courses","Staples","Salads","Chinese Food","Indian Breads","Sweet and Deserts","Offers"];
      itemsList["Non-Veg"] = ["Soups","Biryani Items","Starters","Main Courses","Staples","Restaurant Specials","Chinese Food","Tandoor se","Offers"];
    
      function itemChange(selectObj) {
      // get the index of the selected option
      var idx = selectObj.selectedIndex;
      // get the value of the selected option
      var which = selectObj.options[idx].value;
      // use the selected option value to retrieve the list of items from the itemLists array
      cList = itemsList[which];
      // get the country select element via its known id
      var cSelect = document.getElementById("food_category");
      // remove the current options from the country select
      var len=cSelect.options.length;
      while (cSelect.options.length > 0) {
      cSelect.remove(0);
      }
      var newOption;
      // create new options
      for (var i=0; i<cList.length; i++) {
      newOption = document.createElement("option");
      newOption.value = cList[i];  // assumes option string and value are the same
      newOption.text=cList[i];
      // add the new option
      try {
      cSelect.add(newOption);  // this will fail in DOM browsers but is needed for IE
      }
      catch (e) {
      cSelect.appendChild(newOption);
      }
      }
      }
   
      </script>


   </body>
</html>