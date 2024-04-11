<?php
	require(__DIR__ . "/../db.php");
	$bidid = $_POST['id'];
	mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE bidreport SET art_status = 'sold' WHERE bidid = '$bidid'") || die (mysqli_error($GLOBALS["___mysqli_ston"]));
?>