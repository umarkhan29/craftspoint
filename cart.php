<?php
	require_once('config.khan');
	ob_start();
	require_once(COMPONENTS.SESSION);
	require_once(COMPONENTS.CONNECT);	
	require_once(COMMON.HEADER);
?>
<div style="width:90%; margin:auto; padding:5%; background-color:#CCCCCC;">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php
//adding to cary
	if(isset($_GET['product_id'])){
		$flag=0;
		$product=mysql_real_escape_string(trim(strip_tags(stripslashes($_GET['product_id']))));
		if(!isset($_SESSION['id'])){
			$_SESSION['id']=1;
		}
		foreach($_SESSION as $key => $val){
			if(preg_match("%^['cart_product_']{13,13}[0-9]{1,2}$%",$key)){
				if($val==$product){
					echo '<div style="width:35%; color:green; margin:auto; font-size:18px;">Product already added to Cart </div>';
					$flag=1;
				}
			}
			
			}
			
					//checking stock
		
		$quantity=mysql_query("SELECT `quantity` FROM `products` WHERE `id`='$product'");
												while($row=mysql_fetch_assoc($quantity)){
												$stock[]=array(
													$stock['QUANTITY']=$row['quantity']);
												}
	if(isset($stock['QUANTITY'])){					
				if($stock['QUANTITY']<1){
					echo '<div style="width:35%; color:red; margin:auto; font-size:18px;">Product Out of Stock </div>';
					$flag=1;
				}
			
			
				if($flag==0){
				$key="cart_product_".$_SESSION['id'];
				$_SESSION[$key]=$product;
				$_SESSION['id']=$_SESSION['id']+1;
				header('location:cart.php');
				}
				}
		}

//removing from cart
	if(isset($_POST['removeitembtn'])){
		$id=mysql_real_escape_string(trim(strip_tags(stripslashes($_POST['remove_cart_id']))));
			foreach($_SESSION as $key => $val){
				if($val == $id){
					
					unset($_SESSION[$key]);
					$_SESSION['id']=$_SESSION['id']-1;
				 }
			}
			header('location:cart.php');
	}
?>
<div style="background-color:#70389C; color:#FFFFFF; font-size:36px; padding-left:10%; margin-bottom:15px;">
   My Cart
</div>

<div style="min-height:170px; width:100%; border-bottom:thin solid #333333">

					
					<?php
					
					if(isset($_SESSION['id'])){
					if($_SESSION['id']>1){
						$count=0;
						$query="SELECT * FROM `products` WHERE `id`= ";
						$flag=0; //for checking first element of cart item in session array
						foreach($_SESSION as $key => $val){
							if(preg_match("%^['cart_product_']{13,13}[0-9]{1,2}$%",$key)){
									if($flag!=0){
										$query.=" or `id` = ";
									}
									$query.=$val;
									$flag=1;
								
								}
								}
							
								if($cart_items=mysql_query($query)){
								
									while($row = mysql_fetch_assoc($cart_items)){
												$cart_products[] = array(
													'NAME'				=>	$row['name'],
													'PATH'				=>	$row['path'],
													'ID'				=>	$row['id'],
													'QUANTITY'				=>	$row['quantity'],
													'DISCOUNT'			=>	$row['discount'],
													
												);
												
										$count=$count+1;	
										}			
									}
								
									
								
								
							
								
								?>
								
				<table style="width:70vw; font-size:2vw;">
					<tr>
						<td style=""></td>
						<td style=" color:#6600CC; ">Product</td>
						<td style="color:#6600CC; "> Price </td>
						<td style="color:#6600CC; "> Quantity </td>
						<td style=" color:#6600CC; "> Total </td>
					</tr>
						<?php
					//displaying items
							$total_cost=0;
								for($i=0;$i<$count;$i++){
								
						?>
				
			
					<tr style="border-top:1px dashed #666666;color:#6600CC;">
					<td  ><img src="<?php echo $cart_products[$i]['PATH']; ?>" width="271px" height="150px"/></td>
						<td ><?php echo $cart_products[$i]['NAME']; ?></td>
						<td id="price<?php echo $cart_products[$i]['ID']; ?>" > <?php echo $cart_products[$i]['DISCOUNT']; ?> </td>
						<td style="display:-webkit-inline-box; margin-left:15px;"> <div style="color:#CC0000; cursor:pointer; margin-left:9%;" onClick="quantity_down('<?php echo $cart_products[$i]['ID']; ?>');">-</div>
						
						
						<input type="text"  id="quantity<?php echo $cart_products[$i]['ID']; ?>" value="1" readonly="readonly" style=" border:none; color:#6600CC; background-color:#CCCCCC; font-size:24px; "/>
						
						<div style="color:#CC0000; cursor:pointer; margin-left:-83%;" onclick="quantity_up('<?php echo $cart_products[$i]['ID'];?>','<?php echo $cart_products[$i]['QUANTITY'];?>');">+</div> </td>
						<td ><span id="product_total<?php echo $cart_products[$i]['ID']; ?>"> <?php echo $cart_products[$i]['DISCOUNT']; ?></span>
							<input type="hidden" id="hidden_total<?php echo $i;?>" value="<?php echo $cart_products[$i]['DISCOUNT']; ?>" />
						</td>
						<td>
						<form action="" method="post">
							<input type="hidden" value="<?php echo $cart_products[$i]['ID']; ?>" name="remove_cart_id" />
							<input type="submit" value="" name="removeitembtn"  alt="Remove Item" style=" background-image:url(images/dlt3.jpg); width:30px; height:30px; cursor:pointer;" />
						</form>	
						</td>
					</tr>
					
					<?php
							$total_cost=$total_cost+$cart_products[$i]['DISCOUNT'];
						}
						
					?>
			</table>
		
</div>
		<form action="" method="post">
	
		<div  style="height:10%; padding-top:10px; font-size:18px; padding-bottom:7px; color:#6600CC; background-color:#CCCCCC; padding-left:55vw; border-bottom:thin solid #666666">
					
					Total=<input type="text" name="total_price" id="total_cost" value="<?php echo $total_cost; ?>" readonly="readonly" style="width:50px; height:20px; border:none; color:#6600CC; background-color:#CCCCCC; font-size:18px; "/>
		</div>
		<?php
		}
		
		else{
				echo '<div style="width:35%; color:green; margin:auto; font-size:32px; padding-top:60px;">Cart Empty</div>';
			}
			}
			else{
				echo '<div style="width:35%; color:green; margin:auto; font-size:32px; padding-top:60px;">Cart Empty</div>';
			}
		?>

	
			<div style=" padding-left:75px; background-color:#CCCCCC; padding-top:14px; border-bottom:10px solid #FFFFFF; padding-bottom:14px;">
			<?php
				if(isset($_SESSION['id'])){
					if($_SESSION['id']>1){
					
					for($i=0;$i<$count;$i++){
				?>
				<input type="hidden" id="qty<?php echo $cart_products[$i]['ID']; ?>" name="qty<?php echo $i; ?>" value="1" />
				
				<?php
				}
				?>
					<input type="submit" value="Checkout" name="checkout" style=" margin-left:-75px; background:#FF9900; height:40px; color:#FFFFFF; width:200px;; font-size:22px; cursor:pointer; border:none;" />			
						
				</form>
				
			<?php
				}
				
				}
				
			?>
			
				
				<div style=" margin-left:-75px; margin-top:15px;background:#70389C; padding:5px; width:200px;"><a style=" font-size:22px;  border:none;  cursor:pointer; color:#FFFFFF;" href="index.php">Continue Shopping</a></div>	
			</div>

</div>

<script type="text/javascript">
	function quantity_up(span,total){
		var id='quantity'+span;
		var qty='qty'+span;
		var quantity=parseInt(document.getElementById(id).value);
		if(quantity<total){
			quantity=quantity+1;
			document.getElementById(id).value=quantity;
			document.getElementById(qty).value=quantity;
			var product_total="product_total"+span;
			var price="price"+span;
			var price=parseInt(document.getElementById(price).innerHTML);
			var total=quantity*price;
			document.getElementById(product_total).innerHTML=total;
			
			var total_price=parseInt(document.getElementById('total_cost').value);
			total_price=total_price+price;
			document.getElementById('total_cost').value=total_price;
		}
	}
	
	function quantity_down(span){
	var id='quantity'+span;
	var qty='qty'+span;
	var quantity=parseInt(document.getElementById(id).value);
	if(quantity>1){
		quantity=quantity-1;
		document.getElementById(id).value=quantity;
		document.getElementById(qty).value=quantity;
	var price="price"+span;
	var product_total="product_total"+span;
	var price=parseInt(document.getElementById(price).innerHTML);
	var total=quantity*price;
	document.getElementById(product_total).innerHTML=total;
	
	var total_price=parseInt(document.getElementById('total_cost').value);
	total_price=total_price-price;
	document.getElementById('total_cost').value=total_price;
	}
	
	}
	
	
</script>
<?php

if(isset($_POST['checkout']) and $_POST['total_price']>0){
	$_SESSION['products']="";
	for($i=0;$i<$count;$i++){
		$id="qty".$i;
		$j=$i+1;
		$_SESSION['products'].=$j.")";
		$_SESSION['products'].=$cart_products[$i]['NAME'].",id:".$cart_products[$i]['ID'].",price per item:".$cart_products[$i]['DISCOUNT'].","." qty:".$_POST[$id].",";
		
		$_SESSION['PRODUCT_INFO']=$j.")";
		$_SESSION['PRODUCT_INFO'].=$cart_products[$i]['NAME'].",price per item:".$cart_products[$i]['DISCOUNT'].","." qty:".$_POST[$id].".";
		
	}
$_SESSION['total_price']=$_POST['total_price'];
header('location:shipping_details.php');
}
require_once(COMMON.FOOTER);
ob_end_flush();
?>