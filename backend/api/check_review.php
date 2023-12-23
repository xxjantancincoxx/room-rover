<?php
session_start();
require_once('../../backend/DBconn.php');

// Retrieve data from the AJAX request
$listingIdReview = $_POST['listingIdReview'];
$userId = $_POST['userId'];

// Check if the user has already submitted a review for the selected listing
$sqlCheckReview = "SELECT COUNT(*) AS reviewCount FROM reviews WHERE listing_id = '$listingIdReview' AND user_id = '$userId'";
$result_temp = mysqli_query($conn, $sqlCheckReview);
$sqlCheckReviewCount = mysqli_fetch_assoc($result_temp);
// $stmtCheckReview = $pdo->prepare($sqlCheckReview);
// $stmtCheckReview->bindParam(':listingId', $listingIdReview, PDO::PARAM_INT);
// $stmtCheckReview->bindParam(':userId', $userId, PDO::PARAM_INT);
// $stmtCheckReview->execute();

// $reviewCount = $stmtCheckReview->fetch(PDO::FETCH_ASSOC)['reviewCount'];

// Prepare the response
$response = [];

if ($sqlCheckReviewCount["reviewCount"] > 0) {
	// User has already submitted a review for this listing
	$response['alreadyReviewed'] = true;
} else {
	// User has not submitted a review for this listing
	$response['alreadyReviewed'] = false;
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
