<?php  
	$conn = ($GLOBALS["___mysqli_ston"] = mysqli_connect('localhost',  'root',  '','arts_shop'));
	 if (!$conn)
    {
	 die('Could not connect: ' . mysqli_error($GLOBALS["___mysqli_ston"]));
	}
	
?>