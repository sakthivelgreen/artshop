<?php
session_start();

// Include necessary files and initialize session variables if needed

// Check if the user is logged in as an artist
if (!isset ($_SESSION['artist_logged']) || $_SESSION['artist_logged'] !== true) {
    // Redirect to login page or display an error message
    header("Location: artist_login.php");
    exit;
}

// Include database connection and other necessary files
require_once "functions.php";
require_once "htmls.php";

// Fetch artist's information from the database
$artist_id = $_SESSION['artist_id'];
$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM artist WHERE artist_id = '$artist_id'");
if (!$query) {
    die ("Error: " . mysqli_error($GLOBALS["___mysqli_ston"]));
}
$artist = mysqli_fetch_assoc($query);

// Handle form submission for updating profile information
if (isset ($_POST['update_profile'])) {
    // Retrieve form data
    $artist_name = $_POST['artist_name'];
    $email = $_POST['email'];
    $mobile_no = $_POST['mobile_no'];
    $address = $_POST['address'];
    // You may add more fields here if needed
    $name = $_FILES["image"]["name"];
    $type = $_FILES["image"]["type"];
    $size = $_FILES["image"]["size"];
    $temp = $_FILES["image"]["tmp_name"];
    $error = $_FILES["image"]["error"];

    if ($error > 0) {
        die ("Error uploading file! Code $error.");
    } elseif ($size > 10000000) {
        //conditions for the file
        die ("Format is not allowed or file size is too big!");
    } else {
        move_uploaded_file($temp, "artist/images/upload/" . $name);
    }
    // Perform input validation if necessary

    // Update artist's information in the database
    $update_query = "UPDATE artist SET artist_name='$artist_name', email_id='$email', mobile_no='$mobile_no', address='$address',artist_pic='$name' WHERE artist_id='$artist_id'";
    $update_result = mysqli_query($GLOBALS["___mysqli_ston"], $update_query);
    if (!$update_result) {
        die ("Error updating record: " . mysqli_error($GLOBALS["___mysqli_ston"]));
    }

    // Redirect to the artist profile page after successful update
    header("Location: artist_account.php");
    exit();
}

// Redirect to the artist profile page if cancel button is pressed
if (isset ($_POST['cancel'])) {
    header("Location: artist_account.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artist Profile</title>
    <!-- Link to external CSS file -->
    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        .center_content {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile_form .form_group {
            margin-bottom: 20px;
        }

        .profile_form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .profile_form input[type="text"],
        .profile_form input[type="email"],
        .profile_form input[type="tel"],
        .profile_form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .profile_form input[type="file"] {
            margin-top: 10px;
        }

        .profile_form .button_group {
            display: flex;
            justify-content: space-between;
        }

        .btn_primary,
        .btn_secondary {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn_primary {
            background-color: #4CAF50;
            color: white;
        }

        .btn_secondary {
            background-color: #ccc;
            color: #333;
        }

        .btn_primary:hover,
        .btn_secondary:hover {
            opacity: 0.8;
        }

        /* Header and Footer styles */
        header,
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <h1>Edit Profile</h1>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="center_content">
            <form action="" method="post" enctype="multipart/form-data" class="profile_form">
                <div class="form_group">
                    <label for="artist_name">Artist Name:</label>
                    <input type="text" id="artist_name" name="artist_name"
                        value="<?php echo $artist['artist_name']; ?>">
                </div>

                <div class="form_group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $artist['email_id']; ?>">
                </div>

                <div class="form_group">
                    <label for="mobile_no">Mobile Number:</label>
                    <input type="tel" id="mobile_no" name="mobile_no" value="<?php echo $artist['mobile_no']; ?>">
                </div>

                <div class="form_group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address"><?php echo $artist['address']; ?></textarea>
                </div>

                <div class="form_group">
                    <label for="image">Upload Profile Picture:</label>
                    <input type="file" name="image" id="image">
                </div>

                <div class="button_group">
                    <input type="submit" name="update_profile" value="Update Profile" class="btn_primary">
                    <input type="submit" name="cancel" value="Cancel" class="btn_secondary">
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy;
                <?php echo date("Y"); ?> Online Arts Shop
            </p>
        </div>
    </footer>
</body>

</html>