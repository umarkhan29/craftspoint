<?php
	ob_start();
	require_once('config.khan');
	require_once(COMPONENTS.SESSION);
	
	require_once(COMPONENTS.CONNECT);	
	require_once(COMMON.HEADER);
	
	?>
	
	
	<?php
	$admin="1";
		if(isset($_POST['forgot_password'])){
	
				$result=mysql_query("SELECT * FROM `admins`") or die("Db error");
										if($result){		
												while($row = mysql_fetch_assoc($result)){
														if($_POST['forgot_password']==$row['email']){
														$admin="1";
														break;
													}
													else{
														$admin="0";
													}
														
												
														
												}
											// noe $search_slide_Results contains whole slide db table
											}
											else{
												// no users
											}
										}
?>
	
	
<div>

<div style="margin:auto;padding: 7px;border: 0;font-size: 18px;background: transparent; color:#333333; width:50%; ">
Enter your registered email to restore your password.<br>
</div>
<form action="" method="post">
	<div style="margin-left:25%; width:35%;">
	<table>
		<tr>
			<td ><input type="text" name="forgot_password" /></td>
			<td style="color:#FF0000; font-size:12px;">
				<?php 
						
						if(isset($_POST['forgot_password'])){
							
							if($_POST['forgot_password']==""){
								
								echo "Enter Email";
								$admin="0";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 */()><.,!@&#$]{4,26}[@]{1,1}[a-zA-Z]{3,16}[.]{1,1}[a-z]{2,16}$%",$_POST['forgot_password'])){
										if($admin=="0"){
											echo "Email not registered";
											}
											else{
												$admin=1;
											}
									}	
									else{
									
									echo "Enter a valid Email";
									$admin="0";
									}
								}
						} 
					?>
			</td>
		</tr>
	</table>
	

	<input type="submit" value="Continue" name="authbtn" id="authenticatebtn"/>
		</div>
</form>

</div>
<?php
	if(isset($_POST['forgot_password'])){
	if($admin=="1"){
		$_SESSION['admin_forgot_email']=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['forgot_password']))));;
		$_SESSION['admin_forgot_pass_auth']=rand(0000,999999);
		$message=" \n \n Your password verification code is ".$_SESSION['admin_forgot_pass_auth']."\n \n \n This message is live till your browser is open. \n"."Disclaimer:
		This message is intended only for the use of the addressee and may contain information that is privileged, confidential and exempt from disclosure under applicable law. If the reader of this message is not the intended recipient, or the employee or agent responsible for delivering the message to the intended recipient, you are hereby notified that any dissemination, distribution or copying of this communication is strictly prohibited. If you have received this e-mail in error, please notify us immediately and delete this e-mail and all attachments from your system.";
			mail($_SESSION['admin_forgot_email'],"Password Verification Code",$message,"From:Craftspoint.in");
			header('location:admin_pass_auth.php');
			
	}
	}
?>

<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>