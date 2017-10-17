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
		Send a Newsletter
	</div>    
	
	

<script type="text/javascript" src="jquery-1.2.6.min.js">

</script>
<?php

require_once ('myeditor/editor.khan');
if(isset($_POST['editedText'])){

if($_POST['editedText']!=""){
		$text = $_POST['editedText'];

		
	
		$result=mysql_query("SELECT * FROM `newsletters`") or die(header('location:error.php?token=dbt'));
		if($result){
				
				while($row = mysql_fetch_assoc($result)){
						
						//send mail here
						$header="From:Craftspoint.in\r\n";
						$header.="MIME-Version:1.0\r\n";
						$header.="Content-Type:text/html;charset=ISO-8859-1\r\n";
						mail($row['email'],"Craftspoint Promotions",$text,$header);
						$i=$i+1;
				}
			// noe $search_slide_Results contains whole slide db table
			}
			
		}
		else{
			echo '<div style="font-family:Arial, Helvetica, sans-serif; padding:5px; color:red"> Enter Text to send</div>';
		}	
	

}

?>
<form action="" method="post">
	<textarea id="editedText" name="editedText" style="display:none;" readonly="readonly">
		
	</textarea>
	<input type="submit" id="sndnewsletter" onclick="return getEditedText();" value="Send">
</form>

<script type="text/javascript">
	function getEditedText(){
		var text = myEditor.document.body.innerHTML;
		document.getElementById('editedText').innerHTML = text;
		document.forms[0].submit();
	}
</script>







</div>

</div>
<div style="height:7px; width:100%;" > </div>


<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>