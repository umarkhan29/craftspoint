<?php
	require_once('config.khan');
	require_once(COMPONENTS.CONNECT);
	require_once(COMPONENTS.SESSION);	
	require_once(COMMON.HEADER);
	$catagory="pashmina";
	$design="embroidered";
		$products=mysql_query("SELECT * FROM `products` WHERE `catagory` = '$catagory' and `design` like '%$design%' ") or die("Db error");
		if(isset($_POST['sort_btn'])){
		if($_POST['sort']=="Lowest Price"){
			$products=mysql_query("SELECT * FROM `products` WHERE `catagory` = '$catagory' and `material` like '%$material%' ORDER BY `discount` ASC ") or die("Db error");
		}elseif($_POST['sort']=="Highest Price"){
			$products=mysql_query("SELECT * FROM `products` WHERE `catagory` = '$catagory' and `material` like '%$material%' ORDER BY `discount` DESC ") or die("Db error");
		}
	}
		if($products){
				$count=0;
				while($row = mysql_fetch_assoc($products)){
						$items[] = array(
							'PATH'		=>	$row['path'],
							'ID'		=>	$row['id'],
							'DESC'		=>	$row['discription'],
							'NAME'		=>	$row['name'],
							'DISCOUNT'		=>	$row['discount'],
							'CATAGORY'		=>	$row['catagory'],
							'PRICE'		=>	$row['price']
							
						);
					$count=	$count+1;
				}
			
			}
			else{
				echo "No Produsts avaliable";
			}
			
		?>

<?php
	if($count>0){
	
	$_SESSION['Total_results']= $items;
	
	$pages = $count/12;
	$pages=ceil($pages);
	$_SESSION['total_pages']=$pages;
	$_SESSION['start_product_of_page']=0;
	$last_product=$_SESSION['start_product_of_page']+12;
	$_SESSION['total_products']=$count;
	if($_SESSION['total_products']<$last_product){
				$last_product=$_SESSION['total_products'];
			}
	
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Embroidered Pashmina</h3>
    		</div>
    		<div class="sort">
    		<p>Sort by:
			<form action="" method="post">
    			<select name="sort" style="height:35px;background-color:#fff;color:#999999;border:1px #DFDFDF solid;border-radius:5px;font-family:Arial, Helvetica, sans-serif;font-size:18px;margin-top:7px;padding:7px;">
    				<option>Lowest Price</option>
    				<option>Highest Price</option>
    				 				   				
    			</select>
				<input type="submit"  value="Sort" name="sort_btn" style="border: none;cursor: pointer; color: #FFF;font-size: 16px; padding: 6px 12px;height:30px;background:#70389C; border-radius:3px;"/>
				</form>
    		</p>
    		</div>
    		
    		<div class="page-no">
    			<p>Result Pages:<ul>
				<?php
				
				for($i=1;$i<=$pages;$i++){
				?>
					<form action="" method="GET">
						
						<li  <?php if($i==1){echo 'class="active"';}?> style="cursor:pointer; " onClick="searchp('search_div',<?php echo $i; ?>);" ><?php echo $i; ?></li>
						<input type="hidden" id="page_no" value="<?php echo $i; ?>"/>
						
					</form>
    			<?php 
				}
				?>	
    			
    				</ul></p>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		  

		  	<?php
				
				for($i=$_SESSION['start_product_of_page'];$i<$last_product;$i++){
					
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?product_id=<?php echo $items[$i]['ID']?>"><img src="<?php echo $items[$i]['PATH'];?>" height="180" alt="" /></a>
					 <h2><?php echo $items[$i]['NAME'];?></h2>
					 <p><?php echo $items[$i]['CATAGORY'];?></p>
					 <p>Rs <span class="strike"><?php echo $items[$i]['PRICE']?></span><span class="price"><?php echo $items[$i]['DISCOUNT'];?></span></p>
					  <div class="button"><span><img src="images/cart.jpg" alt="" /><a href="cart.php?product_id=<?php echo $items[$i]['ID'];?>" class="cart-button">Add to Cart</a></span> </div>
				     <div class="button"><span><a href="preview.php?product_id=<?php echo $items[$i]['ID'];?>" class="details">Details</a></span></div>
				</div>
			
			<?php
				} //close for
				
				} //close if
			?>
			
			
			
    		
    		
    		<div class="clear"></div>
    	</div>
			
    </div>
 </div>
<div>
</div>

<?php
require_once(COMMON.FOOTER);
?>







