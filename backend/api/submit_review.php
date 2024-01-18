<?php
session_start();
require_once('../../backend/DBconn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $is_owner_review = $_POST['isOwnerReview'];

  if (strcmp($is_owner_review, "owner") === 0) {
    $boarder_id = $_POST['boarder_id'];
    $owner_id = $_POST['owner_id'];
    $reviewText = $_POST['reviewText'];
    $rating = $_POST['rating'];


    $userCheckSql = "SELECT COUNT(*) as user FROM accounts WHERE id = '$owner_id'";

    $result_temp = mysqli_query($conn, $userCheckSql);
    $userExists = mysqli_fetch_assoc($result_temp);

    if ($userExists["user"]) {

      $sql = "INSERT INTO owner_review (owner_id, boarder_id, review_text, rating, created_at)
          VALUES ('$owner_id', '$boarder_id', '$reviewText', '$rating', NOW())";

      if ($conn->query($sql) === TRUE) {
        $response = ['success' => true];
      } else {
        $response = ['success' => false, 'message' => $stmt->errorInfo(), 'sql' => $sql];
      }

      header('Content-Type: application/json');
      echo json_encode($response);
    } else {
      $response = ['success' => false, 'message' => 'User does not exist.'];
      header('Content-Type: application/json');
      echo json_encode($response);
      exit();
    }
  } else {
    // Retrieve review details from the POST data
    $listingIdReview = $_POST['listingIdReview'];
    $reviewText = $_POST['reviewText'];
    $rating = $_POST['rating'];
    $userId = $_SESSION['id'];

    // Validate or sanitize input data as needed

    // Check if the user exists in the users table
    $userCheckSql = "SELECT COUNT(*) as user FROM accounts WHERE id = '$userId'";
    // $userCheckStmt = $pdo->prepare($userCheckSql);
    // $userCheckStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    // $userCheckStmt->execute();
    // $userExists = $userCheckStmt->fetchColumn();
    $result_temp = mysqli_query($conn, $userCheckSql);
    $userExists = mysqli_fetch_assoc($result_temp);

    if ($userExists["user"]) {

      // Prepare and execute the SQL query to insert the review
      $sql = "INSERT INTO reviews (user_id, listing_id, review_text, rating, created_at)
          VALUES ('$userId', '$listingIdReview', '$reviewText', '$rating', NOW())";

      // $stmt = $pdo->prepare($sql);
      // $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
      // $stmt->bindParam(':listingId', $listingIdReview, PDO::PARAM_INT);
      // $stmt->bindParam(':reviewText', $reviewText, PDO::PARAM_STR);
      // $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);

      if ($conn->query($sql) === TRUE) {
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
  }
} else {
  // Handle invalid request method (e.g., not a POST request)
  $response = ['success' => false, 'message' => 'Invalid request method.'];
  header('Content-Type: application/json');
  echo json_encode($response);
}
