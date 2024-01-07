<?php
require_once 'DbConnection.php';

$response = array();

//table login validation

if(isset($_POST['userLogin'])){
	if(isset($_POST['table_id']) AND isset($_POST['password'])){

		$username = $_POST['table_id'];
		$password = $_POST['password'];

		$query_find = "SELECT * FROM tabs WHERE (table_id = '$username' AND password= '$password') AND isdelete=0";

		$query_execute = mysqli_query($connection, $query_find);


		if(mysqli_num_rows($query_execute) > 0){

			$row = $query_execute->fetch_assoc();

			$tableinfo = array(

				'table_id'=>$row['table_id'],
				'name'=>$row['name'],

			);


			$response['message'] = 'Login successfull';
			$response['status']=true;
			$response['tableinfo'] = $tableinfo;
			$query_insert =   "UPDATE tabs SET isLogin=1  WHERE  table_id='".$row['table_id']."'";

			$query_status = mysqli_query($connection, $query_insert);
			if($query_status){
				$response['error'] = false;
			}
			else{
				$response['error'] = true;
				$response['status']=false;
			}

		}else{
			$response['error'] = false;
			$response['status']=false;
			$response['message'] = 'Invalid username or password';
		}
	}
	else{
		$response['error'] = true;
		$response['status']=false;
		$response['message'] = 'insufficient parameters supplied';
	}

}
else if(isset($_POST['userLogout'])){				//Logout table
	if(isset($_POST['table_id'])){

		$username = $_POST['table_id'];

		$query_find = "UPDATE tabs SET isLogin=0  WHERE  table_id='$username'";

		$query_status = mysqli_query($connection, $query_find);
		if($query_status){
			$response['error'] = false;
			$response['message']="Logout successfull";
		}
		else{
			$response['error'] = true;
			$response['message']="Logout Failed";
		}

	}
	else{
		$response['error'] = true;
		$response['message'] = 'insufficient parameters supplied';
	}
}
else if (isset($_POST['viewItems'])) {

	if(isset($_POST['food_type']) AND isset($_POST['food_category']) ){

		$ftype=$_POST['food_type'];
		$fcat=$_POST['food_category'];

		$query_find = "SELECT * FROM food_item WHERE (food_type = '$ftype' AND food_category= '$fcat') AND (isavailable = 1 AND isdelete = 0)";
		$query_result = mysqli_query($connection, $query_find);

		if(mysqli_num_rows($query_result) > 0){
			$response['error'] = false;
		}
		else{
			$response['error'] = true;
			$response['message'] = 'DB error';
		}

		$items_info= array();
		$i=0;

		while($row =mysqli_fetch_assoc($query_result)) {

			$temp = array(

				'item_id'=>$row['slno'],
				'title'=>$row['food_title'],
				'price'=>$row['price'],
				'pic_url'=>'http://localhost/fmenu/uploads/'.$row['food_image'],
				'views_no'=>$row['views_no'],
				'rating'=>$row['rating'],
				'description'=>$row['description'],
				
			);
			array_push($items_info,$temp);
			$i++;

		}

		$response['message'] = 'Retrival successfull';
		$response['items_count']=$i;
		$response['items_info'] = $items_info;

	}
	else{
		$response['error'] = true;
		$response['message'] = 'insufficient parameters supplied';
		
	}
	
}
else if(isset($_POST['customerLogin'])){
	if(isset($_POST['cust_name']) AND isset($_POST['tab_id'])){

		$cust_name = $_POST['cust_name'];
		$tab_id = $_POST['tab_id'];

		$query_test = "SELECT checkout_status FROM tabs WHERE table_id = '$tab_id' AND isdelete = 0";

		$query_test_execute = mysqli_query($connection, $query_test);

		if(mysqli_num_rows($query_test_execute) > 0){

			$trow =mysqli_fetch_assoc($query_test_execute);
			if($trow['checkout_status']==0){

				$order_id=0;

				$query_find = "SELECT * FROM placed_order";

				$query_execute = mysqli_query($connection, $query_find);


				if(mysqli_num_rows($query_execute) == 0){

					$query_insert = "INSERT INTO placed_order (slno, customer_name, table_id, order_date, isActive) VALUES (1, '$cust_name', '$tab_id', NOW(), 0)";

					$order_id=1;


				}else{

			//$query_find = "SELECT MAX(slno) FROM placed_order";
					$query_find ="SELECT slno FROM placed_order ORDER BY slno DESC LIMIT 1";
					$query_execute = mysqli_query($connection, $query_find);
					$row =mysqli_fetch_assoc($query_execute);
					$order_id=($row['slno'])+1;
					$query_insert = "INSERT INTO placed_order (slno, customer_name, table_id, order_date, isActive, amount) VALUES ($order_id, '$cust_name', '$tab_id', NOW(), 0,0.0)";

				}
				$query_status = mysqli_query($connection, $query_insert);
				$query_insert =   "UPDATE tabs SET isactive=1  WHERE  table_id='$tab_id ' AND isdelete = 0";
				$query_change= mysqli_query($connection, $query_insert);
				if($query_status AND $query_change){

					$response['error'] = false;
					$response['message'] = 'Customer Login successfull';
					$response['order_id']=$order_id;

							
					
				}
				else{
					$response['error'] = true;
					$response['message'] = 'Data base error';
				}
			}
			else{
				$response['error'] = true;
				$response['message'] = 'Checkout Pending';
			}

		}else{
			$response['error'] = true;
			$response['message'] = 'Data base error';
		}

	}

	else{
		$response['error'] = true;
		$response['message'] = 'insufficient parameters supplied';
	}

}
else if(isset($_POST['insertItem'])){
	if(isset($_POST['order_id']) AND isset($_POST['item_id']) AND isset($_POST['quantity'])){

		$order_id = $_POST['order_id'];
		$item_id = $_POST['item_id'];
		$quantity= $_POST['quantity'];
		$query_insert = "INSERT INTO placed_order_items (order_id, food_item_id, quantity) VALUES ($order_id, $item_id,$quantity)";
		$query_status = mysqli_query($connection, $query_insert);

		if($query_status){
			$response['error'] = false;
			$response['message'] = 'Item Inserted';
		}
		else{
			$response['error'] = true;
			$response['message'] = 'DB error';
		}
	}
	else{
		$response['error'] = true;
		$response['message'] = 'insufficient parameters supplied';

	}

}
else if(isset($_POST['orderNow'])){
	if(isset($_POST['order_id']) AND isset($_POST['tab_id']) ){

		$order_id = $_POST['order_id'];
		$tab_id = $_POST['tab_id'];


		$query_find = "UPDATE placed_order SET isActive=1  WHERE  slno='$order_id'";
		$query_status = mysqli_query($connection, $query_find);

		$query_tab = "UPDATE tabs SET isorder=1  WHERE  table_id='$tab_id'";
		$query_tab_status = mysqli_query($connection, $query_tab);
		if($query_status AND $query_tab_status ){
			$response['error'] = false;
			$response['message']="Order sent";
		}
		else{
			$response['error'] = true;
			$response['message']="DB error";
		}
	}
	else{
		$response['error'] = true;
		$response['message'] = 'insufficient parameters supplied';

	}

}
else if(isset($_POST['orderStatus'])){
	if(isset($_POST['order_id']) ){

		$order_id = $_POST['order_id'];


		$query_find = "SELECT * FROM placed_order WHERE  slno=$order_id";

		$query_status = mysqli_query($connection, $query_find);
		if(mysqli_num_rows($query_status) > 0){

			$response['error'] = false;
			$row =mysqli_fetch_assoc($query_status);
			if($row['isActive']){
				$response['message']="Previous Order is Processing";
				$response['isActive']=true;

			}
			else{
				$response['message']="Avaialable";
				$response['isActive']=false;
			}
		}
		else{
			$response['error'] = true;
			$response['message']="DB error";
		}

	}

	else{
		$response['error'] = true;
		$response['message'] = 'insufficient parameters supplied';

	}

}
else if(isset($_POST['viewOrder'])){
	if(isset($_POST['order_id']) ){

		$order_id = $_POST['order_id'];


		$query_find = "SELECT * FROM placed_order_items WHERE  order_id=$order_id";

		$query_status = mysqli_query($connection, $query_find);
		if(mysqli_num_rows($query_status) > 0){

			$order_info= array();
			$response['error'] = false;
			$i=0;
			$sum=0;
			while($row =mysqli_fetch_assoc($query_status)) {
				$num=$row['quantity'];
				$id=$row['food_item_id'];

				$query_item= "SELECT * FROM food_item WHERE  slno=$id";
				$query_result = mysqli_query($connection, $query_item);
				if(mysqli_num_rows($query_result) > 0){

				$rows =mysqli_fetch_assoc($query_result);
				$total=($rows['price']*$num);
				$temp = array(
					'item_id'=>$rows['slno'],
					'title'=>$rows['food_title'],
					'price'=>$rows['price'],
					'quantity'=>$num,
					'amount'=>$total,						

				);
				$i++;
				$sum=$sum+$total;
				
				array_push($order_info,$temp);
			   }

			}

			$response['message']="All orders Recived";
			$response['order_info']=$order_info;
			$response['item_count'] = $i;
			$response['total_bill'] = $sum;

		}
		else{
			$response['error'] = true;
			$response['message']="DB error";
		}

	}

	else{
		$response['error'] = true;
		$response['message'] = 'insufficient parameters supplied';

	}


}
else if(isset($_POST['checkoutUser'])){
	if(isset($_POST['tab_id']) ){

		$tab_id = $_POST['tab_id'];


		$query_find = "UPDATE tabs SET checkout_status=1  WHERE  table_id='$tab_id' AND isdelete = 0";

		$query_status = mysqli_query($connection, $query_find);
		if($query_status){
			$response['error'] = false;
			$response['message']="sent to Checkout";
			$response['status']=true;
		}
		else{
			$response['error'] = true;
			$response['message']="DB error";
		}

	}

	else{
		$response['error'] = true;
		$response['message'] = 'insufficient parameters supplied';

	}

}
else if(isset($_POST['reviewItems'])){
	if(isset($_POST['order_id']) ){

		$order_id = $_POST['order_id'];

		$query_find = "SELECT DISTINCT food_item_id FROM placed_order_items WHERE  order_id=$order_id";

		$query_status = mysqli_query($connection, $query_find);
		if(mysqli_num_rows($query_status) > 0){

			$review_info= array();
			$response['error'] = false;
			$i=0;
			while($row =mysqli_fetch_assoc($query_status)) {
				
				$id=$row['food_item_id'];

				$query_item= "SELECT * FROM food_item WHERE  slno=$id";
				$query_result = mysqli_query($connection, $query_item);
				$rows =mysqli_fetch_assoc($query_result);
				$temp = array(
					'item_id'=>$rows['slno'],
					'title'=>$rows['food_title'],
					'price'=>$rows['price'],										

				);
				$i++;

				
				array_push($review_info,$temp);

			}
			$response['message']="All Review Items Recived";
			$response['review_info']=$review_info;
		}
		else{
			$response['error'] = true;
			$response['message']="DB error";
		}

	}

	else{
		$response['error'] = true;
		$response['message'] = 'insufficient parameters supplied';

	}

}
else if(isset($_POST['updateReview'])){
	if(isset($_POST['item_id']) AND isset($_POST['review_value']) ){

		$item_id = $_POST['item_id'];
		$review_value = $_POST['review_value'];

		$query_item= "SELECT * FROM food_item WHERE  slno=$item_id";
		$query_result = mysqli_query($connection, $query_item);
		
		if(mysqli_num_rows($query_result) > 0){
			$rows =mysqli_fetch_assoc($query_result);
			$old_rate=$rows['rating'];
			$old_views=$rows['views_no'];
			$value=$old_rate*$old_views;


			$no_views=$old_views+1;
			$rating_value=($value+$review_value)/$no_views;

			$query_find = "UPDATE food_item SET rating='$rating_value', views_no='$no_views'  WHERE  slno='$item_id'";
			$query_status = mysqli_query($connection, $query_find);
			if($query_status){
					$response['error'] = false;
					$response['message']="Ratting Updated";
			}
			else{
					$response['error'] = true;
					$response['message']="DB error";
			}

		}
		else{
			$response['error'] = true;
			$response['message']="DB error";
		}

	}

	else{
		$response['error'] = true;
		$response['message'] = 'insufficient parameters supplied';
	}
}
else{
		$response['message'] = 'Invalid Operation Called';
}

	echo json_encode($response);

?>