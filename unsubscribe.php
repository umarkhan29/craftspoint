<?php
	ob_start();
	require_once('config.khan');
	require_once(COMPONENTS.SESSION);
	if(!isset($_POST['btn'])){
		header('location:index.php');
	}
	require_once(COMPONENTS.CONNECT);	
	require_once(COMMON.HEADER);
	
?>

<?php

if(isset($_POST['btn'])){ 
		$email=	$_POST['subscribe_email'];
			if($email==""){
				
				echo '<div style="width:80%;padding-top:50px; padding-bottom:60px; padding-left:20%; overflow:hidden; color:red; font-size:32px; background:#999999;">Enter Email</div>';				}
				else{
					if(preg_match("%^[a-z A-Z 0-9 */()><.,!@&#$]{3,26}[@]{1,1}[a-zA-Z]{2,16}[.]{1,1}[a-z]{2,16}$%",$email)){
							$email=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['subscribe_email']))));	
							
							$result=mysql_query("SELECT * FROM `subscribers`") or die("Db error");
								$user="unsubscribed";
								if($result){
										
										while($row = mysql_fetch_assoc($result)){
												
												if($email == $row['email']){
													$user="subscribed";
													break;
												
												}
										}
									
									}
			
							if($user=="subscribed"){
							mysql_query("DELETE FROM `subscribers` WHERE `email` = '$email'") or die(header('location:error.php?token=dbt'));
							echo '<div style="width:80%;padding-top:50px; padding-bottom:60px; padding-left:20%; overflow:hidden; color:green; font-size:32px; background:#999999;">You have been sucessflly Unsubscribed from our newsletters</div>';
							$message="You have been sucessflly Unsubscribed from our newsletters";
							mail($email,"UnSubscribed",$message,"From:Craftspoint.in");
					}else{
						echo '<div style="width:80%;padding-top:50px; padding-bottom:60px; padding-left:20%; overflow:hidden; color:green; font-size:32px; background:#999999;">You were not Subscribed to our newsletters</div>';
					}
					}	
					
					else{
					
					echo '<div style="width:80%;padding-top:50px; padding-bottom:60px; padding-left:20%; overflow:hidden; color:red; font-size:32px; background:#999999;">Invalid Email</div>';
					}
				}
}
?>

<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>