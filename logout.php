<?php

		require_once('config.khan');
		require_once(COMPONENTS.SESSION);
		$_SESSION['Authentic&ValidUser']="no";
		unset($_SESSION['Authentic&ValidUser']);
		unset($_SESSION['current_user']);
		header('location:index.php');
	
?>