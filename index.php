<?php
ob_start();
	require_once('config.khan');
	require_once(COMPONENTS.CONNECT);
	require_once(COMPONENTS.SESSION);	
	require_once(COMMON.HEADER);
?>

<div>
		<?php
		$slide_result=mysql_query("SELECT * FROM `slideshow`") or die(header('location:error.php?token=dbt'));
		if($slide_result){
				
				while($slide_row = mysql_fetch_assoc($slide_result)){
						$search_slide_results[] = array(
							'SLIDER_PATH'		=>	$slide_row['path'],
							
						);
						
				}
			// now $search_slide_results_Results contains whole slide db table
			}
			else{
				// slide show error(no data in database)
			}
			
		?>
	
</div>
	
	
	
<div class="header_bottom">
	  
		   <!-- FlexSlider -->
              <section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="<?php echo $search_slide_results[0]['SLIDER_PATH']; ?>" alt="" /></li>
						<li><img src="<?php echo $search_slide_results[1]['SLIDER_PATH']; ?>" alt=""/></li>
						<li><img src="<?php echo $search_slide_results[2]['SLIDER_PATH']; ?>" alt="" /></li>
						<li><img src="<?php echo $search_slide_results[3]['SLIDER_PATH']; ?>" alt="" /></li>
						<li><img src="<?php echo $search_slide_results[4]['SLIDER_PATH']; ?>" alt="" /></li>
						<li><img src="<?php echo $search_slide_results[5]['SLIDER_PATH']; ?>" alt="" /></li>
						
						
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    
	  <div class="clear"></div>
  </div>	

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		
    		<?php
			
				$products=mysql_query("SELECT * FROM `products` ORDER BY `discount` DESC LIMIT 4 ") or die(header('location:error.php?token=dbt'));
		
		if($products){
				$fitems="";
				while($row = mysql_fetch_assoc($products)){
						$fitems[] = array(
							'PATH'			=>	$row['path'],
							'ID'			=>	$row['id'],
							'NAME'			=>	$row['name'],
							'DISCOUNT'		=>	$row['discount'],
							'CATAGORY'		=>	$row['catagory'],
							'PRICE'			=>	$row['price']
							
						);
					
				}
			
			}
			else{
				echo "No Produsts avaliable";
			}
			?>
    		
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?product_id=<?php echo $fitems[0]['ID']; ?>"><img src="<?php echo $fitems[0]['PATH']; ?>" alt="" height="180"/></a>
					 <h2><?php echo $fitems[0]['NAME']?></h2>
					 <p><?php echo $fitems[0]['CATAGORY']?></p>
					 <p><span class="strike"><?php echo $fitems[0]['PRICE']; ?></span><span class="price"><?php echo $fitems[0]['DISCOUNT'];?></span></p>
					  <div class="button"><span><img src="images/cart.jpg" alt="" /><a href="cart.php?product_id=<?php echo $fitems[0]['ID'];?>" class="cart-button">Add to Cart</a></span> </div>
				     <div class="button"><span><a href="preview.php?product_id=<?php echo $fitems[0]['ID']; ?>" class="details">Details</a></span></div>
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?product_id=<?php echo $fitems[1]['ID']; ?>"><img src="<?php echo $fitems[1]['PATH']; ?>" alt="" height="180" /></a>
					 <h2><?php echo $fitems[1]['NAME']?></h2>
					 <p><?php echo $fitems[1]['CATAGORY']?></p>
					 <p><span class="strike"><?php echo $fitems[1]['PRICE']; ?></span><span class="price"><?php echo $fitems[1]['DISCOUNT'];?></span></p>
					  <div class="button"><span><img src="images/cart.jpg" alt="" /><a href="cart.php?product_id=<?php echo $fitems[1]['ID'];?>" class="cart-button">Add to Cart</a></span> </div>
				     <div class="button"><span><a href="preview.php?product_id=<?php echo $fitems[1]['ID'];?>" class="details">Details</a></span></div>
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?product_id=<?php echo $fitems[2]['ID']; ?>"><img src="<?php echo $fitems[2]['PATH']; ?>" alt="" height="180"/></a>
					 <h2><?php echo $fitems[2]['NAME']?></h2>
					 <p><?php echo $fitems[2]['CATAGORY']?></p>
					 <p><span class="strike"><?php echo $fitems[2]['PRICE']; ?></span><span class="price"><?php echo $fitems[2]['DISCOUNT'];?></span></p>
					  <div class="button"><span><img src="images/cart.jpg" alt="" /><a href="cart.php?product_id=<?php echo $fitems[2]['ID'];?>" class="cart-button">Add to Cart</a></span> </div>
				     <div class="button"><span><a href="preview.php?product_id=<?php echo $fitems[2]['ID'];?>" class="details">Details</a></span></div>
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?product_id=<?php echo $fitems[3]['ID']; ?>"><img src="<?php echo $fitems[3]['PATH']; ?>" alt="" height="180"/></a>
					 <h2><?php echo $fitems[3]['NAME']?></h2>
					 <p><?php echo $fitems[3]['CATAGORY']?></p>
					 <p><span class="strike"><?php echo $fitems[3]['PRICE']; ?></span><span class="price"><?php echo $fitems[3]['DISCOUNT'];?></span></p>
					  <div class="button"><span><img src="images/cart.jpg" alt="" /><a href="cart.php?product_id=<?php echo $fitems[3]['ID'];?>" class="cart-button">Add to Cart</a></span> </div>
				     <div class="button"><span><a href="preview.php?product_id=<?php echo $fitems[3]['ID']; ?>" class="details">Details</a></span></div>
				</div>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    			<?php
				$items="";
				
				$products=mysql_query("SELECT * FROM `products` ORDER BY `added_on` DESC LIMIT 4") or die("Db error");
		
		if($products){
				
				while($row = mysql_fetch_assoc($products)){
						$items[] = array(
							'PATH'		=>	$row['path'],
							'ID'		=>	$row['id'],
							'NAME'		=>	$row['name'],
							'DISCOUNT'		=>	$row['discount'],
							'CATAGORY'		=>	$row['catagory'],
							'PRICE'		=>	$row['price']
							
						);
					
				}
			
			}
			else{
				echo "No Produsts avaliable";
			}
			?>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?product_id=<?php echo $items[0]['ID']; ?>"><img src="<?php echo $items[0]['PATH']; ?>" alt="" height="180"/></a>
					 <h2><?php echo $items[0]['NAME']?></h2>
					 <p><?php echo $items[0]['CATAGORY']?></p>
					 <p><span class="strike"><?php echo $items[0]['PRICE']; ?></span><span class="price"><?php echo $items[0]['DISCOUNT'];?></span></p>
					  <div class="button"><span><img src="images/cart.jpg" alt="" /><a href="cart.php?product_id=<?php echo $items[1]['ID'];?>" class="cart-button">Add to Cart</a></span> </div>
				     <div class="button"><span><a href="preview.php?product_id=<?php echo $items[0]['ID']; ?>" class="details">Details</a></span></div>
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?product_id=<?php echo $items[1]['ID']; ?>"><img src="<?php echo $items[1]['PATH']; ?>" alt="" height="180" /></a>
					 <h2><?php echo $items[1]['NAME']?></h2>
					 <p><?php echo $items[1]['CATAGORY']?></p>
					 <p><span class="strike"><?php echo $items[1]['PRICE']; ?></span><span class="price"><?php echo $items[1]['DISCOUNT'];?></span></p>
					  <div class="button"><span><img src="images/cart.jpg" alt="" /><a href="cart.php?product_id=<?php echo $items[1]['ID'];?>" class="cart-button">Add to Cart</a></span> </div>
				     <div class="button"><span><a href="preview.php?product_id=<?php echo $items[1]['ID']; ?>" class="details">Details</a></span></div>
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?product_id=<?php echo $items[2]['ID']; ?>"><img src="<?php echo $items[2]['PATH']; ?>" alt="" height="180"/></a>
					 <h2><?php echo $items[2]['NAME']?></h2>
					 <p><?php echo $items[2]['CATAGORY']?></p>
					 <p><span class="strike"><?php echo $items[2]['PRICE']; ?></span><span class="price"><?php echo $items[2]['DISCOUNT'];?></span></p>
					  <div class="button"><span><img src="images/cart.jpg" alt="" /><a href="cart.php?product_id=<?php echo $items[2]['ID'];?>" class="cart-button">Add to Cart</a></span> </div>
				     <div class="button"><span><a href="preview.php?product_id=<?php echo $items[2]['ID']; ?>" class="details">Details</a></span></div>
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?product_id=<?php echo $items[3]['ID']; ?>"><img src="<?php echo $items[3]['PATH']; ?>" alt="" height="180"/></a>
					 <h2><?php echo $items[3]['NAME']?></h2>
					 <p><?php echo $items[3]['CATAGORY']?></p>
					 <p><span class="strike"><?php echo $items[3]['PRICE']; ?></span><span class="price"><?php echo $items[3]['DISCOUNT'];?></span></p>
					  <div class="button"><span><img src="images/cart.jpg" alt="" /><a href="cart.php?product_id=<?php echo $items[3]['ID'];?>" class="cart-button">Add to Cart</a></span> </div>
				     <div class="button"><span><a href="preview.php?product_id=<?php echo $items[0]['ID']; ?>" class="details">Details</a></span></div>
				</div>
			</div>
    </div>
 </div>
 
 
   
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
							  <script defer src="js/jquery.flexslider.js"></script>
							  <script type="text/javascript">
								$(function(){
								  SyntaxHighlighter.all();
								});
								$(window).load(function(){
								  $('.flexslider').flexslider({
									animation: "slide",
									start: function(slider){
									  $('body').removeClass('loading');
									}
								  });
								});
							  </script>

<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>