<?php include('DBConnection.php') ?>
<?php
	

	if(isset($_POST['iswater']) AND isset($_POST['tab_id'])) {
		$tab_id = $_POST['tab_id'];


		$query_find = "UPDATE tabs SET water_req=1  WHERE  table_id='$tab_id' AND isdelete = 0";

		$query_status = mysqli_query($connection, $query_find);
		if(!$query_status){
			echo '<script> alert("Update Failed.") </script>';
		}
  
    }


    if(isset($_POST['isbowl']) AND isset($_POST['tab_id'])) {
		$tab_id = $_POST['tab_id'];


		$query_find = "UPDATE tabs SET bowl_req=1  WHERE  table_id='$tab_id' AND isdelete = 0";

		$query_status = mysqli_query($connection, $query_find);
		if(!$query_status){
			echo '<script> alert("Update Failed.") </script>';
		}
    }

    if(isset($_POST['ishelper']) AND isset($_POST['tab_id'])) {
		$tab_id = $_POST['tab_id'];


		$query_find = "UPDATE tabs SET helper_req=1  WHERE  table_id='$tab_id' AND isdelete = 0";

		$query_status = mysqli_query($connection, $query_find);
		if(!$query_status){
			echo '<script> alert("Update Failed.") </script>';
		}
    }



    

    

?>