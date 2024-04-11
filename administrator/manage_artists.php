<?php
require(__DIR__ . "/../db.php");
session_start();
if ($_SESSION['isvalid'] != "true") {
    header("location:index.php");
}
require(__DIR__ . '/htmls.php');
headhtml();

function getArtists()
{
    global $___mysqli_ston; // Add this line to access global variable within the function
    $query = mysqli_query($___mysqli_ston, "SELECT * FROM `artist` ");
    if (!$query) {
        die(mysqli_error($___mysqli_ston)); // Terminate script with error message if query fails
    }

    echo "<table border='1'>";
    echo "<tr><th>Artist Name</th><th>Artist Username</th><th>Actions</th></tr>";
    while ($row = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>" . $row['artist_name'] . "</td>";
        echo "<td>" . $row['artist_id'] . "</td>";
        echo "<td><button class='delete-artist' data-artist-id='" . $row['artist_id'] . "'>Delete</button></td>";
        echo "</tr>";
    }
    echo "</table>";
}

if (isset($_POST['artistReg'])) {
    // Retrieve form data
    $artist_id = $_POST['username'];
    $artist_name = $_POST['name'];
    $password = $_POST['password'];

    // Insert data into the artist table
    $query = "INSERT INTO artist (artist_id,artist_name, password,artist_pic) 
              VALUES ('$artist_id','$artist_name', '$password','people.png')";
    $result = mysqli_query($GLOBALS["___mysqli_ston"], $query);
    if ($result) {
        // Registration successful
        echo '<script>alert("Registration successful!");</script>';
        // Redirect to login page or any other page
        echo '<script>location.replace("manage_artists.php");</script>';
        exit;
    }
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>
        Manage Users
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

        .delete-artist,
        .delete-user {
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

        .delete-artist:hover,
        .delete-user:hover {
            background-color: #ff0000;
            /* Darker red background color on hover */
        }


        /* Resetting input fields */
        input[type="text"],
        input[type="email"],
        textarea {

            width: 150px;
            height: 25px;
            border: 1px solid #333;


        }

        /* Resetting submit button */
        input[type="submit"] {
            all: unset;
            background: lightseagreen;
            margin: 5px;
            padding: 5px;
            color: whitesmoke;
            border: teal 1px solid;
            border-radius: 5px;

            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background: lime;
            color: #fff;
            border: 1px solid darkgreen;
        }
    </style>
    <script>
        $(document).ready(function() {
            // Attach click event listener to delete buttons
            $('.delete-artist').click(function() {
                // Get the product ID from the data attribute
                var artistId = $(this).data('artist-id');

                // Confirm deletion
                if (confirm("Are you sure you want to delete this Artist?")) {
                    // Send AJAX request to delete_product.php
                    $.ajax({
                        type: "POST",
                        url: "delete_artist.php",
                        data: {
                            artist_id: artistId
                        },
                        success: function(response) {
                            // Reload the page or update the product list as needed
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            // Handle errors
                            alert("Error occurred while deleting the Artist.");
                        }
                    });
                }
            });
        });
    </script>
</head>

<body>

    <body>
        <div id="container">
            <div id="bgwrap">
                <div id="primary_left">
                    <div id="menu"> <!-- navigation menu -->
                        <ul>
                            <li><a href="bids.php" class="dashboard"><img src="icons/2.png" alt /><span class="current">Bids</span></a></li>
                            <li class="showme current"><a href="#" class="dashboard"><img src="icons/46.png" alt /><span class="current">Manage Users</span></a>
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
                </div><!-- sidebar end -->

                <div id="primary_right">
                    <div class="inner">
                        <div class="two_third column">
                            <h3>Manage Artists</h3>
                            <div id="bodycon">
                                <form method="post">
                                    <tr>
                                        <td>Add New artist</td>
                                        <td><input type="text" name="name" placeholder="Name" required></td>
                                        <td><input type="text" name="username" placeholder="Username" required></td>
                                        <td><input type="text" name="password" placeholder="Password" required></td>
                                        <td><input type="submit" value="Add" name="artistReg"></td>
                                    </tr>
                                </form>
                                <?php getArtists(); ?>
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