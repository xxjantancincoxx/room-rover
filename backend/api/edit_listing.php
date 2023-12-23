<?php
session_start();
require_once('../../backend/DBconn.php');

// Check if the user is logged in and has a valid session
if (!isset($_SESSION['id'])) {
  // You might want to handle this case accordingly, e.g., redirect the user to the login page
  header('Location: ../../index.php');
  exit();
  // echo json_encode(['success' => false, 'error' => 'User not logged in']);
  exit;
}

// Set the session ID
$sessionId = $_SESSION['id'];

// Check if necessary POST data is provided
if (isset($_POST['listingId'], $_POST['newLiName'], $_POST['newLiWal'], $_POST['newLiLoc'], $_POST['newPrice'], $_POST['newRooms'], $_POST['newWe'], $_POST['newAircon'], $_POST['newWifi'], $_POST['newOwnCr'])) {
  $listingId = $_POST['listingId'];
  $newLiName = $_POST['newLiName'];
  $newLiWal = $_POST['newLiWal'];
  $newLiLoc = $_POST['newLiLoc'];
  $newPrice = $_POST['newPrice'];
  $newRooms = $_POST['newRooms'];
  $newWe = $_POST['newWe'];
  $newAircon = $_POST['newAircon'];
  $newWifi = $_POST['newWifi'];
  $newOwnCr = $_POST['newOwnCr'];
  $pics_json = null;
  $ewalletQrCode = null;
  $qr_temp_name = null;


  // $stmt = null;

  if (isset($_FILES['editListingPic'])) {

    $folder = __DIR__ . "/uploads/OWNER" . $sessionId . "/";
    $total = count($_FILES['editListingPic']['name']);
    $listing_pic_array = array();

    // New image uploaded, handle it
    $newImage = $_FILES['editListingPic'];

    if (!file_exists($folder)) {
      @mkdir($folder, 0755, true);
    }

    for ($i = 0; $i < $total; $i++) {

      // //Get the temp file path
      $tmpFilePath = $_FILES['editListingPic']['tmp_name'][$i];

      // //Make sure we have a file path
      if ($tmpFilePath != "") {
        //Setup our new file path

        $newFilePath = $folder . $_FILES['editListingPic']['name'][$i];

        //   //Upload the file into the temp dir
        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
          $listing_pic_array["name" . $i] = $_FILES['editListingPic']['name'][$i];
        }
      }
    }

    $pics_json = json_encode($listing_pic_array);

    // if (move_uploaded_file($newImage['tmp_name'], $newImagePath)) {
    //     // File upload successful
    //     error_log('File uploaded successfully:');
    //     error_log('File Name: ' . $newImage['name']);
    //     error_log('File Size: ' . $newImage['size']);
    //     error_log('File Path: ' . $newImagePath);

    //     // Update the database with the new file path ($newImagePath)
    //     $stmt = $pdo->prepare("UPDATE tbl_listings SET name = :newLiName, e_wallet = :newLiWal, location = :newLiLoc, price = :newPrice, rooms_Available = :newRooms, free_water_electric = :newWe, is_aircon = :newAircon, free_wifi = :newWifi, own_cr = :newOwnCr, pic = :newFileName WHERE listing_id = :listingId");

    //     // Bind parameters
    //     $stmt->bindParam(':newFileName', $newImage['name'], PDO::PARAM_STR);
    // }
  }

  if (isset($_FILES["ewallet_qr_code"])) {
    $ewalletQrCode = $_FILES["ewallet_qr_code"];
    $ewalletTarget = $folder . $ewalletQrCode["name"]; // Add this line to define $ewalletTarget
    $qr_temp_name = $ewalletQrCode["tmp_name"];
    move_uploaded_file($qr_temp_name, $ewalletTarget);
  }

  // File was not uploaded, update only other fields
  // $stmt = $pdo->prepare("UPDATE tbl_listings SET name = :newLiName, e_wallet = :newLiWal, location = :newLiLoc, price = :newPrice, rooms_Available = :newRooms, free_water_electric = :newWe, is_aircon = :newAircon, free_wifi = :newWifi, own_cr = :newOwnCr WHERE listing_id = :listingId");
  $sql = "UPDATE tbl_listings SET name = '$newLiName', e_wallet = '$newLiWal', location = '$newLiLoc', price = '$newPrice', rooms_Available = '$newRooms', free_water_electric = '$newWe', is_aircon = '$newAircon', free_wifi = '$newWifi', own_cr = '$newOwnCr' ";
  if (isset($pics_json)) $sql = $sql . ", pic = '$pics_json' ";
  if (isset($qr_temp_name)) $sql = $sql . ", qr_pic = '$qr_temp_name'";
  $sql = $sql . " WHERE listing_id = '$listingId';";

  $result = mysqli_query($conn, $sql);

  if ($conn->query($sql) === TRUE) {
    header("Location: ../../owner/my_listings.php?session=" . $_SESSION["session_id"]);
    exit();
  } else {
    echo "Failed!";
  }

  // Check if $stmt is not null before binding parameters
  // if ($stmt) {
  //   // Bind common parameters
  //   $stmt->bindParam(':listingId', $listingId, PDO::PARAM_INT);
  //   $stmt->bindParam(':newLiName', $newLiName, PDO::PARAM_STR);
  //   $stmt->bindParam(':newLiWal', $newLiWal, PDO::PARAM_STR);
  //   $stmt->bindParam(':newLiLoc', $newLiLoc, PDO::PARAM_STR);
  //   $stmt->bindParam(':newPrice', $newPrice, PDO::PARAM_INT);
  //   $stmt->bindParam(':newRooms', $newRooms, PDO::PARAM_INT);
  //   $stmt->bindParam(':newWe', $newWe, PDO::PARAM_INT);
  //   $stmt->bindParam(':newAircon', $newAircon, PDO::PARAM_INT);
  //   $stmt->bindParam(':newWifi', $newWifi, PDO::PARAM_INT);
  //   $stmt->bindParam(':newOwnCr', $newOwnCr, PDO::PARAM_INT);

  //   // Execute the query
  //   if ($stmt->execute()) {
  //     // Return a success response
  //     header('Content-Type: application/json');
  //     echo json_encode(['success' => true]);
  //   } else {
  //     // Return an error response
  //     header('Content-Type: application/json');
  //     echo json_encode(['success' => false, 'error' => 'Failed to update listing']);
  //   }

  //   // Close the statement
  //   $stmt->closeCursor();
  // } else {
  //   // Return an error if $stmt is null
  //   header('Content-Type: application/json');
  //   echo json_encode(['success' => false, 'error' => 'Failed to prepare statement']);
  // }

  // // Close the database connection
  // $pdo = null;
}

// else {
//   // Return an error if the necessary POST data is not provided
//   header('Content-Type: application/json');
//   echo json_encode(['success' => false, 'error' => 'Invalid POST data']);
// }
