<?php
	require(__DIR__ . "/../db.php");
	$bidid = $_POST['id'];
	mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE bidreport SET art_status = 'sold' WHERE bidid = '$bidid'") || die (mysqli_error($GLOBALS["___mysqli_ston"]));
	
?>
<?php ($bidnum = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM bidreport LEFT JOIN customer ON customer.customer_id = bidreport.bidder LEFT JOIN art_details ON art_details.art_id = bidreport.art_id WHERE bidreport.status = 0")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
			$count = 0;
			WHILE($stat = mysqli_fetch_array($bidnum)){
				$count++;
			}
			echo $count;
	
?>