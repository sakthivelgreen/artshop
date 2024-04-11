<?php
session_start();
if ($_SESSION['isvalid'] != "true") {
	header("location:index.php");
}
require(__DIR__ . "/../db.php");
function cats()
{
	($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `art_categories`")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
	echo "<select name ='category'>";
	echo "<option>Select Category</option>";
	while ($row = mysqli_fetch_array($query)) {

		echo "<option value='" . $row['categoryid'] . "'>" . $row['categoryname'] . "</option>";
	}
	echo "</select>";
}
function artists()
{
	($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `artist`")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
	echo "<select name ='artist'>";
	echo "<option>Select Artist</option>";
	while ($row = mysqli_fetch_array($query)) {
		echo "<option value='" . $row['artist_id'] . "'>" . $row['artist_name'] . "</option>";
	}
	echo "</select>";
}
if (isset($_POST['prodsave'])) {
	$artist_id = $_POST['artist'];
	$art_name = $_POST['art_name'];
	$startingbid = $_POST['starting_bid'];
	$price = $_POST['price'];
	$category = $_POST['category'];
	$descrpt = $_POST['descrpt'];
	// Retrieve due date and time from form
	$due_date = $_POST['due_date'];
	$due_time = $_POST['due_time'];

	// Concatenate due date and time
	$due_datetime = $due_date . ' ' . $due_time;

	// Convert due date and time to timestamp
	$fdate = strtotime($due_datetime);

	// Set due date
	$duedate = date('Y-m-d H:i:s', $fdate);
	// $datenow = date("F j, Y, g:i a");
	$art_imagename = $_FILES["image"]["name"];
	$type = $_FILES["image"]["type"];
	$size = $_FILES["image"]["size"];
	$temp = $_FILES["image"]["tmp_name"];
	$error = $_FILES["image"]["error"];
	mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO art_details(artist_id,art_name,category_id,art_description,starting_bid,art_image,price,date_posted,due_date,art_status,bidding_status) 
		VALUES ('$artist_id','$art_name','$category','$descrpt','$startingbid','$art_imagename','$price',NOW(),'$duedate','onSale','open')") || die(mysqli_error($GLOBALS["___mysqli_ston"]));
	echo "Product has been successfully added to database!!!<br>";
	if ($error > 0) {
		die("Error uploading file! Code $error.");
	} elseif ($size > 10000000) {
		//conditions for the file
		die("Format is not allowed or file size is too big!");
	} else {
		move_uploaded_file($temp, "images/products/" . $art_imagename);
	}
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Arts Shop - Administrator</title>

	<link type="text/css" href="./style.css" rel="stylesheet" />

	<script type='text/javascript' src='./js/jquery-1.4.2.min.js'></script>
	<script type='text/javascript' src='./js/jquery-ui-1.8.5.custom.min.js'></script>
	<script type='text/javascript' src='./js/cufon-yui.js'></script>
	<script type='text/javascript' src='./js/colaboratelight_400.font.js'></script>
	<script type='text/javascript' src='./js/easytooltip.js'></script>
	<script type='text/javascript' src='./js/visualize.jquery.js'></script>
	<script type='text/javascript' src='./js/iphone-style-checkboxes.js'></script>
	<script type='text/javascript' src='./js/custom.js'></script>
	<meta charset="UTF-8">
</head>

<body>
	<div id="container">
		<div id="bgwrap">
			<div id="primary_left">
				<div id="menu"> <!-- navigation menu -->
					<ul>
						<li><a href="bids.php" class="dashboard"><img src="icons/2.png" alt /><span class="current">Bids</span></a></li>
						<li class="showme"><a href="#" class="dashboard"><img src="icons/46.png" alt /><span class="current">Manage Users</span></a>
							<ul class="showoff">
								<li><a href="manage_artists.php">Manage Artists</a></li>
								<li><a href="manage_users.php">Manage Users</a></li>
							</ul>
						</li>
						<li class="current"><a href="#"><img src="icons/36.png" alt /><span>Products</span></a>
							<ul class='showoff'>
								<li><a href="add_prodven.php">New Product</a></li>
								<li><a href="view_products.php">Manage Product</a></li>
								<li><a href="addcategory.php">New Product Category</a></li>
							</ul>
						</li>
						<li class="showme"><a href="orders_received.php" class="dashboard"><img src="icons/check.png" alt /><span class="current">Orders</span></a></li>
						<li><a href="#"><img src="./assets/icons/small_icons_3/settings.png" alt /><span>Account</span></a>
							<ul>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div> <!-- navigation menu end -->
			</div> <!-- sidebar end -->

			<div id="primary_right">
				<div class="inner">




					<div class="two_third column">
						<h5>Add New Product</h5>
						<div id="bodycon">
							<form method="post" name="prodform" id="prodform" action="" enctype='multipart/form-data'>
								<div id="textcon">
									<p>Product Name:</p><br />
									<p>Starting Bid:</p><br />
									<p>Regular Price:</p><br />
									<p>Category:</p><br />
									<p>Artist:</p><br />
									<p>Due Date:</p><br />
									<p>Due Time:</p><br />
									<p>Product Description:</p><br /><br /><br />
									<p>Product Image:</p><br />
								</div>&nbsp;
								<div id="inputcon">
									<ul><input type="text" name="art_name" class="namewidth" /></ul>
									<p><input type="text" name="starting_bid" class="namewidth" /></p>
									<p><input type="text" name="price" class="namewidth" /></p>
									<p>
										<?php cats(); ?>
									</p>
									<p>
										<?php artists(); ?>
									</p>
									<input type="date" name="due_date" class="namewidth" />
									<input type="time" name="due_time" class="namewidth" />
									<p><textarea name="descrpt" class="namewidth" /></textarea></p>
									<p><input type="file" name="image" class="namewidth" /></p>
									<br />
									<p><input type="submit" name="prodsave" value="Save Product" /></p>
								</div>
							</form>

						</div>
					</div>

					<div class="one_third last column">
						<h5></h5>
					</div>
					<hr />
					<HR>
					<HR />
					<div class="clearboth"></div>
				</div><!-- three_fourth last -->
			</div>
			<div class="clearboth" style="padding-bottom:20px;"></div>
		</div> <!-- inner -->
	</div> <!-- primary_right -->
	</div> <!-- bgwrap -->
	</div> <!-- container -->
</body>

</html>