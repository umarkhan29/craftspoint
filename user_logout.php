<?php
ob_start();
		require_once('config.khan');
		require_once(COMPONENTS.SESSION);
		$_SESSION['Loggedin_User']="no";
		unset($_SESSION['Loggedin_User']);
		unset($_SESSION['current_loggedin_user']);
		unset($_SESSION['Loggedin_User_password']);
		header('location:login.php');
	ob_end_flush();
?>