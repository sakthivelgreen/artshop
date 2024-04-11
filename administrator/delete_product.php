<?php
// Start the session and include necessary files
session_start();
require(__DIR__ . "/../db.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the product ID is provided
    if (isset($_POST["product_id"])) {
        // Sanitize the input to prevent SQL injection
        $productId = mysqli_real_escape_string($___mysqli_ston, $_POST["product_id"]);

        // Construct and execute the SQL query to delete the product
        $query = "DELETE FROM `art_details` WHERE `art_id` = '$productId'";
        $result = mysqli_query($___mysqli_ston, $query);

        // Check if the query executed successfully
        if ($result) {
            // Return a success message
            echo json_encode(array("status" => "success", "message" => "Product deleted successfully."));
            exit; // Stop further execution
        } else {
            // Return an error message if the query fails
            echo json_encode(array("status" => "error", "message" => "Failed to delete product."));
            exit; // Stop further execution
        }
    } else {
        // Return an error message if the product ID is not provided
        echo json_encode(array("status" => "error", "message" => "Product ID is missing."));
        exit; // Stop further execution
    }
} else {
    // Return an error message if the request method is not POST
    echo json_encode(array("status" => "error", "message" => "Invalid request method."));
    exit; // Stop further execution
}
?>
