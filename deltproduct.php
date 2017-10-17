<?php
	require_once('config.khan');
	require_once(COMPONENTS.SESSION);
	if(isset($_SESSION['Authentic&ValidUser'])){
	if($_SESSION['Authentic&ValidUser']=="no"){
		header('location:admin_login.php');
	}
}
else{
		header('location:admin_login.php');
}
	require_once(COMPONENTS.CONNECT);	
	
	
		$ITEM_ID=trim(strip_tags(stripslashes($_GET['product_id'])));
		$ITEM_PATH=trim(strip_tags(stripslashes($_GET['product_path'])));
	if(mysql_query("DELETE FROM `products` WHERE `id` = $ITEM_ID")){
			unlink($ITEM_PATH);
			header('location:products_delete.php?deletemsg=Sucessfully Deleted');
	}
	else{
		header('location:products_delete.php?deletemsg=Something Went Wrong');
	
			}
			

?>
