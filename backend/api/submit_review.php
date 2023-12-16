<?php
session_start();
require_once('../../backend/DBconn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Retrieve review details from the POST data
    $listingIdReview = $_POST['listingIdReview'];
    $reviewText = $_POST['reviewText'];
    $rating = $_POST['rating'];
    $userId = $_SESSION['id'];

    // Validate or sanitize input data as needed

// Check if the user exists in the users table
$userCheckSql = "SELECT COUNT(*) FROM accounts WHERE id = :userId";
$userCheckStmt = $pdo->prepare($userCheckSql);
$userCheckStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
$userCheckStmt->execute();
$userExists = $userCheckStmt->fetchColumn();

if ($userExists) {
    
   // Prepare and execute the SQL query to insert the review
$sql = "INSERT INTO reviews (user_id, listing_id, review_text, rating, created_at)
VALUES (:userId, :listingId, :reviewText, :rating, NOW())";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
$stmt->bindParam(':listingId', $listingIdReview, PDO::PARAM_INT);
$stmt->bindParam(':reviewText', $reviewText, PDO::PARAM_STR);
$stmt->bindParam(':rating', $rating, PDO::PARAM_INT);

if ($stmt->execute()) {
// Return a success response to the JavaScript
$response = ['success' => true];
} else {
// Return an error response to the JavaScript
$response = ['success' => false, 'message' => $stmt->errorInfo(), 'sql' => $sql];
}

// Output the JSON response
header('Content-Type: application/json');
echo json_encode($response);
} else {
    // Return an error response if the user does not exist
    $response = ['success' => false, 'message' => 'User does not exist.'];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(); // Terminate script execution
}


} else {
    // Handle invalid request method (e.g., not a POST request)
    $response = ['success' => false, 'message' => 'Invalid request method.'];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
