<?php
require_once('../DBconn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_POST['user_id'];
  $owner_id = $_POST['owner_id'];
  $reason = $_POST['reason'];
  $listing_id = $_POST['listing_id'];

  $queryInsert = "INSERT INTO `terminate` (owner_id, boarder_id, reason, date, lid) 
                  VALUES ('$owner_id', '$user_id', '$reason', NOW(), '$listing_id')";

  if (mysqli_query($conn, $queryInsert) === TRUE) {
    $queryUpdate = "UPDATE `accounts` SET status = 'inactive' WHERE id = '$user_id'";

    if ($conn->query($queryUpdate) === TRUE) {
      // Update successful
      $response['success'] = true;
      $response['message'] = 'Successfully terminated.';
    } else {
      // Update failed
      $response['success'] = false;
      $response['message'] = 'Error terminating.';
    }

  }
  echo json_encode($response);
} else {
  // Handle other cases or errors
  echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
