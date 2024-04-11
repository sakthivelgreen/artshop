<?php
require (__DIR__ . "/db.php");
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
//shows the add to watchlist option--------

function watsnew()
{
	($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE art_status = 'forSale' ORDER BY art_id DESC LIMIT 0,1")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
	while ($row = mysqli_fetch_array($query)) {
		echo
			'<div class="border_box">
				<div class="product_title"><a href="details.php?id=' . $row['art_id'] . '">' . $row['art_name'] . '</a></div>
				<div class="product_img"><img src="administrator/images/products/' . $row['art_image'] . '" width="94" height="92" alt="" border="0" /></div>
				<div class="prod_price"></div>
			</div>';
	}
}

//shows categories--------

function categories()
{
	($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `art_categories`")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
	while ($row = mysqli_fetch_array($query)) {
		echo "<li class = 'even'><a href ='showprod.php?id=" . $row['categoryid'] . "'>" . $row['categoryname'] . "</a></li>";
	}
	echo "</ul>";
}

//shows categories--------

function categorylist()
{
	($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_categories")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
	while ($row = mysqli_fetch_array($query)) {
		echo "<div class='prod_box'>";
		echo "<div class='top_prod_box'></div>";
		echo "<div class='center_prod_box'>";
		echo "<div class='product_title'><a href='showprod.php?id=" . $row['categoryid'] . "'>" . $row['categoryname'] . "</a></div>";
		echo "<div class='product_img'><a href='showprod.php?id=" . $row['categoryid'] . "'><img src='administrator/images/category/" . $row['catimage'] . "' width='94' height='92' alt='' border='0' /></a></div>";
		echo "<div class='prod_price'><span class='price'>" . $row['categorydes'] . "</span></div>";
		echo "<div class='product_title'><a href='showprod.php?id=" . $row['categoryid'] . "'>click to view " . $row['categoryname'] . "</a></div>";
		echo "</div>";
		echo "<div class='bottom_prod_box'></div>";
		echo "</div>";
	}
}

//shows latest products-----

function latest()
{
	($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE bidding_status = 'open' ORDER BY art_id DESC LIMIT 0,6")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));

	while ($row = mysqli_fetch_array($query)) {
		$prodid = $row['art_id'];
		$prodsbid = $row['starting_bid'];
		//for displaying highest bid and no of bidders
		($query2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM bidreport WHERE art_id = '$prodid'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
		$noofbidders = mysqli_num_rows($query2);
		$highbid = $prodsbid;
		while ($highonthis = mysqli_fetch_array($query2)) {
			$checkthis = $highonthis['bidamount'];
			if ($checkthis > $highbid) {
				$highbid = $checkthis;
			}
		}
		($highestbidder = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM bidreport WHERE bidamount = '$highbid'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
		$highestbiddera = mysqli_fetch_array($highestbidder);
		if (empty($highestbiddera)) {
			$hibidder = " ";
		} else {
			$hibidder = $highestbiddera['customer_id'];
		}

		($name = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM customer WHERE customer_id = '$hibidder'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
		$namea = mysqli_fetch_array($name);
		if (empty($namea)) {
			$highname = " ";
		} else {
			$highname = $namea['userid'];
		}
		echo "<div class='prod_box'>";
		echo "<div class='top_prod_box'></div>";
		echo "<div class='center_prod_box'>";
		echo "<div class='product_title'><a href='details.php?id=" . $row['art_id'] . "'>" . $row['art_name'] . "</a></div>";
		echo "<div class='product_img'><a href='details.php?id=" . $row['art_id'] . "'><img src='administrator/images/products/" . $row['art_image'] . "' width='94' height='92' alt='' border='0' /></a></div>";
		echo "<div class='prod_price'><span>Start Bid at: </span> <span class='price'>Rs. " . $row['starting_bid'] . "</span><br />
				<span>Highest Bidder: </span> <span class='price'>" . $highname . "</span>
				</div>";
		echo "</div>";
		echo "<div class='bottom_prod_box'></div>";
		echo "<div class='prod_details_tab'><a href='details.php?id=" . $row['art_id'] . "' class='prod_details' title='header=[Click to Bid] body=[&nbsp;] fade=[on]'>Bid Now</a> </div>";
		echo "</div>";
	}
}
// show closed bidding products
function closed()
{
	($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE bidding_status = 'closed' ORDER BY art_id DESC LIMIT 0,6")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));

	while ($row = mysqli_fetch_array($query)) {
		$prodid = $row['art_id'];
		$prodsbid = $row['starting_bid'];
		//for displaying highest bid and no of bidders
		($query2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM bidreport WHERE art_id = '$prodid'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
		$noofbidders = mysqli_num_rows($query2);
		$highbid = $prodsbid;
		while ($highonthis = mysqli_fetch_array($query2)) {
			$checkthis = $highonthis['bidamount'];
			if ($checkthis > $highbid) {
				$highbid = $checkthis;
			}
		}
		($highestbidder = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM bidreport WHERE bidamount = '$highbid'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
		$highestbiddera = mysqli_fetch_array($highestbidder);
		if (empty($highestbiddera)) {
			$hibidder = " ";
		} else {
			$hibidder = $highestbiddera['customer_id'];
		}

		($name = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM customer WHERE customer_id = '$hibidder'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
		$namea = mysqli_fetch_array($name);
		if (empty($namea)) {
			$highname = " ";
		} else {
			$highname = $namea['userid'];
		}
		echo "<div class='prod_box'>";
		echo "<div class='top_prod_box'></div>";
		echo "<div class='center_prod_box'>";
		echo "<div class='product_title'><a href='details.php?id=" . $row['art_id'] . "'>" . $row['art_name'] . "</a></div>";
		echo "<div class='product_img'><a href='details.php?id=" . $row['art_id'] . "'><img src='administrator/images/products/" . $row['art_image'] . "' width='94' height='92' alt='' border='0' /></a></div>";
		echo "<div class='prod_price'><span>Start Bid at: </span> <span class='price'>Rs. " . $row['starting_bid'] . "</span><br />
			<span>Highest Bidder: </span> <span class='price'>" . $highname . "</span>
			</div>";
		echo "</div>";
		echo "<div class='bottom_prod_box'></div>";
		echo "<div class='prod_details_tab'><a href='details.php?id=" . $row['art_id'] . "' class='prod_details' title='header=[Click to Bid] body=[&nbsp;] fade=[on]'>Bid Now</a> </div>";
		echo "</div>";
	}
}
//shows products on a category-----

function showprod()
{
	$id = $_GET['id'];
	($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE category_id = '$id' AND bidding_status = 'open'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
	$res = mysqli_num_rows($query);
	if ($res == 0) {

		echo "<center><div class='product_title' style='margin:100px;'>There is no product available in this category</div><center>";

	} else {
		while ($row = mysqli_fetch_array($query)) {
			$prodid = $row['art_id'];
			$prodsbid = $row['starting_bid'];
			//for displaying highest bid and no of bidders
			($query2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM bidreport WHERE art_id = '$prodid'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
			$noofbidders = mysqli_num_rows($query2);
			$highbid = $prodsbid;
			while ($highonthis = mysqli_fetch_array($query2)) {
				$checkthis = $highonthis['bidamount'];
				if ($checkthis > $highbid) {
					$highbid = $checkthis;
				}
			}
			($highestbidder = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM bidreport WHERE bidamount = '$highbid'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
			$highestbiddera = mysqli_fetch_array($highestbidder);
			if (empty($highestbiddera)) {
				$hibidder = " ";
			} else {
				$hibidder = $highestbiddera['customer_id'];
			}
			($name = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM customer WHERE customer_id = '$hibidder'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
			$namea = mysqli_fetch_array($name);
			if (empty($namea)) {
				$highname = " ";
			} else {
				$highname = $namea['userid'];
			}
			echo "<div class='prod_box'>";
			echo "<div class='top_prod_box'></div>";
			echo "<div class='center_prod_box'>";
			echo "<div class='product_title'><a href='details.php?id=" . $row['art_id'] . "'>" . $row['art_name'] . "</a></div>";
			echo "<div class='product_img'><a href='details.php?id=" . $row['art_id'] . "'><img src='administrator/images/products/" . $row['art_image'] . "' width='94' height='92' alt='' border='0' /></a></div>";
			echo "<div class='prod_price'><span>Start Bid at: </span> <span class='price'>Rs. " . $row['starting_bid'] . "</span><br />
				<span>Highest Bidder: </span> <span class='price'>" . $highname . "</span>
				</div>";
			echo "</div>";
			echo "<div class='bottom_prod_box'></div>";
			echo "<div class='prod_details_tab'><a href='details.php?id=" . $row['art_id'] . "' class='prod_details' title='header=[Click to Bid] body=[&nbsp;] fade=[on]'>Bid Now</a> </div>";
			echo "</div>";
		}
	}
}

function closedbids()
{
	$id = $_GET['id'];
	($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE category_id = '$id' AND bidding_status = 'closed'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
	$res = mysqli_num_rows($query);
	if ($res == 0) {

	} else {
		while ($row = mysqli_fetch_array($query)) {			
			echo "<div class='prod_box'>";
			echo "<div class='top_prod_box'></div>";
			echo "<div class='center_prod_box'>";
			echo "<div class='product_img'><a href='details2.php?id=" . $row['art_id'] . "'><img src='administrator/images/products/" . $row['art_image'] . "' width='94' height='92' alt='' border='0' /></a></div>";
			echo "<div class='product_title'><a href='details2.php?id=" . $row['art_id'] . "'>" . $row['art_name']."</a></div>";
			echo "<br></div>";
			echo "</div>";
		}
	}
}


//shows the products on watch--------
function onwatch()
{
	$who_u = $_SESSION['logged'];
	$query1 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM watcustomer WHERE customer_id = '$who_u'");
	while ($row1 = mysqli_fetch_array($query1)) {
		$prod = $row1['art_id'];
		$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE art_id = '$prod'");
		while ($row = mysqli_fetch_array($query)) {
			echo "<div class='prod_box'>";
			echo "<div class='top_prod_box'></div>";
			echo "<div class='center_prod_box'>";
			echo "<div class='product_title'><a href='details.php?id=" . $row['art_id'] . "'>" . $row['art_name'] . "</a></div>";
			echo "<div class='product_img'><a href='details.php?id=" . $row['art_id'] . "'><img src='administrator/images/products/" . $row['art_image'] . "' width='94' height='92' alt='' border='0' /></a></div>";
			echo "<div class='prod_price'><span class='reduce'>" . $row['price'] . "$</span> <span class='price'>" . $row['starting_bid'] . "$</span></div>";
			echo "</div>";
			echo "<div class='bottom_prod_box'></div>";
			echo "<div class='prod_details_tab'><a href='details.html' class='prod_details' title='header=[Click for Details] body=[&nbsp;] fade=[on]'>Details</a> </div>";
			echo "</div>";
		}
	}
}
//shows the account--------
function account()
{
	if ($_SESSION['logged'] != 'guest') {
		echo '<li><a href="logout.php" class="nav3">Log-Out</a></li>
		<li><a href="myaccount.php" class="nav3">View Account</a></li>
		<li><a class="nav4">Account</a></li>';
	} else {
		echo '<li><a href="login.php" class="nav4">Log-in or Register</a></li>';
	}
}
function logform()
{
	if ($_SESSION['logged'] == 'guest') {
		echo '<div class="title_box">Welcome</div>
			  <div class="border_box">
					<br />
						<strong>User: </strong>Guest<br /><br />
						<strong>Account Status:</strong> Not Active<br /><br />
						<strong>Bid Counter:</strong> Not Available<br /><br />
						<strong>Items Acquired:</strong> Not Available<br /><br />
						<ul></ul>
			</div>';
	}
	else {
		$hisid = $_SESSION['logged'];
		$query1 = mysqli_query($GLOBALS['___mysqli_ston'], "SELECT COUNT(customer_id) as count FROM bidreport WHERE customer_id = '$hisid'");
		$row1 = mysqli_fetch_assoc($query1);
		$query2 = mysqli_query($GLOBALS['___mysqli_ston'], "SELECT COUNT(customer_id) as count FROM winners WHERE customer_id = '$hisid'");
		$row2 = mysqli_fetch_assoc($query2);
		$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM customer WHERE customer_id = '$hisid' ");
		while ($rows = mysqli_fetch_array($query)) {
			echo '<div class="title_box">Welcome</div>
					<div class="border_box">
							<br />
							<strong>Username:</strong> ' . $rows['userid'] . '<br /><br />
							<strong>Account Status: </strong> Active<br /><br />
							<strong>Bid Counter:</strong> ' . $row1['count'] . '<br /><br />
							<strong>Items Acquired:</strong> '.$row2['count'].'<br /><br />
							<ul></ul>
						</form>
				</div>';
		}
	}
}
?>