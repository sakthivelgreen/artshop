<?php
session_start();
if ($_SESSION['isvalid'] != "true") {
    header("location:index.php");
    exit; // Terminate script to prevent further execution
}
require(__DIR__ . "/../db.php");
require(__DIR__ . '/htmls.php');
headhtml();

function getProductsOpen()
{
    global $___mysqli_ston; // Add this line to access global variable within the function
    $query = mysqli_query($___mysqli_ston, "SELECT * FROM `art_details` WHERE bidding_status = 'open'");
    if (!$query) {
        die(mysqli_error($___mysqli_ston)); // Terminate script with error message if query fails
    }

    echo "<table border='1'>";
    echo "<tr><th>Product ID</th><th>Product Name</th><th>Category</th><th>Due Date</th><th>Actions</th></tr>";
    while ($row = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>" . $row['art_id'] . "</td>";
        echo "<td>" . $row['art_name'] . "</td>";
        echo "<td>" . getCategoryName($row['category_id']) . "</td>";
        echo "<td>" . $row['due_date'] . "</td>";
        echo "<td><a href='edit_product.php?art_id=" . $row['art_id'] . "'>Edit</a> | <button class='delete-product' data-product-id='" . $row['art_id'] . "'>Delete</button></td>";
        echo "</tr>";
    }
    echo "</table>";
}

function getProductsClosed()
{
    global $___mysqli_ston; // Add this line to access global variable within the function
    $query = mysqli_query($___mysqli_ston, "SELECT * FROM `art_details` WHERE bidding_status = 'closed' AND art_status = 'onSale' ");
    if (!$query) {
        die(mysqli_error($___mysqli_ston)); // Terminate script with error message if query fails
    }

    echo "<table border='1'>";
    echo "<tr><th>Product ID</th><th>Product Name</th><th>Category</th><th>Due Date</th><th>Actions</th></tr>";
    while ($row = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>" . $row['art_id'] . "</td>";
        echo "<td>" . $row['art_name'] . "</td>";
        echo "<td>" . getCategoryName($row['category_id']) . "</td>";
        echo "<td>" . $row['due_date'] . "</td>";
        echo "<td><a href='edit_product.php?art_id=" . $row['art_id'] . "'>Edit</a> | <button class='delete-product' data-product-id='" . $row['art_id'] . "'>Delete</button></td>";
        echo "</tr>";
    }
    echo "</table>";
}

function getSoldProducts()
{
    global $___mysqli_ston; // Add this line to access global variable within the function
    $query = mysqli_query($___mysqli_ston, "SELECT * FROM `art_details` WHERE bidding_status = 'closed' AND art_status = 'sold' ");
    if (!$query) {
        die(mysqli_error($___mysqli_ston)); // Terminate script with error message if query fails
    }

    echo "<table border='1'>";
    echo "<tr><th>Product ID</th><th>Product Name</th><th>Category</th><th>Due Date</th><th>Actions</th></tr>";
    while ($row = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>" . $row['art_id'] . "</td>";
        echo "<td>" . $row['art_name'] . "</td>";
        echo "<td>" . getCategoryName($row['category_id']) . "</td>";
        echo "<td>" . $row['due_date'] . "</td>";
        echo "<td><a href='edit_product.php?art_id=" . $row['art_id'] . "'>Edit</a> | <button class='delete-product' data-product-id='" . $row['art_id'] . "'>Delete</button></td>";
        echo "</tr>";
    }
    echo "</table>";
}

function getCategoryName($category_id)
{
    global $___mysqli_ston; // Add this line to access global variable within the function
    $query = mysqli_query($___mysqli_ston, "SELECT categoryname FROM `art_categories` WHERE categoryid = $category_id");
    if (!$query) {
        die(mysqli_error($___mysqli_ston)); // Terminate script with error message if query fails
    }
    $row = mysqli_fetch_assoc($query);
    return $row['categoryname'];
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>View Products - Arts Shop</title>
    <link type="text/css" href="./style.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div id="container">
        <div id="bgwrap">
            <!-- Include navigation menu -->
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
                        <li class='showme current'><a href="#"><img src="icons/36.png" alt /><span>Products</span></a>
                            <ul class='showoff'>
                                <li><a href="add_prodven.php">New Product</a></li>
                                <li><a href="view_products.php">Manage Product</a></li>
                                <li><a href="addcategory.php">New Product Category</a></li>
                            </ul>
                        </li>
                        <li class="showme"><a href="orders_received.php" class="dashboard"><img src="icons/check.png" alt /><span class="current">Orders</span></a></li>
                        <li class='showme'><a href="#"><img src="./assets/icons/small_icons_3/settings.png" alt /><span>Account</span></a>
                            <ul class='showoff'>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div> <!-- navigation menu end -->
            </div> <!-- sidebar end -->


            <div id="primary_right">
                <div class="inner">
                    <h1>Manage Products</h1>

                    <div class="two_third column">
                        <h2>Bidding Open Products</h2>
                        <div id="bodycon">
                            <?php getProductsOpen(); ?>
                        </div>
                        <h2>Bidding Closed Products with No Bidders</h2>
                        <div id="bodycon">
                            <?php getProductsClosed(); ?>
                        </div>
                        <h2>Products Sold</h2>
                        <div id="bodycon">
                            <?php getSoldProducts(); ?>
                        </div>
                    </div>

                    <div class="one_third last column">
                        <h5></h5>
                    </div>
                    <hr />
                    <div class="clearboth"></div>
                </div>
            </div>
            <div class="clearboth" style="padding-bottom:20px;"></div>
        </div>
    </div>
    <style>
        /* Reset default browser styles */
        body,
        table {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            border-collapse: collapse;
            width: 100%;
        }

        table {
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .delete-product {
            background-color: #ff5c5c;
            /* Red background color */
            color: #fff;
            /* White text color */
            border: none;
            /* Remove border */
            padding: 8px 16px;
            /* Add padding */
            border-radius: 4px;
            /* Add rounded corners */
            cursor: pointer;
            /* Change cursor to pointer on hover */
        }

        .delete-product:hover {
            background-color: #ff0000;
            /* Darker red background color on hover */
        }
    </style>
    <script>
        $(document).ready(function() {
            // Attach click event listener to delete buttons
            $('.delete-product').click(function() {
                // Get the product ID from the data attribute
                var productId = $(this).data('product-id');

                // Confirm deletion
                if (confirm("Are you sure you want to delete this product?")) {
                    // Send AJAX request to delete_product.php
                    $.ajax({
                        type: "POST",
                        url: "delete_product.php",
                        data: {
                            product_id: productId
                        },
                        success: function(response) {
                            // Reload the page or update the product list as needed
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            // Handle errors
                            alert("Error occurred while deleting the product.");
                        }
                    });
                }
            });
        });
    </script>
     <script type='text/javascript'>
        jQuery(document).ready(function () {
            jQuery('.notif').hide();
            jQuery('#number').click(function () {
                jQuery('.notif').toggle('slow');
            });

            jQuery(".notif").click(function () {
                var id = $(this).attr("id");

                jQuery.ajax({
                    type: "POST",
                    data: ({ id: id }),
                    url: "bidupdate.php",
                    success: function (response) {
                        jQuery(".id" + id).hide();
                        jQuery("#num_result").fadeIn().html(response);
                    }
                });

            })
            jQuery(document).ready(function () {
                jQuery('.showoff').hide();
                jQuery('.showme').click(function () {
                    jQuery('.showoff').hide();
                    jQuery(this).find('ul').toggle('slow');
                });

            });

        });
    </script>
</body>

</html>