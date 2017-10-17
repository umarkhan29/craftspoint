<?php
ob_start();
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
	
	
		$ITEM_ID=mysql_real_escape_string(trim(strip_tags(stripslashes($_GET['product_id']))));
		$ITEM_PATH=mysql_real_escape_string(trim(strip_tags(stripslashes($_GET['product_path']))));
	if(mysql_query("DELETE FROM `videos` WHERE `id` = $ITEM_ID")){
			unlink($ITEM_PATH);
			header('location:video_delete.php?deletemsg=Sucessfully Deleted');
	}
	else{
		header('location:video_delete.php?deletemsg=Something Went Wrong');
			}
ob_end_flush();
?>
