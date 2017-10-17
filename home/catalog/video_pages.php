
<?php
require_once('../../config.khan');
ob_start();
require_once('../components/session.khan');
if(isset($_GET['page_no'])){
		$_SESSION['start_product_of_page']=$_GET['page_no']-1;
		$_SESSION['start_product_of_page']=$_SESSION['start_product_of_page']*12;
		$last_product=$_SESSION['start_product_of_page']+12;
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
    		<h3>Videos</h3>
    		</div>
    		
    		
    		<div class="page-no">
    			<p>Result Pages:<ul>
				
				<div style="height:20px;">
				<?php
				
				for($i=1;$i<=$pages;$i++){
				?>
				
				<li  <?php if($i==$_GET['page_no']){echo 'class="active"';}?> style="cursor:pointer;" onClick="videos('search_div',<?php echo $i; ?>);" ><?php echo $i; ?>
					
					</li>
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
					 <a href="video_preview.php?video_id=<?php echo $searchResults[$i]['ID'];?>">
					 <video width="150" height="180" controls>
					  <source src="<?php echo $searchResults[$i]['PATH'];?>" type="video/mp4">
					  
					</video>
					 
					</a>
					 <h2><?php echo $searchResults[$i]['NAME'];?></h2>
					 
					 
				</div>
			
			<?php
				} //close for
				
				
			?>
			
			
			
    		
    		
    		<div class="clear"></div>
    	</div>
			
    </div>
 </div>
<div>
<?php
ob_end_flush();
?>