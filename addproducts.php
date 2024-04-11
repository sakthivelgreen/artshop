<?php
session_start();
if (!isset ($_SESSION['artist_logged']) || $_SESSION['artist_logged'] !== true) {
    // Redirect to login page or display an error message
    header("Location: artist_login.php");
    exit;
}
require (__DIR__ . "/db.php");

$id = $_SESSION['artist_id'];
$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM artist WHERE artist_id = '$id'");
if (!$query) {
    die ("Error: " . mysqli_error($GLOBALS["___mysqli_ston"]));
}
$artist = mysqli_fetch_assoc($query);
$artist_id = $artist["artist_id"];

function cats()
{
    ($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `art_categories`")) || die (mysqli_error($GLOBALS["___mysqli_ston"]));
    echo "<select name ='category'>";
    echo "<option>Select Category</option>";
    while ($row = mysqli_fetch_array($query)) {

        echo "<option value='" . $row['categoryid'] . "'>" . $row['categoryname'] . "</option>";
    }
    echo "</select>";
}

if (isset ($_POST['prodsave'])) {
    $bid_status=$_POST['bid_status'];
    $artist_id = $artist["artist_id"];
    $art_name = $_POST['art_name'];
    $startingbid = $_POST['starting_bid'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $descrpt = $_POST['descrpt'];
    // Retrieve due date and time from form
    $due_date = $_POST['duedate'];
    // Set due date
    $duedate = date('Y-m-d H:i:s', strtotime($due_date));
    // $datenow = date("F j, Y, g:i a");
    $art_imagename = $_FILES["image"]["name"];
    $type = $_FILES["image"]["type"];
    $size = $_FILES["image"]["size"];
    $temp = $_FILES["image"]["tmp_name"];
    $error = $_FILES["image"]["error"];
    mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO art_details(artist_id,art_name,category_id,art_description,starting_bid,art_image,price,date_posted,due_date,art_status,bidding_status) 
						VALUES ('$artist_id','$art_name','$category','$descrpt','$startingbid','$art_imagename','$price',NOW(),'$duedate','onSale','$bid_status')") || die (mysqli_error($GLOBALS["___mysqli_ston"]));
    echo "Product has been successfully added to database!!!<br>";
    if ($error > 0) {
        die ("Error uploading file! Code $error.");
    } elseif ($size > 10000000) {
        //conditions for the file
        die ("Format is not allowed or file size is too big!");
    } else {
        move_uploaded_file($temp, "administrator/images/products/" . $art_imagename);
    }


}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #bodycon {
            width: 80%;
            margin: 0 auto;
            padding-top: 20px;
        }

        h5 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 8px;
            vertical-align: top;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        textarea,
        select {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        input[type="file"] {
            margin-top: 6px;
        }

        input[type="submit"],
        .cancel {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            margin-left: 10px;
        }

        input[type="submit"]:hover,
        .cancel:hover {
            background-color: #45a049;
        }

        .cancel {
            background-color: #f44336;
        }

        .cancel:hover {
            background-color: #d32f2f;
        }

        label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h5>Add New Product</h5>
    <div id="bodycon">
        <form method="post" name="prodform" id="prodform" action="" enctype='multipart/form-data'>
            <table>
                <tr>
                    <td><label for="art_name">Product Name:</label></td>
                    <td><input type="text" name="art_name" required /></td>
                </tr>
                <tr>
                    <td><label for="starting_bid">Starting Bid:</label></td>
                    <td><input type="text" name="starting_bid" required /></td>
                </tr>
                <tr>
                    <td><label for="price">Regular Price:</label></td>
                    <td><input type="text" name="price" required /></td>
                </tr>
                <tr>
                    <td><label for="category">Category:</label></td>
                    <td>
                        <?php cats(); ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="artist">Artist:</label></td>
                    <td>
                        <?php echo $artist_id; ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="duedate">Due Date:</label></td>
                    <td><input type="datetime-local" name="duedate" required /></td>
                </tr>
                <tr>
                    <td><label for="descrpt">Product Description:</label></td>
                    <td><textarea name="descrpt" required></textarea></td>
                </tr>
                <tr>
                    <td><label for="image">Product Image:</label></td>
                    <td><input type="file" name="image" required /></td>
                </tr>
                <tr>
                    <td><label for="bid_status">Bid Status:</label></td>
                    <td><select name="bid_status">
                        <option value="open">Open</option>
                    </select></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="prodsave" value="Save Product" />
                        <a href="artist_account.php" class="cancel">Cancel</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        // JavaScript alert after successful submission
        <?php if(isset($_POST['prodsave'])): ?>
            alert("Product has been successfully added to database!");
        <?php endif; ?>
    </script>
</body>

</html>
