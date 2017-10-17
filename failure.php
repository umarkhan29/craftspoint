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
		
		
		echo '<div style="width:80%;padding-top:50px; padding-bottom:60px; padding-left:20%; overflow:hidden; color:maroon; font-size:22px; 										        							background:#999999;">';
									echo "<h3 >Your order status is ". $status .".</h3>";
									  echo "<h4>We have not received any payment from you.<br> If amount is deducted from your account.Contact Your Bank.</h4>";
									   echo "<h4>Your transaction id for this transaction is ".$txnid.".<br><br>You may try making the payment by clicking the link below.<br></h4>";
									  echo "<p><a href='payment_preview.php'> Try Again</a></p>";
									  echo '</div>';
									
									header('Refresh:17;url=index.php');
?>


<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>