<!DOCTYPE HTML>
<html>
<head>
<title> Kashmir Arts | Error</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="The free Poses-404 Iphone web template, Andriod web template, Smartphone web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/error.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div class="wrap">
	<h1>Craftspoint.in</h1>
	<div class="banner">
		<img src="images/banner.png" alt="" />
	</div>
	<div class="page">
	<?php
		if(isset($_GET['token'])){
			if($_GET['token']=="dbt"){
			?>
			<h2>Something is wrong with Database.<br>We are working on it.<br>Visit this page soon. </h2>
			<?php
			}
		}else{
		
	?>
		<h2>We can't find the page you requested for!<br>Check your request and try again.</h2>
		
		<?php } ?>
	</div>
	<div class="footer">
		<p>Go back to <a href="index.php">Crafts Point</a></p>
	</div>
</div>
</body>
</html>

