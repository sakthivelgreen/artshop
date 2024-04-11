<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<title>Arts shop - Message</title>


	<head>

		<link rel="stylesheet" href="jquery-ui/development/themes/base/jquery.ui.all.css">
		<script src="jquery-ui/development/jquery-1.5.1.js"></script>
		<script src="jquery-ui/development/external/jquery.bgiframe-2.1.2.jss"></script>
		<script src="jquery-ui/development/ui/jquery.ui.core.js"></script>
		<script src="jquery-ui/development/ui/jquery.ui.widget.js"></script>
		<script src="jquery-ui/development/ui/jquery.ui.mouse.js"></script>
		<script src="jquery-ui/development/ui/jquery.ui.draggable.js"></script>
		<script src="jquery-ui/development/ui/jquery.ui.position.js"></script>
		<script src="jquery-ui/development/ui/jquery.ui.resizable.js"></script>
		<script src="jquery-ui/development/ui/jquery.ui.dialog.js"></script>
		<link rel="stylesheet" href="jquery-ui/development/demos/demos.css">
		<script>
			$(function () {
				// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
				$("#dialog:ui-dialog").dialog("destroy");

				$("#dialog-modal").dialog({
					height: 140,
					modal: true
				});
			});
		</script>
	</head>

<body>

	<div id="templatmeo_content">
		<div class="demo">
			<div id="dialog-modal" title="Message">
				<center>
					<p>
						<?php
						session_start();
						require (__DIR__ . "/functions.php");
						if (isset($_POST['submit'])) {
							$high = $_POST['high'];
							$art_id = $_SESSION['prodid'];
							$bidamount = $_POST['bidamount'];
							($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE art_id = '$art_id'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
							$prod = mysqli_fetch_array($query);
							$duedate = $prod['due_date'];
							$userid = $_SESSION['ID'];
							($query2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM customer WHERE customer_id = '$userid'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
							$user = mysqli_fetch_array($query2);
							$bidder_id = $user['customer_id'];
							$prodname = $prod['art_name'];
							$currentDateTime = date("Y-m-d H:i:s");
							if ($currentDateTime < $duedate) {
								if ($bidamount > $high) {
									mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO bidreport(art_id,customer_id,biddatetime,bidamount,art_status) VALUES ('$art_id','$bidder_id',now(),'$bidamount','onSale')");
									echo "Congratulations " . $_SESSION['user'] . "! You are the highest bidder for Item " . $prodname . "<br /><br /><a href='details.php?id=" . $art_id . "'>Back</a>";
								} elseif ($bidamount <= $high) {
									echo "Your Bid is not counted for the amount is lower than the highest bid or does not exceed the starting bid<br /><br /><a href=details.php?id=" . $art_id . ">Back</a>";
								}
							} else {
								echo 'Bidding already closed <a href=home.php?">Back to home</a>';
							}
						}

						?>
					</p>
					<p></a></p>
				</center>
			</div>
		</div>
	</div>




</body>

</html>