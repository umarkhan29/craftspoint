 <?php
 ob_start();
 ?>
 <div id="preview_image" style="position:fixed;border:solid 1px black;  margin-left:10%;  z-index:5; visibility:hidden; ">
	<div style="border:width:100%; height:42px; background:#CC0000">
		<div style="float:left;color:white; ;padding:7px; font-size:24;">Preview Product
		</div>
		<div style="float:right;color:white; background:#990000;  height:27px; cursor:pointer; border-left:1px solid black; border-bottom:1px solid black; padding:7px; font-size:22px;" onclick="hide_popup();">X</div>
	</div>
	
	<div>
		<div  style="overflow:auto; max-height:560px;"><img src="" id="popup_img" /></div>
	
		<div id="popup_desc" style="background:#CC0000; color:#FFFFFF; font-size:28px; cursor:pointer; padding:5px; float:left;" onclick="zoomin();">
			+
		</div>		
			
		<div id="popup_desc" style="background:#CC0000; color:#FFFFFF; font-size:28px; cursor:pointer; padding:5px; float:right;" onclick="zoomout();">
			-
		</div>
	
	</div>
 </div>
 
  <div id="main_page">
 
 
 <?php

	require_once('config.khan');
	require_once(COMPONENTS.CONNECT);
	require_once(COMPONENTS.SESSION);	
	 ob_start();
	require_once(COMMON.HEADER);
	$_SESSION['current__user']="Umar";
?>
<script type="text/javascript">

function zoomin(){
document.getElementById('popup_img').style.zoom="2";
document.getElementById('preview_image').style.margin="auto";
}

function zoomout(){
document.getElementById('popup_img').style.zoom="0.2";
document.getElementById('preview_image').style.margin="auto !important";

}
function popup(path,id){
	document.getElementById('preview_image').style.visibility="visible";
	document.getElementById('popup_img').src=path;
	//document.getElementById('popup_desc').innerHTML=id;
	document.getElementById('main_page').style.opacity="0.2";
	document.getElementById('main_page').style.pointerEvents = "none";
	
	
	
}

function hide_popup(){
	document.getElementById('preview_image').style.visibility="hidden";
	document.getElementById('main_page').style.visibility="visible";
	document.getElementById('main_page').style.opacity="1";
	document.getElementById('main_page').style.pointerEvents = "auto";
	
	
}
</script>

<?php
$product_details;
$product=mysql_real_escape_string(trim(strip_tags(stripslashes($_GET['product_id']))));
if($item=mysql_query("SELECT * FROM `products` WHERE `id` = '$product'") or die("Db error")){
$item=mysql_fetch_assoc($item);
$product_details []=array(
							'PRODUCT_NAME'			=>	$item['name'],
							'PRODUCT_ID'			=>	$item['id'],
							'PRODUCT_PATH'			=>	$item['path'],
							'PRODUCT_DESC'			=>	$item['discription'],
							'PRODUCT_SIZE'			=>	$item['size'],
							'PRODUCT_PRICE'			=>	$item['discount'],
							'PRODUCT_CATAGORY'		=>	$item['catagory'],
							'PRODUCT_MATERIAL'			=>	$item['material'],
							'PRODUCT_DESIGN'		=>	$item['design'],
							'PRODUCT_QUANTITY'		=>	$item['quantity']
							
						);
			
}
else{
die("Query Error");
}
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		
    		
    		<div class="clear"></div>
    	</div>
    	<div class="section group">
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2" style="cursor:pointer;" onclick="popup('<?php echo $product_details[0]['PRODUCT_PATH'];?>','<?php echo $product_details[0]['PRODUCT_ID'];?>');">
						<img src="<?php echo $product_details[0]['PRODUCT_PATH'];?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<div class="product-desc"><h2>Name</h2></div>
					<h2><?php echo $product_details[0]['PRODUCT_NAME'];?> </h2>
					
					<div class="product-desc"><h2>Product Type</h2></div>
					<h2><?php echo $product_details[0]['PRODUCT_CATAGORY'];?> </h2>


					<div class="product-desc"><h2>Material</h2></div>
					<h2><?php echo $product_details[0]['PRODUCT_MATERIAL'];?> </h2>
					
					<?php
						if(!$product_details[0]['PRODUCT_DESIGN']==""){
					?>
						<div class="product-desc"><h2>Design</h2></div>
						<h2><?php echo $product_details[0]['PRODUCT_DESIGN'];?> </h2>
					<?php
						}
					?>
					
					
					<div class="product-desc"><h2>Size</h2></div>
					<h2><?php echo $product_details[0]['PRODUCT_SIZE'];?>(Feet) </h2>
					
					
					
						
					<div class="price">
						<p>Price: <span><?php echo $product_details[0]['PRODUCT_PRICE'];?></span></p>
					</div>
					
					
					
					<div class="available">
						
							<div class="price">
						<p>Avaliability: <span><?php if($product_details[0]['PRODUCT_QUANTITY']>0){echo "In Stock";}else{echo "Out of Stock";} ?></span></p>
					</div>
					</div>
					<?php
						if($product_details[0]['PRODUCT_QUANTITY']>0){
					?>
				<div class="add-cart">
					
					<div class="button"><span><a href="cart.php?product_id=<?php echo $product_details[0]['PRODUCT_ID'];?>">Add to Cart</a></span></div>
					<div class="clear"></div>
				</div>
					<?php
				}
				?>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $product_details[0]['PRODUCT_DESC'];?></p>
	    </div>
	   				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
				      <li><a href="chain_stitch.php">Chain Stitch</a></li>
				      <li><a href="pashmina.php">Pashmina</a></li>
				      <li><a href="carpets.php">Carpets</a></li>
				      <li><a href="curtains.php">Curtains</a></li>
				      <li><a href="cushions.php">Cushions</a></li>
					   
						 <li><a href="papermachie.php">Paper Machie</a></li>				      
    				</ul>
    				<div class="subscribe">
    					<h2>Newsletters Signup</h2>
    						<p>Subscribe to our Newsletters</p>
						    <div class="signup">
							    <form action="subscribe.php" method="POST">
							    	<input type="text" name="subscribe_email" placeholder="E-mail address" />
									<input type="submit" value="Sign up" name="btn">
							    </form>
						    </div>
      				</div>
      	 		</div>
 	</div>
	</div>
</div>
 	
<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>
</div>