<?php
	require_once('config.khan');
	ob_start();
	require_once(COMPONENTS.SESSION);
	require_once(COMPONENTS.CONNECT);	
	require_once(COMMON.HEADER);
	if(!isset($_SESSION['products'])){
			header('location:cart.php');
	}elseif(!isset($_POST["amount"])){
			header('location:cart.php');
	}
	
?>


<?php	
		
		$status=$_POST["status"];
		$name=$_POST["firstname"];
		$price=$_POST["amount"];
		$txnid=$_POST["txnid"];
		$email=$_POST["email"];
		
		
		$phone=$_SESSION['pay_phone'];
		$product_name=$_SESSION['products'];
		$shipping=$_SESSION['pay_address'];
		

		
	
		$result=mysql_query("SELECT * FROM `users`") or die(header('location:error.php?token=dbt'));
		$user="unregistered";
		if($result){
				
				while($row = mysql_fetch_assoc($result)){
						
						if($email == $row['email']){
							$user="registered";
							break;
						
						}
				}
			
			}
			
			
		
		
		if($user=="registered"){
		if(mysql_query("INSERT INTO `user_details` (`trans_id`,`name`,`product_name`,`email`,`price`,`phone`,`shipping_address`) VALUES ('$txnid','$name','$product_name','$email','$price','$phone','$shipping')")){
		
									//notifying admin about product sold
									$message="The products:".$product_name."is out sold to ".$name."Ensure its delivery on time.";
												 	mail('rajzahoor47@gmail.com',"Product Sold",$message,"From:Kashmir Arts");
													mail('umee909@gmail.com',"Product Sold",$message,"From:Kashmir Arts");
									
									//resetting cart
									foreach($_SESSION as $key => $val){
												
												if(preg_match("%^['cart_product_']{13,13}[0-9]{1,2}$%",$key) & $val>0){
													unset($_SESSION[$key]);
												}
												
												//decrement quqntity
										$items=explode(',',$_SESSION['products']);
										 $count=count($items);
										$i=1;
										while($i<$count){
												$id=$i;
												$qty=$i+2;
												$id= explode(':',$items[$id]);
												$id=$id[1];
												$qty=explode(':',$items[$qty]);
												$qty=$qty[1];
												$quantity=mysql_query("SELECT `quantity` FROM `products` WHERE `id`='$id'");
												while($row=mysql_fetch_assoc($quantity)){
												$stock[]=array(
													$stock['QUANTITY']=$row['quantity']);
												}
												$quantity=$stock['QUANTITY']-$qty;
												mysql_query("UPDATE `products` SET `quantity` ='$quantity' WHERE `id`='$id' ");
												 $i=$i+4;
												 //notifying admin about stock
												 if($quantity<1){
												 	$message="The product with id:".$id."is out of stock.Please Update the product qyantity.";
												 	mail('rajzahoor47@gmail.com',"Product:".$id."is out of stock",$message,"From:Kashmir Arts");
													mail('umee909@gmail.com',"Product:".$id."is out of stock",$message,"From:Kashmir Arts");
												 }
												
									}


										//resetting payment variables
										unset($_SESSION['pay_name']);
										unset($_SESSION['pay_phone']);
										unset($_SESSION['pay_email']);
										unset($_SESSION['pay_address']);
										unset($_SESSION['total_price']);
										unset($_SESSION['products']);
										}
									echo '<div style="width:80%;padding-top:50px; padding-bottom:60px; padding-left:20%; overflow:hidden; color:green; font-size:22px; 										        							background:#999999;">You order is Sucessfull ';
									echo "<h3 >Thank You. Your order status is ". $status .".</h3>";
									  echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
									  echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
									  
									  echo '!</div>';
									
									header('Refresh:17;url=index.php');
							
		}	
		else{
							
				echo '<div style="width:80%;padding-top:50px; padding-bottom:60px; padding-left:20%; overflow:hidden; color:red; font-size:22px; background:#999999;">Something went		 				 wrong.Please Contact Site Adminstrator</div>';
				

			}

}
elseif($user=="unregistered"){
	if(mysql_query("INSERT INTO `unregistered_customers` (`trans_id`,`name`,`phone`,`product_name`,`price`,`email`,`shipping_address`) VALUES ('$txnid','$name','$phone','$product_name','$price','$email','$shipping')")){
	
	
									//notifying admin about product sold
									$message="The products:".$product_name."is out sold to ".$name."Ensure its delivery on time.";
												 	mail('rajzahoor47@gmail.com',"Product Sold",$message,"From:Kashmir Arts");
													mail('umee909@gmail.com',"Product Sold",$message,"From:Kashmir Arts");
													
													
													
										//resetting cart
									foreach($_SESSION as $key => $val){
												
												if(preg_match("%^['cart_product_']{13,13}[0-9]{1,2}$%",$key) & $val>0){
													unset($_SESSION[$key]);
												}
										}
										
										
													
										//decrement product quantity
										$items=explode(',',$_SESSION['products']);
										 $count=count($items);
										$i=1;
										while($i<$count){
												$id=$i;
												$qty=$i+2;
												$id= explode(':',$items[$id]);
												$id=$id[1];
												$qty=explode(':',$items[$qty]);
												$qty=$qty[1];
												$quantity=mysql_query("SELECT `quantity` FROM `products` WHERE `id`='$id'");
												while($row=mysql_fetch_assoc($quantity)){
												$stock[]=array(
													$stock['QUANTITY']=$row['quantity']);
												}
												$quantity=$stock['QUANTITY']-$qty;
												mysql_query("UPDATE `products` SET `quantity` ='$quantity' WHERE `id`='$id' ");
												 $i=$i+4;
												 //notifyng admin about stock
												  if($quantity<1){
												 	$message="The product with id:".$id."is out of stock.Please Update the product qyantity.";
												 	mail('rajzahoor47@gmail.com',"Product:".$id."is out of stock",$message,"From:Kashmir Arts");
													mail('umee909@gmail.com',"Product:".$id."is out of stock",$message,"From:Kashmir Arts");
												 }
												
									}
										//resetting payment variables
										unset($_SESSION['pay_phone']);
										unset($_SESSION['pay_name']);
										unset($_SESSION['pay_email']);
										unset($_SESSION['pay_address']);
										unset($_SESSION['total_price']);
										unset($_SESSION['products']);
									echo '<div style="width:80%;padding-top:50px; padding-bottom:60px; padding-left:20%; overflow:hidden; color:green; font-size:32px; 										        							background:#999999;">You order is Sucessfull ';
									echo "<h3 >Thank You. Your order status is ". $status .".</h3>";
									  echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
									  echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
									  
									  echo '!</div>';
									header('Refresh:17;url=index.php');
							
		}	
		else{
							
				echo '<div style="width:80%;padding-top:50px; padding-bottom:60px; padding-left:20%; overflow:hidden; color:red; font-size:22px; background:#999999;">Something went		 				 wrong.Please Contact Site Adminstrator</div>';
				
			}


}


?>


<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>