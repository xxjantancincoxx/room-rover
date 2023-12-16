<?php
// Assuming you have a valid database connection in DBconn.php
require_once('../../backend/DBconn.php');

// Check if the listingId is provided
if (isset($_GET['listingId'])) {
    $listingId = $_GET['listingId'];

    // Prepare and execute a query to get listing details
    $stmt = $pdo->prepare("SELECT * FROM tbl_listings WHERE listing_id = :listingId");
    $stmt->bindParam(':listingId', $listingId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if the query was successful
    if (count($result) > 0) {
        // Fetch listing details as an associative array
        $listingDetails = $result[0]; // Assuming you only expect one row

        // Return listing details as JSON with HTTP 200 OK
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($listingDetails);
    } else {
        // Return an error if the listing is not found with HTTP 404 Not Found
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Listing not found']);
    }

    // No need to close the statement in PDO; it's done automatically
    // Close the database connection (move this outside the if-else block)
    $pdo = null;
} else {
    // Return an error if listingId is not provided with HTTP 400 Bad Request
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Listing ID not provided']);
}
?>
    