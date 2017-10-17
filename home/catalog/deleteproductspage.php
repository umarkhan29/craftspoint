
<?php

require_once('../../config.khan');
require_once('../components/session.khan');
if(isset($_GET['page_no'])){
		$_GET['page_no']=trim(strip_tags(stripslashes($_GET['page_no'])));
		$_SESSION['start_product_of_page']=$_GET['page_no']-1;
		$_SESSION['start_product_of_page']=$_SESSION['start_product_of_page']*6;
		$last_product=$_SESSION['start_product_of_page']+6;
		 $searchResults=$_SESSION['Total_results'];
		 $pages=$_SESSION['total_pages'];
		 
		 
		if($_SESSION['total_products']<$last_product){
				$last_product=$_SESSION['total_products'];
			}
	}


?>

 
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Product Delete</h3>
    		</div>
    	
    		
    		<div class="page-no">
    			<p>Result Pages:<ul>
				
				<div style="height:20px;">
				<?php
				
				for($i=1;$i<=$pages;$i++){
				?>
					
						<li <?php if($i==$_GET['page_no']){echo 'class="active"';}?> style="cursor:pointer;" onClick="productdelt('admin_login_section',<?php echo $i; ?>);" ><?php echo $i; ?></li>
						
					
    			<?php 
				}
				?>	
    			</div>
    				</ul></p>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		  

		  	<?php
				
				
				for($i=$_SESSION['start_product_of_page'];$i<$last_product;$i++){
					
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <img src="<?php echo $searchResults[$i]['PATH']?>" height="180" alt="" />
					 <h2><?php echo $searchResults[$i]['NAME']?></h2>
				    <div class="button"> <span><a href="deltproduct.php?product_id=<?php echo $searchResults[$i]['ID'];?>&product_path=<?php echo $searchResults[$i]['PATH'];?>" class="details">Delete</a></span></div>
					</div>
			
			<?php
				} //close for
				
				
			?>
			
			
			
    		
    		
    		<div class="clear"></div>
    	</div>
			
    </div>
 </div>
<div>
