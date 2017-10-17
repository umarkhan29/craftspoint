<?php
	ob_start();
	require_once('config.khan');
	require_once(COMPONENTS.CONNECT);
	require_once(COMPONENTS.SESSION);	
	require_once(COMMON.HEADER);
	
	if(isset($_GET['video_id'])){
		$id=mysql_real_escape_string(trim(strip_tags(stripslashes($_GET['video_id']))));
		$video=mysql_query("SELECT * FROM `videos` WHERE `id` ='$id' ") or die(header('location:error.php?token=dbt'));
			if($video){
					
					while($row = mysql_fetch_assoc($video)){
							$video_results[] = array(
								'PATH'		=>	$row['path'],
								'ID'		=>	$row['id'],
								'DESC'		=>	$row['discription'],
								'NAME'		=>	$row['name']
								
							);
						
					}
				
				}
				else{
					//  show error(no data in database)
				}
}
else{
		//no video selected
}
?>


   
    <div id="video">
      <iframe src="<?php echo $video_results[0]['PATH'];?>" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
    </div>
  </div>
  <div style="clear:both"></div>
  
  <div>
					
					 <h1 style="margin: 0;padding: 7px;border: 0;font-size: 24px;background:transparent; color:#602D8D; border-bottom:1px dashed #602D8D;"> <?php echo $video_results[0]['NAME'];?> </h1>
					
					
			
					 <h2 style="margin: 0;padding-left: 50px; padding-top:7px; color:#602D8D; font-size:18px;">Description</h2>
					 
					
					 <p style="margin: 0;padding-left: 50px; color:#747474; width:45%;" ><?php echo $video_results[0]['DESC'];?></p>
					
	</div>
				
				
 	
 
  
  <div style="clear:both; height: 40px"></div>
</div>



<?php
require_once(COMMON.FOOTER);
ob_end_flush();
?>