<?php
ob_start();
	require_once('config.khan');
	require_once(COMPONENTS.CONNECT);
	require_once(COMPONENTS.SESSION);	
	require_once(COMMON.HEADER);
	
			
		?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Products</h3>
    		</div>
    		
    		
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		  

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="chain_stitch.php"><img src="images/chain_stitch.jpg" height="180" alt="" /></a>
					 
					 <p> <a href="chain_stitch.php" ><span style="text-decoration:underline; color:#333333; font-size:24px; cursor:pointer;">Chain Stitch</span></a></p>
					 
				</div>
				
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="curtains.php"><img src="images/curtains.jpg" height="180" alt="" /></a>
					 
					 <p> <a href="curtains.php"><span style="text-decoration:underline; color:#333333; font-size:24px; cursor:pointer;">Curtains</span></a></p>
					 
				</div>
				
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="pashmina.php"><img src="images/pashmina.jpg" height="180" alt="" /></a>
					 
					 <p> <a href="pashmina.php"><span style="text-decoration:underline; color:#333333; font-size:24px; cursor:pointer;">Pashmina</span></a></p>
					 
				</div>
				
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="carpets.php"><img src="images/carpets.jpg" height="180" alt="" /></a>
					 
					 <p> <a href="carpets.php"><span style="text-decoration:underline; color:#333333; font-size:24px; cursor:pointer;">Carpets</span></a></p>
					 
				</div>
				
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="cushions.php"><img src="images/cushions.jpg" height="180" alt="" /></a>
					 
					 <p> <a href="cushions.php"><span style="text-decoration:underline; color:#333333; font-size:24px; cursor:pointer;">Cushions</span></a></p>
					 
				</div>
				
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="papermachie.php"><img src="images/papermachie.jpg" height="180" alt="" /></a>
					 
					 <p> <a href="papermachie.php"><span style="text-decoration:underline; color:#333333; font-size:24px; cursor:pointer;">Paper Mache</span></a></p>
					 
				</div>
	  
				    
			
			
						
    		
    		
    		<div class="clear"></div>
    	</div>
			
    </div>
 </div>

</div>

<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>







