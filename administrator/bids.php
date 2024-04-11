<?php
session_start();
if ($_SESSION['isvalid'] != "true") {
    header("location:index.php");
}
require(__DIR__ . '/htmls.php');
headhtml();
?>

<body>
    <div id="container">
        <div id="bgwrap">
            <div id="primary_left">
                <div id="menu"> <!-- navigation menu -->
                    <ul>
                        <li class="current"><a href="bids.php" class="dashboard"><img src="icons/2.png" alt /><span class="current">Bids</span></a></li>
                        <li class="showme"><a href="#" class="dashboard"><img src="icons/46.png" alt /><span class="current">Manage Users</span></a>
                            <ul class="showoff">
                                <li><a href="manage_artists.php">Manage Artists</a></li>
                                <li><a href="manage_users.php">Manage Users</a></li>
                            </ul>
                        </li>
                        <li class='showme'><a href="#"><img src="icons/36.png" alt /><span>Products</span></a>
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
                    <h1>Welcome Administrator</h1>
                    <div class="two_third column">
                        <h5>Products on bid</h5>
                        <div id="bodycon">
                            <ul class="product-list">
                                <?php
                                require(__DIR__ . "/../db.php");
                                ($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE bidding_status = 'open'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
                                while ($row = mysqli_fetch_array($query)) {
                                    echo "<li class='product-item'>";
                                    echo "<a href='bidlist.php?id=" . $row['art_id'] . "&artName=" . $row['art_name'] . "' rel='facebox' title='Product Name: " . $row['art_name'] . " | Price: " . $row['price'] . " | Status: " . $row['art_status'] . " Click to view log.'>";
                                    echo "<img src='images/products/" . $row['art_image'] . "' width='72' height='72' alt='Product Image'>";
                                    echo "<div class='product-details'>";
                                    echo "<h3>" . $row['art_name'] . "</h3>";
                                    echo "<p>Status: " . $row['art_status'] . "</p>";
                                    echo "<p>Price:" . $row['price'] . "</p>";
                                    echo "</div>";
                                    echo "</a>";
                                    echo "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    foothtml();
    ?>
    <style>
        .product-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .product-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            overflow: hidden;
        }

        .product-item img {
            float: left;
            margin-right: 10px;
        }

        .product-details {
            padding: 10px;
        }

        .product-details h3 {
            margin: 0;
            color: #333;
        }

        .product-details p {
            margin: 5px 0;
            color: #666;
        }
    </style>
    <script type='text/javascript'>
        jQuery(document).ready(function() {
            jQuery('.notif').hide();
            jQuery('#number').click(function() {
                jQuery('.notif').toggle('slow');
            });

            jQuery(".notif").click(function() {
                var id = $(this).attr("id");

                jQuery.ajax({
                    type: "POST",
                    data: ({
                        id: id
                    }),
                    url: "bidupdate.php",
                    success: function(response) {
                        jQuery(".id" + id).hide();
                        jQuery("#num_result").fadeIn().html(response);
                    }
                });

            })
            jQuery(document).ready(function() {
                jQuery('.showoff').hide();
                jQuery('.showme').click(function() {
                    jQuery('.showoff').hide();
                    jQuery(this).find('ul').toggle('slow');
                });

            });

        });
    </script>
</body>

</html>