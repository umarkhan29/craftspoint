
<?php
require_once('../../config.khan');
ob_start();
require_once('../components/session.khan');
if(isset($_GET['page_no'])){
	
		$_SESSION['admin_start_product_of_page']=$_GET['page_no']-1;
		$_SESSION['admin_start_product_of_page']=$_SESSION['admin_start_product_of_page']*5;
		$last_product=$_SESSION['admin_start_product_of_page']+5;
		 $searchResults=$_SESSION['admin_results'];
		 $pages=$_SESSION['admin_total_pages'];
		 
		 
		if($_SESSION['admin_total_products']<$last_product){
				$last_product=$_SESSION['admin_total_products'];
			}
	}


?>

<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>UNREGISTERED CUSTOMERS</h3>
    		</div>
    	
    		
    		<div class="page-no">
    			<p>Result Pages:<ul>
				
				<div style="height:20px;">
				<?php
				
				for($i=1;$i<=$pages;$i++){
				?>
					
						<li <?php if($i==$_GET['page_no']){echo 'class="active"';}?> style="cursor:pointer;" onClick="admin_pages('admin_login_section',<?php echo $i; ?>);" ><?php echo $i; ?></li>
					
    			<?php 
				}
				?>	
    			</div>
    				</ul></p>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		  

		  	<div style="width:100%; min-height:300px; background:#999999;"> 

<table style="width:100%;">
	<tr >
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">S.No</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Email</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Phone</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Product Name</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Price</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Sold On</span></td>
		<td class="user_details_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Address</span></td>
	</tr>
	<?php
		
	for($i=$_SESSION['admin_start_product_of_page'];$i<$last_product;$i++){
	?>
	<tr >
		<td class="unreg_customer_details_table"><?php echo  $i+1;?></td>
		<td class="unreg_customer_details_table"><?php echo $searchResults[$i]['EMAIL'];?></td>
		<td class="unreg_customer_details_table"><?php echo $searchResults[$i]['PHONE'];?></td>
		<td class="unreg_customer_details_table"><?php echo $searchResults[$i]['PRODUCT']; ?></td>
		<td class="unreg_customer_details_table"><?php echo $searchResults[$i]['PRICE']; ?></td>
		<td class="unreg_customer_details_table"><?php echo $searchResults[$i]['SOLD_ON'];?></td>
		<td class="unreg_customer_details_table"><?php echo $searchResults[$i]['SHIPPING'];?></td>
		
	</tr>
	<?php
	}
	
	?>

</table>

			
			
			
    		
    		
    		<div class="clear"></div>
    	</div>
			
    </div>
 </div>
<div>

<?php
ob_end_flush();
?>