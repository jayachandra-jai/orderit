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
                     <h1 style="color: #FFFFFF">Add a new Food / Offer</h1>
                  </div>
               </div>
            </div>
         </div>
         <!-- Content of the page -->
         <div class="row">
            <div class="col-xs-12">
               <!--Registration Form-->
               <form action="FoodOfferAdd.php" enctype="multipart/form-data" method="POST">
                  <div class="form-group">
                     <label for="food_title">Food/Offer Title</label>
                     <input required id="food_title" name="food_title" type="text" class="form-control">
                  </div>
                  
                  <div class="form-group">
                     <label for="description">Description</label>
                     <textarea rows="3" id="description" name="description" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                     <label for="price">Price</label>
                     <input required id="price" type="text" name="price" class="form-control">
                  </div>
                  <div class="form-group">
                     <label for="food_type">Food Type</label>
                     <select name="food_type" id="food_type" class="form-control" onchange="itemChange(this);">
                        <option value="Veg">Veg</option>
                        <option value="Non-Veg">Non-Veg</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="food_category">Food Category</label>
                     <select name="food_category" id="food_category" class="form-control">
                        <option value="Soups">Soups</option>
                        <option value="Biryani Items">Biryani Items</option>
                        <option value="Starters">Starters</option>
                        <option value="Main Courses">Main Courses</option>
                        <option value="Staples">Staples</option>
                        <option value="Salads">Salads</option>
                        <option value="Chinese Food">Chinese Food</option>
                        <option value="Indian Breads">Indian Breads</option>
                        <option value="Sweet and Deserts">Sweet and Deserts</option>
                        <option value="Offers">Offers</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="photo">Photo</label>
                     <div class="input-group">
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-picture"></span>
                        </span>
                        <input type="file" name="photo" id="photo" class="form-control" onchange="readURL(this);" required />
                     </div>
                     <div class="form-group">
                        <img src="./img/food.png" id="logo" width="200px" class="img-fluid img-thumbnail">
                     </div>
                  </div>
                  <input type="submit" name="btnAddFoodOffer" class="btn btn-primary">
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