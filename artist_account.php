<?php
session_start();

// Include necessary files
require (__DIR__ . "/functions.php");
require (__DIR__ . "/htmls.php");

// Database connection
require (__DIR__ . "/db.php");

// Check if the user is logged in as an artist
if (!isset ($_SESSION['artist_logged']) || $_SESSION['artist_logged'] !== true) {
    header("Location: artist_login.php");
    exit();
}

// Function to fetch all artists from the database
function getAllArtists($conn)
{
    $artists = [];
    $sql = "SELECT * FROM artist";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $artists[] = $row;
        }
        mysqli_free_result($result);
    }
    return $artists;
}

// Function to fetch a single artist by ID
// Handle any POST requests for account management

// Function to update artist profile
function updateArtistProfile($conn, $artistId, $name, $email, $mobile, $address)
{
    $sql = "UPDATE artist SET artist_name = ?, email_id = ?, mobile_no = ?, address = ? WHERE artist_id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $mobile, $address, $artistId);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    }
    return false;
}

// Function to update artist password
function updateArtistPassword($conn, $artistId, $password)
{
    // You should hash the password before updating it in the database for security reasons
    // Example: $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE artist SET password = ? WHERE artist_id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $password, $artistId);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    }
    return false;
}

// Function to delete artist account
function deleteArtistAccount($conn, $artistId)
{
    $sql = "DELETE FROM artist WHERE artist_id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $artistId);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    }
    return false;
}

// Check if form is submitted for updating profile or password
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset ($_POST['update_profile'])) {
        $artistId = $_SESSION['artist_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        if (updateArtistProfile($conn, $artistId, $name, $email, $mobile, $address)) {
            // Profile updated successfully
            // Redirect to the artist account page
            header("Location: artist_account.php");
            exit();
        } else {
            // Error updating profile
            echo "Error updating profile.";
        }
    } elseif (isset ($_POST['update_password'])) {
        $artistId = $_SESSION['artist_id'];
        $password = $_POST['password'];
        if (updateArtistPassword($conn, $artistId, $password)) {
            // Password updated successfully
            // Redirect to the artist account page
            header("Location: artist_account.php");
            exit();
        } else {
            // Error updating password
            echo "Error updating password.";
        }
    }
}

// Function to display artist details
function displayArtistDetails($artist)
{
    if ($artist) {
        echo "<p><strong>Artist ID:</strong> " . $artist['artist_id'] . "</p>";
        echo "<p><strong>Name:</strong> " . $artist['artist_name'] . "</p>";
        echo "<p><strong>Email:</strong> " . $artist['email_id'] . "</p>";
        echo "<p><strong>Mobile:</strong> " . $artist['mobile_no'] . "</p>";
        echo "<p><strong>Address:</strong> " . $artist['address'] . "</p>";
    }
}

// Function to display artists in a table
function displayArtistsTable($artists)
{
    echo "<table border='1'>";
    echo "<tr><th>Artist ID</th><th>Artist Name</th><th>Email</th><th>Mobile</th><th>Address</th><th>Action</th></tr>";
    foreach ($artists as $artist) {
        echo "<tr>";
        echo "<td>" . $artist['artist_id'] . "</td>";
        echo "<td>" . $artist['artist_name'] . "</td>";
        echo "<td>" . $artist['email_id'] . "</td>";
        echo "<td>" . $artist['mobile_no'] . "</td>";
        echo "<td>" . $artist['address'] . "</td>";
        echo "<td><a href='edit_artist.php?id=" . $artist['artist_id'] . "'>Edit</a> | <a href='delete_artist.php?id=" . $artist['artist_id'] . "' onclick='return confirm(\"Are you sure you want to delete this artist?\")'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Fetch all artists from the database
$artists = getAllArtists($conn);

ob_start();
headhtml();
?>



<!-- HTML and PHP code for header and menu -->


<div class=""></div>
<ul class="">
     <!-- Logout option for the artist -->
</ul>
</div>
<?php
$userid = $_SESSION['artist_id'];
$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM artist WHERE artist_id = '$userid'");
if (!$query) {
    die ("Error: " . mysqli_error($GLOBALS["___mysqli_ston"]));
}
$row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Account</title>
    <!-- <link rel="stylesheet" href="styles.css"> Link to external CSS file -->
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    header {
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        text-align: right;
    }

    header a {
        color: #fff;
        text-decoration: none;
        margin-left: 20px;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile {
        display: flex;
        align-items: center;
    }

    .profile img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin-right: 20px;
    }

    .profile-info {
        flex: 1;
    }

    .profile-info h2 {
        margin-top: 0;
    }

    .profile-info p {
        margin: 5px 0;
    }

    .manage-account {
        margin-top: 20px;
    }

    .manage-account ul {
        list-style: none;
        padding: 0;
    }

    .manage-account li {
        margin-bottom: 10px;
    }

    .manage-account a {
        text-decoration: none;
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        display: inline-block;
    }

    .manage-account a:hover {
        background-color: #555;
    }
</style>

<body>

    <header>
        <a href="logout.php">Logout</a>
    </header>

    <div class="container">
        <div class="profile">
            <img src="artist/images/upload/<?php echo $row['artist_pic']; ?>" alt="Profile Picture">
            <div class="profile-info">
                <h2>
                    <?php echo $row['artist_name']; ?>
                </h2>
                <p>Email:
                    <?php echo $row['email_id']; ?>
                </p>
                <p>Mobile:
                    <?php echo $row['mobile_no']; ?>
                </p>
                <p>Address:
                    <?php echo $row['address']; ?>
                </p>
            </div>
        </div>
        <div class="manage-account">
            <h2>Manage Account:</h2>
            <ul>
                <li><a href="edit_artist_profile.php">Edit Profile</a></li>
                <li><a href="change_artist_password.php">Change Password</a></li>
                <li><a href="addproducts.php">Add a Product</a></li>
                <!-- Add more options as needed -->
            </ul>
        </div>
    </div>

</body>

</html>