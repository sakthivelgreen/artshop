<?php
session_start();
if ($_SESSION['isvalid'] != "true") {
    header("location:index.php");
}
require (__DIR__ . "/../db.php");

// Function to retrieve product details based on product ID
function getProductDetails($productId)
{
    $productId = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $productId);
    $query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `art_details` WHERE art_id = '$productId'");
    return mysqli_fetch_assoc($query);
}

// Function to display categories in a select dropdown
function cats($selectedCategoryId)
{
    $selectedCategoryId = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $selectedCategoryId);
    $query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `art_categories`");
    echo "<select name ='category'>";
    while ($row = mysqli_fetch_array($query)) {
        $selected = ($row['categoryid'] == $selectedCategoryId) ? "selected" : "";
        echo "<option value='" . $row['categoryid'] . "' $selected>" . $row['categoryname'] . "</option>";
    }
    echo "</select>";
}

// Function to display artists in a select dropdown
function artists($selectedArtistId)
{
    $selectedArtistId = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $selectedArtistId);
    $query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `artist`");
    echo "<select name ='artist'>";
    while ($row = mysqli_fetch_array($query)) {
        $selected = ($row['artist_id'] == $selectedArtistId) ? "selected" : "";
        echo "<option value='" . $row['artist_id'] . "' $selected>" . $row['artist_name'] . "</option>";
    }
    echo "</select>";
}

// Check if form is submitted for editing product
if (isset ($_POST['edit_product'])) {
    // Retrieve form data
    $bid_status=$_POST['bid_status'];
    $productId = $_POST['art_id'];
    $art_name = $_POST['art_name'];
    $startingbid = $_POST['starting_bid'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $artist_id = $_POST['artist'];
    $descrpt = $_POST['descrpt'];
    $due_date = $_POST['due_date'];
    $due_time = $_POST['due_time'];
    $duedate = date('Y-m-d H:i:s', strtotime("$due_date $due_time"));

     // Updating bidrepot table when change in amount
     ($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE art_id = '$productId'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
     $row = mysqli_fetch_array($query);
     $starting_amount = $row['starting_bid'];
     ($query2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM bidreport WHERE art_id = '$productId'")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
     $highestbid = $starting_amount;
     while ($highonthis = mysqli_fetch_array($query2)) {
         $checkthis = $highonthis['bidamount'];
         if ($checkthis > $highestbid) {
             $highestbid = $checkthis;
         }
     }
     if($highestbid != $startingbid){
        mysqli_query($GLOBALS['___mysqli_ston'],"DELETE FROM bidreport where art_id = '$productId'");
     }

    // Update the product details in the database
    $updateQuery = "UPDATE `art_details` SET art_name = '$art_name', starting_bid = '$startingbid', price = '$price', category_id = '$category', artist_id = '$artist_id', due_date='$duedate', art_description = '$descrpt', bidding_status = '$bid_status' WHERE art_id = '$productId'";
    mysqli_query($GLOBALS["___mysqli_ston"], $updateQuery) or die (mysqli_error($GLOBALS["___mysqli_ston"]));

   
    // Redirect to view products page
    header("location: view_products.php");
}

// Check if product ID is provided for editing
if (isset ($_GET['art_id'])) {
    $productId = $_GET['art_id'];
    $productDetails = getProductDetails($productId);
    ?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Edit Product - Administrator</title>
        <link type="text/css" href="./style.css" rel="stylesheet" />
        <meta charset="UTF-8">
    </head>

    <body>
        <div id="container">
            <div id="bgwrap">
                <div id="primary_left">
                    <div id="menu"> <!-- navigation menu -->
                        <!-- Navigation menu content -->
                        <ul>
                            <li class="current"><a href="bids.php" class="dashboard"><img src="icons/2.png" alt /><span
                                        class="current">Bids</span></a></li>
                            <li class='showme'><a href="#"><img src="icons/36.png" alt /><span>Products</span></a>
                                <ul class='showoff'>
                                    <li><a href="add_prodven.php">New Product</a></li>
                                    <li><a href="view_products.php">View Product</a></li>
                                    <li><a href="addcategory.php">New Product Category</a></li>
                                </ul>
                            </li>
                            <li class='showme'><a href="#"><img src="./assets/icons/small_icons_3/settings.png"
                                        alt /><span>Account</span></a>
                                <ul class='showoff'>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div> <!-- navigation menu end -->
                </div> <!-- sidebar end -->
                <div id="primary_right">
                    <div class="inner">
                        <h1>Edit Product</h1>
                        <div class="two_third column">
                            <div id="bodycon">
                                <form method="post" name="prodform" id="prodform" action="">
                                    <input type="hidden" name="art_id" value="<?php echo $productId; ?>">
                                    <div id="textcon">
                                        <p>Product Name:</p><br />
                                        <p>Starting Bid:</p><br />
                                        <p>Regular Price:</p><br />
                                        <p>Category:</p><br />
                                        <p>Artist:</p><br />
                                        <p>Due_date:</p><br />
                                        <p>Due_time:</p><br />
                                        <p>Bid Status:</p>
                                        <p>Product Description:</p><br /><br /><br />
                                    </div>&nbsp;
                                    <div id="inputcon">
                                        <ul><input type="text" name="art_name" class="namewidth"
                                                value="<?php echo $productDetails['art_name']; ?>" /></ul>
                                        <p><input type="text" name="starting_bid" class="namewidth"
                                                value="<?php echo $productDetails['starting_bid']; ?>" /></p>
                                        <p><input type="text" name="price" class="namewidth"
                                                value="<?php echo $productDetails['price']; ?>" /></p>
                                        <p>
                                            <?php cats($productDetails['category_id']); ?>
                                        </p>
                                        <p>
                                            <?php artists($productDetails['artist_id']); ?>
                                        </p>
                                        <p><input type="date" name="due_date" class="namewidth"
                                            value="<?php echo date('Y-m-d', strtotime($productDetails['due_date'])); ?>" /></p>
                                        <p><input type="time" name="due_time" class="namewidth"
                                            value="<?php echo date('H:i', strtotime($productDetails['due_date'])); ?>" /></p>
                                        <p>
                                        <select name="bid_status">
											<option value="open">Open</option>
                                            <option value="closed">Closed</option>
										</select>
                                        </p>
                                        <p><textarea name="descrpt"
                                                class="namewidth"><?php echo $productDetails['art_description']; ?></textarea>
                                        </p>
                                        <br />
                                        <p>
                                            <input type="submit" name="edit_product" value="Save Changes" />
                                            <a href="view_products.php"><input type="button" class="cancel-button" value="Cancel" /></a>
                                        </p>
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
  <style>
    .cancel-button {
    background-color: #ccc;
    border: 1px solid #999;
    color: #333;
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 4px;
    cursor: pointer;
}

.cancel-button:hover {
    background-color: #ddd;
}

  </style>
    </body>

    </html>
    <?php
} else {
    // If product ID is not provided, redirect to index.php or show an error message
    header("location:index.php");
}
?>