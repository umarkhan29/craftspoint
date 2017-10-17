<?php
ob_start();
	require_once('config.khan');
	require_once(COMPONENTS.SESSION);
	if(isset($_SESSION['Authentic&ValidUser'])){
	if($_SESSION['Authentic&ValidUser']=="no"){
		header('location:admin_login.php');
	}
}
else{
		header('location:admin_login.php');
}
	require_once(COMPONENTS.CONNECT);	
	require_once(COMMON.HEADER);
	
?>
<link rel="stylesheet" href="css/admin_style.css" />


<div id="admin_welcome_div" >
    Welcome <?php echo $_SESSION['current_user'] ?> <a href="logout.php" >(Logout)</a> 
</div>
<div id="admin_area">
<?php
require_once(CATALOG.ADMIN_MENU);
?>

<div id="admin_login_section">

    <div class="admin_section_title">
	
		Customers
	</div>  
	<?php
		$count=0;
		if($result=mysql_query("SELECT * FROM `users`")){
			while($row=mysql_fetch_assoc($result)){
				$searchResults[] = array(
							'NAME'			=>	$row['name'],
							'EMAIL'			=>	$row['email'],
							'PHONE' 		=> 	$row['phone'],
						);
						$count=$count+1;
			
			
			}
		}
			
	?>
	<?php
	if($count>0){
	
	$_SESSION['user_results']= $searchResults;
	
	$pages = $count/11;
	$pages=ceil($pages);
	$_SESSION['user_total_pages']=$pages;
	$_SESSION['user_start_product_of_page']=0;
	$last_product=$_SESSION['user_start_product_of_page']+11;
	$_SESSION['user_total_products']=$count;
	if($_SESSION['user_total_products']<$last_product){
				$last_product=$_SESSION['user_total_products'];
			}
	?>
	
	<div class="page-no">
    			<p>Result Pages:<ul>
				<?php
				
				for($i=1;$i<=$pages;$i++){
				?>
					
						
						<li  <?php if($i==1){echo 'class="active"';}?> style="cursor:pointer;" onClick="user_pages('admin_login_section',<?php echo $i; ?>);" ><?php echo $i; ?></li>
						
						
					
    			<?php 
				}
				?>	
    			
    				</ul></p>
    </div>
	
	
<div style="width:100%; min-height:300px; background:#999999;"> 

<table style="width:100%;">
	<tr >
		<td class="user_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">S.No</span></td>
		<td class="user_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Name</span></td>
		<td class="user_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Email</span></td>
		<td class="user_table"><span style="color:#ffffff; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:18px;">Phone</span></td>
	</tr>
	<?php
		
	for($i=$_SESSION['user_start_product_of_page'];$i<$last_product;$i++){
	?>
	<tr >
		<td class="user_table"><?php echo $i+1; ?></td>
		<td class="user_table"><a href="user_details.php?email=<?php echo $searchResults[$i]['EMAIL']; ?>"><?php echo $searchResults[$i]['NAME']; ?></a></td>
		<td class="user_table"><?php echo $searchResults[$i]['NAME']; ?></td>
		<td class="user_table"><?php echo $searchResults[$i]['PHONE']; ?></td>
		
		
	</tr>
	<?php
	}
	}
	?>

</table>

</div>
</div>
</div>

<script type="text/javascript">
function user_pages(thediv,number){


	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	}
	
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			document.getElementById(thediv).innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open('GET','home/catalog/user_pages.php?page_no='+number,true);
	
	document.getElementById('page_content').style.visibility="hidden";
	xmlhttp.send();
	
}

</script>


<?php
require_once(COMMON.FOOTER);
ob_end_flush();

?>