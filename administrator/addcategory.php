<?php
session_start();
if ($_SESSION['isvalid'] != "true") {
    header("location:index.php");
}
require(__DIR__ . '/functions.php');
require(__DIR__ . '/htmls.php');
require(__DIR__ . '/../db.php');

// Function to handle category insertion
function insertCategory($categoryName, $categoryImage, $categoryDescription)
{
    // Check if the form is submitted
    if (isset($_POST['cmdadd'])) {
        // Validate the inputs
        if (empty($categoryName) || empty($categoryImage['name']) || empty($categoryDescription)) {
            echo "Please provide category name, image, and description.";
            return;
        }

        // Handle file upload
        $targetDirectory = "images/category/";
        $targetFile = $targetDirectory . basename($categoryImage['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $uploadOk = 1;

        // Check if image file is a actual image or fake image
        $check = getimagesize($categoryImage['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($categoryImage['size'] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            return;
        } else {
            // if everything is ok, try to upload file
            if (move_uploaded_file($categoryImage['tmp_name'], $targetFile)) {
                // File uploaded successfully, insert category into database


                // Prepare and execute SQL statement to insert category
                $sql = "INSERT INTO art_categories (categoryname, catimage, categorydes) VALUES ('$categoryName', '$targetFile', '$categoryDescription')";
                mysqli_query($GLOBALS['___mysqli_ston'], $sql);

                echo "New category inserted successfully.";
                echo "<script>window.location = window.location.href;</script>";
                exit();
            } else {
                echo "Sorry, there was an error uploading your file.";
                return;
            }
        }
    }
}

// Function to display categories
function displayCategories()
{

    // Retrieve categories from database
    $sql = "SELECT * FROM art_categories ORDER BY categoryid";
    $result = mysqli_query($GLOBALS['___mysqli_ston'], $sql);

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<th>" . $row['categoryid'] . "</th>";
            echo "<td>" . $row['categoryname'] . "</td>";
            echo "<td><img src='images/category/" . $row['catimage'] . "' width='75' height='75' /></td>";
            echo "<td><button class='delete-category' data-category-id='" . $row['categoryid'] . "' data-cat-name='" . $row['categoryname'] . "'>Delete</button></td>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }
}

headhtml();
categoryadd();
?>

<head>
    <title>Categories</title>
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

        .delete-category {
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

        .delete-category:hover {
            background-color: #ff0000;
            /* Darker red background color on hover */
        }

        /* Resetting input fields */
    </style>
</head>

<body>
    <div id="container">
        <div id="bgwrap">
            <div id="primary_left">
                <div id="menu">
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
                </div>
            </div>
            <div id="primary_right">
                <div class="inner">
                    <div class="two_third column">
                        <h3>Add New Product Category</h3>
                        <div id="bodycon">
                            <form method="post" name="prodform" action="" enctype='multipart/form-data'>
                                <table>
                                    <tr>
                                        <td>Category Name:</td>
                                        <td><input name="categoryname" type="text" id="categoryname" class="namewidth" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Category Description:</td>
                                        <td>
                                            <input name="categorydes" type="text" id="categorydes" class="namewidth" />
                                        </td>
                                    </tr>
                                    <tr><td>Category Image</td>
                                        <td><input type="file" name="catimage" id="catimage" class="namewidth" /></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input name="cmdadd" type="submit" id="cmdadd" value="Add New" class="namewidth" />
                                        </td>
                                        <td>
                                            <input name="cmdcancel" type="submit" id="cmdcancel" value="Cancel" class="namewidth" />
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <h3>Categories</h3>
                        <div id="bodycon">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Category Name&nbsp;&nbsp;</th>
                                        <th>Category ID</th>
                                        <th>Category Image&nbsp;&nbsp;</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <?php displayCategories(); ?>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="clearboth"></div>
            </div><!-- inner -->
        </div><!-- primary_right -->
        <div class="clearboth" style="padding-bottom:20px;"></div>
    </div> <!-- bgwrap -->
    </div> <!-- container -->
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

        //Deleting a Category
        $(document).ready(function() {
            // Attach click event listener to delete buttons
            $('.delete-category').click(function() {
                // Get the product ID from the data attribute
                var catId = $(this).data('category-id');
                var catname = $(this).data('cat-name');

                // Confirm deletion
                if (confirm("Are you sure you want to delete this category " + catname)) {
                    // Send AJAX request to delete_product.php
                    $.ajax({
                        type: "POST",
                        url: "delete_category.php",
                        data: {
                            category_id: catId
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
</body>

</html>