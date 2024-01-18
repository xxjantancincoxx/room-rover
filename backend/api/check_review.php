<?php
session_start();
require_once('../../backend/DBconn.php');

$is_owner_review = $_POST['isOwnerReview'];
if (strcmp($is_owner_review, "owner") === 0) {
  // Retrieve data from the AJAX request
  $owner_id = $_POST['owner_id'];
  $boarder_id = $_POST['boarder_id'];

  // Check if the user has already submitted a review for the selected listing
  $sqlCheckReview = "SELECT COUNT(*) AS reviewCount FROM owner_review WHERE owner_id = '$owner_id' AND boarder_id = '$boarder_id'";
  $result_temp = mysqli_query($conn, $sqlCheckReview);
  $sqlCheckReviewCount = mysqli_fetch_assoc($result_temp);

  $response = [];

  if ($sqlCheckReviewCount["reviewCount"] > 0) {
    $response['alreadyReviewed'] = true;
  } else {
    $response['alreadyReviewed'] = false;
  }

  header('Content-Type: application/json');
  echo json_encode($response);
} else {
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
}
