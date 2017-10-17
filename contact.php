<?php
	require_once('config.khan');
	require_once(COMPONENTS.SESSION);	
	require_once(COMMON.HEADER);
?>

		<div class="main">
    <div class="content">
    	<div class="support">
  			<div class="support_desc">
  				<h3>Live Support</h3>
  				<p><span>24 hours | 7 days a week | 365 days a year &nbsp;&nbsp; Live Technical Support</span></p>
  				<p>     Facing an issue on Crafts Point ? <br />Tell us where the problem lies</p>
  			</div>
  		
    	<div class="section group">
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h2>Contact Us</h2>
					
					
				
					
					
					    <form action="" method="post">
						<table>
						<tr>
						
						<td>
					    	<div>
						    	<span><label>NAME</label></span>
						    	<span><input type="text" name ="NAME"></span>
						   </div> </td>
							
							<td style="padding-left:10%; width:25%;"><br>
							 <?php 
						$admin="1";
						if(isset($_POST['SUBMIT'])){
							
							if($_POST['NAME']==""){
								$admin="0";
								echo "Enter Name";
								
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 */()><.,!@&#$]{4,26}$%",$_POST['NAME'])){
											
									}	
									else{
									$admin="0";
									echo "Enter a valid Email";
									}
								}
						} 
							
					?>
							</td>
							</tr>
							
							<tr>
							<td>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input type="text" name="E_MAIL"></span>
						    </div>
							</td>
							<td style="padding-left:10%;"><br>
							<?php 
						
						if(isset($_POST['SUBMIT'])){
						
							if($_POST['E_MAIL']==""){
								$admin="0";
								echo "Enter Email";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 */()><.,!@&#$]{4,26}[@]{1,1}[a-zA-Z]{3,16}[.]{1,1}[a-z]{2,16}$%",$_POST['E_MAIL'])){
											
									}	
									else{
									$admin="0";
									echo "Enter a valid Email";
									}
								}
						} 
					?>
							</td>
							</tr>
							
							
							<tr>
							<td>
						    <div>
						     	<span><label>MOBILE.NO</label></span>
						    	<span><input type="text" name="MOBILE_NO"></span>
						    </div>
							</td>
							<td  style="padding-left:10%;"><br>
							<?php 
						
						if(isset($_POST['SUBMIT'])){
							
							if($_POST['MOBILE_NO']==""){
								$admin="0";
								echo "Enter Phone Number";
								}
								else{
									if(preg_match("%^[0-9]{10,10}$%",$_POST['MOBILE_NO'])){
									
									}	
									else{
									$admin="0";
									echo "Enter a valid Number";
									}
								}
						} 
					?>
							</td>
							</tr>
							
							<tr>
							<td>
							 <div>
						     	<span><label>SUBJECT</label></span>
						    	<span><input type="text" name="SUBJECT"></span>
						    </div>
							</td>
							<td style="padding-left:10%;"><br>
									 <?php 
						
						if(isset($_POST['SUBMIT'])){
							
							if($_POST['SUBJECT']==""){
								$admin="0";
								echo "Enter your query";
								}
								else{
									if(preg_match("%^[a-z A-Z 0-9 .,!@&$]{4,1000}$%",$_POST['SUBJECT'])){
									
											}else{
												echo "Watch out your text";
												$admin="0";
											}
													
										
									}	
							
						} 
					?>
							</td>
							</tr>
							
						     </table>
						    
						   <div>
						   		<span><input type="submit" value="SUBMIT" name="SUBMIT"></span>
						  </div>
						 
					    </form>
				  </div>
  				</div>

				<div class="col span_1_of_3">
					<div class="contact_info">
    	 				<h2>Find Us Here</h2>
					    	  <div class="map">
							   	    <iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=https://www.google.co.in/maps/place/Fateh+Kadal,+Srinagar/@34.0878638,74.8063212,19z/data=!4m2!3m1!1s0x38e18f8a11dd8b49:0xc80fcf7c3ba51f28"></iframe><br><small><a href="https://www.google.co.in/maps/place/Fateh+Kadal,+Srinagar/@34.0878638,74.8063212,19z/data=!4m2!3m1!1s0x38e18f8a11dd8b49:0xc80fcf7c3ba51f28">View Larger Map</a></small>
							  </div>
      				</div>
      		
				 </div>
			  </div>    	
    </div>
 </div>
</div>
<?php
if(isset($_POST['SUBMIT']) and $admin=="1"){
	$NAME=$_POST['NAME'];
	$E_MAIL=$_POST['E_MAIL'];
	$MOBILE_NO=$_POST['MOBILE_NO'];
	$SUBJECT=$_POST['SUBJECT'];
	if(mail("support@craftspoint.in","Customer Feedback from :".$E_MAIL,$SUBJECT,"From:Craftspoint.in")){
		mail("rajzahoor47@gmail.com","Customer Feedbackfrom :".$E_MAIL,$SUBJECT,"From:Craftspoint.in");
		mail("umee909@gmail.com","Customer Feedbackfrom :".$E_MAIL,$SUBJECT,"From:Craftspoint.in");
		echo '<div style="color:green;">Your Query is sucessfully submitted.<br>Our Customer Care will get you soon.</div>';
	}else{
		echo '<div style="color:red;">Something Wrong happened.</div>';
	}

}mail($_SESSION['forgot_email'],"Password Verification Code",$message,"From:Craftspoint.in");

?>
	<?php
require_once(COMMON.FOOTER);
?>


