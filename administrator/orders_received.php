<?php
require(__DIR__ . "/../db.php");
session_start();
if ($_SESSION['isvalid'] != "true") {
    header("location:index.php");
}
require(__DIR__ . '/htmls.php');
headhtml();

function showdetails()
{
    $sql = "SELECT DISTINCT orders.art_id AS artID, art_details.art_name AS artName, orders.customer_name AS customerName,
     customer.address AS deliveryAddress, orders.payment_id AS paymentID FROM orders INNER JOIN customer INNER JOIN winners INNER JOIN art_details WHERE customer.customer_id = winners.customer_id AND orders.art_id = winners.art_id AND art_details.art_id = orders.art_id";

    $result = mysqli_query($GLOBALS['___mysqli_ston'], $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['artID'] . "</td>";
        echo "<td>" . $row['artName'] . "</td>";
        echo "<td>" . $row['customerName'] . "</td>";
        echo "<td>" . $row['deliveryAddress'] . "</td>";
        echo "<td>" . $row['paymentID'] . "</td>";
        echo "</tr>";
    }
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>
        Orders Received
    </title>
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
    </style>

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
                        <li class='showme'><a href="#"><img src="icons/36.png" alt /><span>Products</span></a>
                            <ul class='showoff'>
                                <li><a href="add_prodven.php">New Product</a></li>
                                <li><a href="view_products.php">Manage Product</a></li>
                                <li><a href="addcategory.php">New Product Category</a></li>
                            </ul>
                        </li>
                        <li class="showme current"><a href="orders_received.php" class="dashboard"><img src="icons/check.png" alt /><span class="current">Orders</span></a></li>
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
                    <div class="two_third column">
                        <h3>Orders Received</h3>
                        <div id="bodycon">
                            <table class="table table-striped">
                                <tr>
                                    <thead class="thead-dark">
                                        <th scope="col">Art ID</th>
                                        <th scope="col">Art Name</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Delivery Address</th>
                                        <th scope="col">Payment ID</th>
                                    </thead>
                                </tr>
                                <?php showdetails(); ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    foothtml();
    ?>


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