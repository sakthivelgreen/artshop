<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
	<title>Online Auction Zone - Message</title>
 
<head>			
</head>
<body>
    
    <div id="templatmeo_content">
		<div class="demo">
			<div id="dialog-modal" title="Message">
				<center>
				<p><?php
	session_start();
	require(__DIR__ . "/functions.php");
	$id = $_GET['id'];
	echo $id;
	echo "This product is no longer available<br /><br /><a href=home.php>Back</a>";
?></p>
				<p></a></p>
				</center>
			</div>
		</div>
	</div>
       
    
   
    
</body>
</html>
