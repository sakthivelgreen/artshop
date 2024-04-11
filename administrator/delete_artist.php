<?php
// Start the session and include necessary files
session_start();
require(__DIR__ . "/../db.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the aritst ID is provided
    if (isset($_POST["artist_id"])) {
        // Sanitize the input to prevent SQL injection
        $artistId = mysqli_real_escape_string($___mysqli_ston, $_POST["artist_id"]);

        // Construct and execute the SQL query to delete the aritst
        $query = "DELETE FROM `artist` WHERE `artist_id` = '$artistId'";
        $result = mysqli_query($___mysqli_ston, $query);

        // Check if the query executed successfully
        if ($result) {
            // Return a success message
            echo json_encode(array("status" => "success", "message" => "Artist deleted successfully."));
            exit; // Stop further execution
        } else {
            // Return an error message if the query fails
            echo json_encode(array("status" => "error", "message" => "Failed to delete Artist."));
            exit; // Stop further execution
        }
    } else {
        // Return an error message if the aritst ID is not provided
        echo json_encode(array("status" => "error", "message" => "Artist ID is missing."));
        exit; // Stop further execution
    }
} else {
    // Return an error message if the request method is not POST
    echo json_encode(array("status" => "error", "message" => "Invalid request method."));
    exit; // Stop further execution
}
?>