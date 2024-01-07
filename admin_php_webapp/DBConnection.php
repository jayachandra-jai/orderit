<?php
  session_start();
  $error='';
  $water_req=false;
  $helper_req=false;
  $bowl_req=false;

  //database variable
  $server_name = "localhost";
  $mysql_username = "id5021921_orderit";
  $mysql_password = "orderit180";
  $db_name = "id5021921_my_menu_db";

  if(!mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name)) {
    echo '<script>alert("Please check your database connection");</script>';
    header('Location: errorpage.php');
  } else {
    //database connection
    $connection = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);
  }


  //code for registration
  if( isset($_POST['btnAddUser']) ) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $mobile = mysqli_real_escape_string($connection, $_POST['mobile']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $type = mysqli_real_escape_string($connection, $_POST['user_type']);

    $query_find = "SELECT * FROM users WHERE email = '$email' ";
    $query_status = mysqli_query($connection, $query_find);

    if(mysqli_num_rows($query_status) == 0) {

      $query_insert = "INSERT INTO users (user_name, mobile, email, password, create_date, user_type,isdelete) VALUES ('$name', '$mobile', '$email', '$password', NOW(), '$type',0)";

      $query_status = mysqli_query($connection, $query_insert);

      echo '<script> alert("Registration Successfully.") </script>';

    } else {
      echo '<script> alert("User already exists") </script>';    
    }
  }

   
    //update User
    if(isset($_POST['updateUser'])) {
      
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $mobile = mysqli_real_escape_string($connection, $_POST['mobile']);
    //insert the information into the table
  
    $query_insert =   "UPDATE users SET user_name='$name', mobile='$mobile' WHERE  email='".$_SESSION['email']."'";

    $query_status = mysqli_query($connection, $query_insert);

    if($query_status) {
           $_SESSION['user_name'] = $name ;
           $_SESSION['mobile'] = $mobile ;
          unset($_SESSION['changeuser']);
            if($_SESSION['type'] == 'Admin'){
              header('Location: home.php');
              exit;
          }
          else{
              header('Location: orders.php');
              exit;
          }

    } else {
      $msg = "Error...! Please try again.";
      //displayAlert("$msg");    
       echo '<script>alert("'.$msg.'");</script>';  
    }

            
  }



      //update User
    if(isset($_POST['changePassword'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $pass = mysqli_real_escape_string($connection, $_POST['rePassword']);
    $oldpass = mysqli_real_escape_string($connection, $_POST['oldpassword']);
    //insert the information into the table
     $query_find = "SELECT * FROM users WHERE email = '$email' AND password='$oldpass' ";
        $query_find_status = mysqli_query($connection, $query_find);
        if(mysqli_num_rows($query_find_status) == 1) {
             $query_insert =   "UPDATE users SET password='$pass' WHERE  email='".$email."'";

            $query_status = mysqli_query($connection, $query_insert);

            if($query_status) {

              header('Location: modifyUser.php');
              exit;
 
            } else {
                        $msg = "Error...! Please try again.";
      //displayAlert("$msg");    
                    echo '<script>alert("'.$msg.'");</script>';  
            }
      }
      else {
                        $msg = "Invalid Old Password.";
      //displayAlert("$msg");    
                    echo '<script>alert("'.$msg.'");</script>';  
            }
  
            
  }
  //forgotpassword
    if(isset($_POST['forgotpassword'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    //insert the information into the table
     $query_find = "SELECT * FROM users WHERE email = '$email'";
        $query_find_status = mysqli_query($connection, $query_find);
         
        if(mysqli_num_rows($query_find_status) == 1) {
                    date_default_timezone_set('Asia/Kolkata');
                    $cdate=date("Y-m-d H:i:s");
                    $key=md5($email.date("Y-m-d H:i:s"));
                    $query_insert = "INSERT INTO reset ( email, my_key, time_value) VALUES ('$email', '$key', '$cdate')";

                          $query_status = mysqli_query($connection, $query_insert);


                    $subject = "Reset Password For Order It";
                    $txt = "click the follwing Link to Reset Password:\n http://orderit.000webhostapp.com/ResetPassword.php?key=".$key;
                    $headers = "From: admin@orderit.com" . "\r\n";
                    mail($email,$subject,$txt,$headers);
                    
      }
      else {
                        $msg = "Invalid Mail Address.";
                    echo '<script>alert("'.$msg.'");</script>';  
      }
         
  }
  

   //update User
    if(isset($_POST['removeUser'])) {
      
    $name = mysqli_real_escape_string($connection, $_POST['user_id']);
    

    //insert the information into the table
  
    $query_insert =   "UPDATE users SET isdelete=1  WHERE  email='".$name."'";

    $query_status = mysqli_query($connection, $query_insert);

    if($query_status) {
      $msg = "User with mail id ".$name." is removed Successfully";
      displayAlert("$msg");
    } else {
      $msg = "Error...! Please try again.";
      //displayAlert("$msg");    
       echo '<script>alert("'.$msg.'");</script>';  
    }

            
  }
   //code for login
   if(isset($_POST['btnLogin'])) {

    if (empty($_POST['email']) || empty($_POST['password'])) {
      $error = "Username or Password is Empty";
    }
    else
    {

     $email = mysqli_real_escape_string($connection, $_POST['email']);
     $password = mysqli_real_escape_string($connection, $_POST['password']);

     $query_find = "SELECT * FROM users WHERE email = '$email' AND isdelete=0 ";
      
     $query_execute = mysqli_query($connection, $query_find);

      if(mysqli_num_rows($query_execute) == 0) {
            $error = "Username is invalid";
      }
      else if(mysqli_num_rows($query_execute) == 1) {
        $row = $query_execute->fetch_assoc();
        if($row['password']==$password) {
           $_SESSION['user_name'] = $row['user_name'];
           $_SESSION['mobile'] = $row['mobile'];
           $_SESSION['create_date'] = $row['create_date'];
           $_SESSION['email'] = $row['email'];
           $_SESSION['type'] = $row['user_type'];

          if($_SESSION['type'] == 'Admin'){
              header('Location: home.php');
              exit;
          }
          else{
              header('Location: orders.php');
              exit;
          }
          }
          else{
            $error = "Password is invalid";
            
          }


     } else {
        echo '
          <script>
            console.log("Enter your valid credentials");
          </script>
        ';
     }
   }
 }

  //code for logout
  if( isset($_POST['btnLogout']) ) {
    session_destroy();
    unset($_SESSION['user_name']);
    unset($_SESSION['mobile']);
    unset($_SESSION['create_date']);
    unset($_SESSION['email']);
    unset($_SESSION['user_type']); 

  }

  function displayAlert($msg) {
    echo "<script>";
    echo "alert('$msg')";
    echo "</script>";
  }

  //set Admin Link
  function setAdminLink() {
  

        if(isset($_SESSION['user_name'])) {
      echo '<form action="index.php" method="post"><li style=" margin-top: 11px; margin-bottom: 11px; color: #000000; font-weight: bold;font-size: 15px;"><a href="modifyUser.php" style="color:#000000" ><span class="glyphicon glyphicon-user"> </span> '. ucfirst($_SESSION['user_name']). ' ( '. ucfirst($_SESSION['type']) . ' )</a>
            
              <input type="submit" name="btnLogout" value="Logout" class="btn btn-alert" >
            </li></form>';
    } else {
      echo '<li><a href="#" class="glyphicon glyphicon-log-in" data-toggle="modal" data-target="#loginModal"> Login </a><li>';
    }
  }


  //insert new Table
  if(isset($_POST['btnAddTable'])) {
    $tableName = mysqli_real_escape_string($connection, $_POST['tableName']);
    $tableID = mysqli_real_escape_string($connection, $_POST['tableID']); 
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    //insert the information into the table
    $query_insert = "INSERT INTO tabs (name, table_id, password, isactive, islogin,isdelete) VALUES ('$tableName', '$tableID', '$password', 0, 0, 0)";

    $query_status = mysqli_query($connection, $query_insert);

    if($query_status) {
      $msg = "Data Inserted Successfully";
      displayAlert("$msg");
    } else {
      $msg = "Error...! User already exists Try another Id";
      
      displayAlert("$msg");      
    }
  }
  
  
  //Update Table
  if(isset($_POST['btnUpdateTable'])) {
    $tableName = mysqli_real_escape_string($connection, $_POST['tableName']);
    $tab_id = mysqli_real_escape_string($connection, $_POST['tab_id']); 
    $password = mysqli_real_escape_string($connection, $_POST['rePassword']);

    //insert the information into the table
    $query_find = "UPDATE tabs SET name='$tableName', password='$password'  WHERE  table_id='$tab_id'";

    $query_status = mysqli_query($connection, $query_find);

    if($query_status) {
      $msg = "Table Updated Successfully";
      displayAlert("$msg");
    } else {
      $msg = "Error...! User already exists Try another Id";
      
      displayAlert("$msg");      
    }
  }
  
  //Remove Table
  if(isset($_POST['removetable'])) {
  
    $name = mysqli_real_escape_string($connection, $_POST['tab_id']); 

   $query_insert =   "UPDATE tabs SET isdelete=1  WHERE  table_id='".$name."'";

    $query_status = mysqli_query($connection, $query_insert);

    if($query_status) {
      $msg = "Table with id ".$name." is removed Successfully";
      displayAlert("$msg");
    } else {
      $msg = "Error...! Please try again.";
      //displayAlert("$msg");    
       echo '<script>alert("'.$msg.'");</script>';  
    }
  }


  //get all tables information from the database
  function getTabs() {
    $query_find = "SELECT * FROM tabs WHERE isdelete=0";
    global $connection;
    $query_status = mysqli_query($connection, $query_find);
    return $query_status;
  }

  //get application user list
  function getUsers() {
    $query_find = "SELECT * FROM users WHERE isdelete=0";
    global $connection;
    $query_status = mysqli_query($connection, $query_find);
    return $query_status;
  }
    //get application other user list only
  function getOtherUsers() {
    $query_find = "SELECT * FROM users WHERE isdelete=0 AND user_type='User'";
    global $connection;
    $query_status = mysqli_query($connection, $query_find);
    return $query_status;
  }
    //get all tables which are not login from the database
  function getDelTables(){
    $query_find = "SELECT * FROM tabs WHERE isdelete=0 AND islogin=0";
    global $connection;
    $query_status = mysqli_query($connection, $query_find);
    return $query_status;
  }
  //Add a food or offer
  if(isset($_POST['btnAddFoodOffer'])) {
    $food_title = mysqli_real_escape_string($connection, $_POST['food_title']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $price = mysqli_real_escape_string($connection, $_POST['price']); 
    $food_type = mysqli_real_escape_string($connection, $_POST['food_type']); 
    $food_category = mysqli_real_escape_string($connection, $_POST['food_category']);

    $file_tmp = $_FILES['photo']['tmp_name'];
    $photo = basename( $_FILES["photo"]["name"]);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
     echo '<script>alert("'.$_FILES["photo"]["tmp_name"].'");</script>';  
    //insert the information into the table
    $query_insert = "INSERT INTO food_item (food_title, description, food_image, price, views_no, rating, food_type, food_category, isavailable, isdelete) VALUES ('$food_title', '$description', '$photo', '$price', 0, 0, '$food_type', '$food_category', 1,0)";
    $query_status = mysqli_query($connection, $query_insert);

    if($query_status == 1) {
      $msg = "Data Inserted Successfully";
      echo "msg";
      // displayAlert("$msg");
    } else {
      $msg = "Error...! Already available.";
      // displayAlert("$msg");
      echo "msg";
    }
  }

  if(isset($_POST['btnUpdateFoodOffer'])) {
    $item_id=$_POST['item_id'];
    $food_title = mysqli_real_escape_string($connection, $_POST['food_title']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $price = mysqli_real_escape_string($connection, $_POST['price']); 
    $food_type = mysqli_real_escape_string($connection, $_POST['food_type']); 
    $food_category = mysqli_real_escape_string($connection, $_POST['food_category']);
    $food_avl = mysqli_real_escape_string($connection, $_POST['food_avl']);

    if(!empty($_FILES["photo"]["name"]) AND isset($_FILES["photo"]) ){

    $photo = basename( $_FILES["photo"]["name"]);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

     $query_update = "UPDATE food_item SET food_title='$food_title', description='$description', food_image='$photo',price='$price',food_type='$food_type', food_category='$food_category', isavailable=$food_avl   WHERE  slno='$item_id'";


    }
    else{
      $query_update = "UPDATE food_item SET food_title='$food_title', description='$description', price='$price',food_type='$food_type', food_category='$food_category', isavailable=$food_avl   WHERE  slno='$item_id'";
    }


    $query_status = mysqli_query($connection, $query_update);

    if($query_status == 1) {
      $msg = "Data Updated Successfully";
      echo "msg";
      // displayAlert("$msg");
    } else {
      $msg = "Error...! Already available.";
      // displayAlert("$msg");
      echo "msg";
       echo '<script> alert("'.$query_update.'") </script>';
    }
  }



  //get application user list
  function getFoodOffers() {
    $query_find = "SELECT * FROM food_item WHERE isdelete=0";
    global $connection;
    $query_status = mysqli_query($connection, $query_find);
    return $query_status;
  }
//get Tables with their status
    function getTabsStatus() {
    include('DBConnect.php') ;
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
                    $colors="btn_yellow";
                  else
                    $colors="btn_green";
                }
                else
                     $colors="btn_red";

                echo '<th><BUTTON class="'.$colors.'" type="submit" name="'.$row["table_id"].'" id="'.$row["table_id"].'"> '.$row["name"].'</BUTTON><br> 

                </th>';
          }
          echo '</form></tr>';

      }
          echo '</table>';
  }
}

 

    if(isset($_POST['waterdone'])) {
    $water_req=false;
    }
    if(isset($_POST['bowldone'])) {
        $bowl_req=false;
    }
    if(isset($_POST['helperdone'])) {
        $helper_req=false;
    }



    if(isset($_POST['iswaterSent']) AND isset($_POST['tab_id'])) {
    $tab_id = $_POST['tab_id'];


    $query_find = "UPDATE tabs SET water_req=0  WHERE  table_id='$tab_id' AND isdelete = 0";

    $query_status = mysqli_query($connection, $query_find);
    if(!$query_status){
      echo '<script> alert("Update Failed.") </script>';
    }
  
    }


    if(isset($_POST['ishelperSent']) AND isset($_POST['tab_id'])) {
    $tab_id = $_POST['tab_id'];


    $query_find = "UPDATE tabs SET helper_req=0  WHERE  table_id='$tab_id' AND isdelete = 0";

    $query_status = mysqli_query($connection, $query_find);
    if(!$query_status){
      echo '<script> alert("Update Failed.") </script>';
    }
    }

    if(isset($_POST['isbowlSent']) AND isset($_POST['tab_id'])) {
    $tab_id = $_POST['tab_id'];


    $query_find = "UPDATE tabs SET bowl_req=0  WHERE  table_id='$tab_id' AND isdelete = 0";

    $query_status = mysqli_query($connection, $query_find);
    if(!$query_status){
      echo '<script> alert("Update Failed.") </script>';
    }
    }

        if(isset($_POST['isOrderSent'])) {

           if(isset($_POST['order_id']) AND isset($_POST['tab_id'])) {
                    $tab_id = $_POST['tab_id'];
                    $order_id=$_POST['order_id'];

                $query_find = "UPDATE tabs SET isorder=0  WHERE  table_id='$tab_id' AND isdelete = 0";
             
                $query_order_item = "UPDATE placed_order_items SET process=1  WHERE  order_id='$order_id'";

                $query_find_status = mysqli_query($connection, $query_find);
             
                $query_order_item_status = mysqli_query($connection, $query_order_item);


                if(!$query_find_status or !$query_order_item_status ){
                      echo '<script> alert("No Order Updated.") </script>';
                }
         }
    }
$oid = null;
   if(isset($_POST['pay_bill'])) {

           if(isset($_POST['order_id']) AND isset($_POST['tab_id'])) {
                    $tab_id = $_POST['tab_id'];
                    $order_id=$_POST['order_id'];
                    $umail=$_SESSION['user_name'];
                    $tot=$_POST['tot_amount'];
                    print_r($_POST);
                   $oid=$order_id;

                $query_find = "UPDATE tabs SET isorder=0, isactive=0, checkout_status=0, water_req=0,helper_req=0, bowl_req=0  WHERE  table_id='$tab_id' AND isdelete = 0";
             
                $query_order_item = "UPDATE placed_order_items SET process=1  WHERE  order_id='$order_id'";
                $query_order = "UPDATE placed_order SET isActive=0, amount='$tot', bill_date=NOW(), bill_passed_by='$umail'  WHERE  slno='$order_id'";

                $query_find_status = mysqli_query($connection, $query_find);
                $query_order_status = mysqli_query($connection, $query_order);
             
                $query_order_item_status = mysqli_query($connection, $query_order_item);

                if((!$query_find_status or !$query_order_item_status) or !$query_order_status ){
                      echo '<script> alert("No Update Done.") </script>';
                }
 
         }
    }
  
   if(isset($_POST['reset_table'])) {

           if(isset($_POST['tab_id'])) {
                    $tab_id = $_POST['tab_id'];
                    $umail="jai";  //$_SESSION['user_name'];
                    $tot=0;
                 

                $query_find = "UPDATE tabs SET isorder=0, isactive=0, islogin=0, checkout_status=0, water_req=0,helper_req=0, bowl_req=0  WHERE  table_id='$tab_id' AND isdelete = 0";
                 $query_find_status = mysqli_query($connection, $query_find);

                 $query_get_order = "SELECT * FROM placed_order WHERE  table_id='$tab_id' AND isActive=1"; 
                 $query_get_order_status = mysqli_query($connection, $query_get_order);

                 if(mysqli_num_rows($query_get_order_status)>0){
                         while($row =mysqli_fetch_assoc($query_get_order_status)) {
                         $order_id= $row['slno']; 
                        $query_order_item = "UPDATE placed_order_items SET process=1  WHERE  order_id='$order_id'";
                        $query_order = "UPDATE placed_order SET isActive=0, amount='$tot', bill_date=NOW(), bill_passed_by='$umail'  WHERE  slno='$order_id'";

                        $query_order_status = mysqli_query($connection, $query_order);
                     
                        $query_order_item_status = mysqli_query($connection, $query_order_item);
                      }
                 }
 
         }
    }

?>