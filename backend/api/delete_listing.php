<?php
session_start();
require_once('../DBconn.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the listingId parameter is set
    if (isset($_POST['listingId'])) {
        // Get the listing ID from the POST data
        $listingId = $_POST['listingId'];

        try {
            // Your SQL query to delete the listing
            $deleteSql = "DELETE FROM tbl_listings WHERE listing_id = '$listingId';";

            // Check if the delete was successful
            if ($conn->query($deleteSql) === TRUE) {
                // If successful, send a JSON response indicating success
                // http_response_code(200); // OK
                // echo json_encode(['success' => true]);
                header("Location: ../../owner/index.php?session=" . $_SESSION["session"]);
                exit();
            } else {
                // If no rows were affected, send a JSON response indicating failure
                http_response_code(400); // Bad Request
                echo json_encode(['success' => false, 'error' => 'No rows were affected']);
            }
        } catch (mysqli_sql_exception $e) {
            // If an exception occurs, log the error and send a JSON response indicating failure
            error_log("MYSQLI Exception: " . $e->getMessage());
        }
        
    } else {
        // If listingId parameter is not set, send a JSON response indicating failure
        http_response_code(400); // Bad Request
        echo json_encode(['success' => false, 'error' => 'Listing ID not provided']);
    }
} else {
    // If the request method is not POST, send a JSON response indicating failure
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
