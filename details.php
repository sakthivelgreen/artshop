<?php
session_start();
require (__DIR__ . "/functions.php");
require (__DIR__ . "/db.php");
require (__DIR__ . "/htmls.php");

headhtml();
$duedate = "2024-03-18 00:00:00";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div id="main_content">
	<div id="menu_tab">
		<div class="left_menu_corner"></div>
		<ul class="menu">
			<li><a href="home.php" class="nav2">Home</a></li>
			<li class="divider"></li>
			<li><a href="prodcateg.php" class="nav1">Products</a></li>
			<li class="divider"></li>
			<li><a href="contact.php" class="nav2">About Us</a></li>
			<li class="divider"></li>
			<?php account(); ?>
			<script type='text/javascript'>
				jQuery(document).ready(function () {
					jQuery('.nav3').hide();
					jQuery('.nav4').click(function () {
						jQuery('.nav3').toggle('fade');
					});
				});
			</script>

		</ul>
		<div class="right_menu_corner"></div>
	</div>
	<!-- end of menu tab -->
	<div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>
	<div class="left_content">
		<div class="title_box">Categories</div>
		<ul class="left_menu">
			<?php
			categories();
			// logform();
			?>
			
	</div>
	<!-- end of left content -->
	<?php
	$id = $_GET['id'];
	($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE art_id = '$id'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
	$row = mysqli_fetch_array($query);
	?>
	<script>
		function showImagePreview(imageSrc) {
			var previewImage = document.getElementById("previewImage");
			previewImage.src = imageSrc;
			document.getElementById("imagePreviewPopup").style.display = "block";
		}

		function hideImagePreview() {
			document.getElementById("imagePreviewPopup").style.display = "none";
		}
	</script>
	<div class="center_content">
		<div class="center_title_bar">Product Details</div>
		<div class="prod_box_big">
			<div class="top_prod_box_big"></div>
			<div class="center_prod_box_big">
				<div class="product_img_big">
					<a href="#"
						onclick="showImagePreview('administrator/images/products/<?php echo $row['art_image']; ?>')"
						title="Click to Preview">
						<img src='administrator/images/products/<?php echo $row['art_image']; ?>' width='169'
							height='155' alt='' border='0' />
					</a>
					<br><br>
					<div class='bid_border_box'>
						<div class='bid'><a href="#" style="text-decoration: none;" class="product_title">Click to Bid
								Now</a></div>
					</div>
					<div class='bid_border_box'>
						<div class='details'><a href="#" style="text-decoration: none;" class="product_title">Click to
								View Details</a></div>
					</div>
				</div>
				<div id="imagePreviewPopup">
					<img id="previewImage" src="" alt="Image Preview">
					<span onclick="hideImagePreview()">Close</span>
				</div>

				<script type='text/javascript'>
					jQuery(document).ready(function () {

						jQuery('.bid_box').hide();
						jQuery('.details').hide();

						jQuery('.details').click(function () {
							jQuery('.proddet').toggle('fade');
							jQuery('.bid').toggle('fade');
							jQuery('.bid_box').hide()
							jQuery('.details').hide();
						});
						jQuery('.bid').click(function () {
							jQuery('.details').toggle('fade');
							jQuery('.bid_box').toggle('fade');
							jQuery('.bid').hide();
							jQuery('.proddet').hide();
						});
					});
				</script>


				<div class="details_big_box">
					<div class='proddet'>
						<div class="product_title_big">
							<?php echo $row['art_name']; ?>
						</div><br />
						<div class="specificationss"> Description: <span class="blue">
								<?php echo $row['art_description']; ?>
							</span><br /><br />
							Date Added: <span class="blue">
								<?php echo $row['date_posted']; ?>
							</span><br /><br />
							Item number: <span class="blue">
								<?php echo '' . $row['art_id'] . ''; ?>
							</span><br /><br />
							Category: <span class="blue">
								<?php
								$categid = $row['category_id'];
								($categ = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_categories WHERE categoryid = '$categid'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
								$catega = mysqli_fetch_array($categ);
								echo $catega['categoryname'];
								?>
							</span><br /><br />
							Artist Name: <span class="blue">
							<?php 
								$ArtistID = $row['artist_id']; 
								$query = mysqli_query($GLOBALS['___mysqli_ston'],"SELECT artist_name FROM artist WHERE artist_id = '$ArtistID' ");
								$artistQ = mysqli_fetch_array($query);
								echo $artistQ['artist_name'];
								?>
							</span>

						</div>
					</div>
					<div class='bid_box'>
						<?php
						$id = $_GET['id'];
						$_SESSION['prodid'] = $id;
						($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE art_id = '$id'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
						$row = mysqli_fetch_array($query);
						$prodid = $row['art_id'];
						$prodsbid = $row['starting_bid'];
						$duedate = $row['due_date'];


						//for displaying highest bid and no of bidders
						($query2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM bidreport WHERE art_id = '$prodid'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
						$noofbidders = mysqli_num_rows($query2);

						$highbid = $prodsbid;
						while ($highonthis = mysqli_fetch_array($query2)) {
							$checkthis = $highonthis['bidamount'];
							if ($checkthis > $highbid) {
								$highbid = $checkthis;
							}
						}

						($highestbidder = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM bidreport WHERE bidamount = '$highbid'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
						$highestbiddera = mysqli_fetch_array($highestbidder);
						if (empty ($highestbiddera)) {
							$hibidder = " ";
						} else {
							$hibidder = $highestbiddera['customer_id'];
						}

						if ($_SESSION['logged'] == 'notactive' || $_SESSION['logged'] == 'guest') {
							echo "<span class='blue'><p>To participate in Auction, Please <a class='product_title' style='text-decoration: none;' href='login.php'>Log-In or Register</a></p></span>";
						} else {

							echo "</span>
								<br />
								&nbsp&nbsp Bids: <span class='blue'>"; ?>
							<?php echo $noofbidders; ?>
							<?php echo "</span><br /><br />
								&nbsp&nbsp Highest Bid: <span class='blue'>Rs."; ?>
							<?php echo $highbid; ?>
							<?php echo "</span><br /><br />
								&nbsp&nbsp Due Date: <span class='blue'>"; ?>
							<?php echo $duedate; ?>
							<?php echo "</span><br /><br />
								&nbsp&nbsp Highest Bidder: <span class='blue'>"; ?>
							<?php
							($name = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM customer WHERE customer_id = '$hibidder'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
							$namea = mysqli_fetch_array($name);
							if (empty ($namea)) {
								$namea = "";
							} else {
								echo $namea['userid'];
							}
							?>
							<?php echo "</span><br /><br />
								&nbsp&nbsp Time Left to Bid: <span class='blue'>"; ?>
							<?php


							$closedate = date_format(date_create($duedate), 'm/d/Y H:i:s');

							?>

							<script language="JavaScript">
								TargetDate = "<?php echo $closedate ?>";
								BackColor = "";
								ForeColor = "navy";
								CountActive = true;
								CountStepper = -1;
								LeadingZero = true;
								DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
								FinishMessage = "Bidding closed!";
							</script>
							<script language="JavaScript">
								function calcage(secs, num1, num2) {
									s = ((Math.floor(secs / num1)) % num2).toString();
									if (LeadingZero && s.length < 2)
										s = "0" + s;
									return "<b>" + s + "</b>";
								}
								
								function CountBack(secs) {
									if (secs < 0) {
										document.getElementById("cntdwn").innerHTML = FinishMessage;
										// JavaScript/jQuery function to call PHP function from details.php file
										window.location.href = 'update_status.php?action=udpatestatus&id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>';
										return;
									}
									DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs, 86400, 100000));
									DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs, 3600, 24));
									DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs, 60, 60));
									DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs, 1, 60));

									document.getElementById("cntdwn").innerHTML = DisplayStr;
									if (CountActive)
										setTimeout("CountBack(" + (secs + CountStepper) + ")", SetTimeOutPeriod);
								}

								function putspan(backcolor, forecolor) {
									document.write("<span id='cntdwn' style='background-color:" + backcolor +
										"; color:" + forecolor + "'></span>");
								}

								if (typeof (BackColor) == "undefined")
									BackColor = "white";
								if (typeof (ForeColor) == "undefined")
									ForeColor = "black";
								if (typeof (TargetDate) == "undefined")
									TargetDate = "12/31/2020 5:00 AM";
								if (typeof (DisplayFormat) == "undefined")
									DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
								if (typeof (CountActive) == "undefined")
									CountActive = true;
								if (typeof (FinishMessage) == "undefined")
									FinishMessage = "";
								if (typeof (CountStepper) != "number")
									CountStepper = -1;
								if (typeof (LeadingZero) == "undefined")
									LeadingZero = true;


								CountStepper = Math.ceil(CountStepper);
								if (CountStepper == 0)
									CountActive = false;
								var SetTimeOutPeriod = (Math.abs(CountStepper) - 1) * 1000 + 990;
								putspan(BackColor, ForeColor);
								var dthen = new Date(TargetDate);
								var dnow = new Date();
								if (CountStepper > 0)
									ddiff = new Date(dnow - dthen);
								else
									ddiff = new Date(dthen - dnow);
								gsecs = Math.floor(ddiff.valueOf() / 1000);
								CountBack(gsecs);

							</script>

							<?php echo '</span><br /><br />
									<form method = "post" action="bidconfirm.php?id=' . $prodid . '" id="logins-form" class="logins-form">
										<input type = "hidden" value="' . $highbid . '" name="high">
										&nbsp&nbsp <strong>Enter Amount </strong><input type="text" id="amontbox" name="bidamount">
										<input type="submit" value="Place Bid" name="submit">
									</form>
								&nbsp&nbsp <span class="blue"><strong>';
							echo "<span class='blue'>(Enter Price higher than Rs." . $highbid . ")</span>";
							echo "<br />&nbsp&nbsp&nbsp&nbsp<span class='blue'> click <a rel='facebox' href='bidlog.php?id=" . $prodid . "'>here</a> to view Bidding Log</span>";
						}
						?>
					</div>

				</div>

				<div class="bottom_prod_box_big"></div>
			</div>
		</div>
	</div>
	<!-- end of center content -->
	<!-- end of right content -->
</div>
<!-- end of main content -->
<?php foothtml(); ?>
<style>
	#imagePreviewPopup {
		display: none;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0.7);
		z-index: 9999;
		text-align: center;
		overflow: visible;
		/* don't Allow scrolling if the image is too large */
	}

	#imagePreviewPopup img {
		max-width: 90%;
		max-height: 80%;
		margin: 5% auto;
		border-radius: 5px;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
		/* Add shadow for depth */
	}

	#imagePreviewPopup span {
		position: absolute;
		top: 10px;
		right: 10px;
		color: #fff;
		cursor: pointer;
		font-size: 20px;
		font-weight: bold;
		padding: 5px 10px;
		background-color: rgba(0, 0, 0, 0.5);
		border-radius: 50%;
		/* Make it circular */
		transition: background-color 0.3s;
		/* Smooth transition */
	}

	#imagePreviewPopup span:hover {
		background-color: rgba(255, 255, 255, 0.5);
		/* Change color on hover */
	}
</style>