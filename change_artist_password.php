<?php
session_start();

// Include necessary files and initialize session variables if needed

// Check if the user is logged in as an artist
if (!isset($_SESSION['artist_logged']) || $_SESSION['artist_logged'] !== true) {
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
    die("Error: " . mysqli_error($GLOBALS["___mysqli_ston"]));
}
$artist = mysqli_fetch_assoc($query);

// Handle form submission for changing password
if (isset($_POST['change_password'])) {
    // Retrieve form data
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Verify current password
    if ($current_password != $artist['password']) {
        $error_message = "Current password is incorrect.";
    } elseif ($new_password != $confirm_new_password) {
        $error_message = "New password and confirm password do not match.";
    } else {
        // Update password in the database
        $update_query = "UPDATE artist SET password='$new_password' WHERE artist_id='$artist_id'";
        $update_result = mysqli_query($GLOBALS["___mysqli_ston"], $update_query);
        if (!$update_result) {
            die("Error updating password: " . mysqli_error($GLOBALS["___mysqli_ston"]));
        }

        // Redirect to the artist account page after successful password change
        header("Location: artist_account.php");
        exit();
    }
}

// Redirect to the artist account page if cancel button is pressed
if (isset($_POST['cancel'])) {
    // Redirect to artist_account.php
    header("Location: artist_account.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        /* styles.css */

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .center_content {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .error_message {
            color: red;
            margin-bottom: 15px;
        }

        .button_group {
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
    </style>
</head>

<body>

    <div class="center_content">
        <h2>Change Password</h2>
        <form action="" method="post">
            <label for="current_password">Current Password:</label><br>
            <input type="password" id="current_password" name="current_password" required><br>

            <label for="new_password">New Password:</label><br>
            <input type="password" id="new_password" name="new_password" required><br>

            <label for="confirm_new_password">Confirm New Password:</label><br>
            <input type="password" id="confirm_new_password" name="confirm_new_password" required><br>

            <?php if (isset($error_message)): ?>
                <p class="error_message"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <div class="button_group">
                <input type="submit" name="change_password" value="Change Password" class="btn_primary">
                <input type="button" name="cancel" value="Cancel" class="btn_secondary" onClick="window.location.href='artist_account.php';">
            </div>
        </form>
    </div>

</body>

</html>
