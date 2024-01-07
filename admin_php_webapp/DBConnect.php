<?php

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
?>