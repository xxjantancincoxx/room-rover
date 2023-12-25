<?php
require_once('../DBconn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lid = $_POST['listingId'];
    $uid = $_POST['userId'];
    $num_Rooms = $_POST['numberOfRooms'];

    // Check if the user already has an active reservation
    $sqlCheckReservation = "SELECT COUNT(*) as reserved FROM tbl_reservations WHERE uid = '$uid' AND status = 'Pending'";
    $result_temp = mysqli_query($conn, $sqlCheckReservation);
    $activeReservationCount = mysqli_fetch_assoc($result_temp);
    // $stmtCheckReservation = $pdo->prepare($sqlCheckReservation);
    // $stmtCheckReservation->bindParam(':uid', $uid);
    // $stmtCheckReservation->execute();

    // $activeReservationCount = $stmtCheckReservation->fetchColumn();

    if ($activeReservationCount["reserved"] > 4) {
        // User already has an active reservation, display an error message
        echo json_encode(['success' => false, 'message' => 'Maximum number of reservations reached.']);
    } else {
        // User doesn't have an active reservation, proceed to insert a new one
        $status = 0;

        // Perform the reservation and get the reservation_id
        $sqlInsertReservation = "INSERT INTO tbl_reservations (lid, uid, num_Rooms, status, date_created) VALUES ('$lid', '$uid', '$num_Rooms', '$status', DATE_FORMAT(NOW(), '%M %e, %Y'))";
        mysqli_query($conn, $sqlInsertReservation);
        // $stmt = $pdo->prepare($sqlInsertReservation);
        // $stmt->bindParam(':lid', $lid);
        // $stmt->bindParam(':uid', $uid);
        // $stmt->bindParam(':num_Rooms',$num_Rooms);
        // $stmt->bindParam(':status', $status);
        // $stmt->execute();

        // Retrieve the last inserted reservation ID
        // $rs_id = $pdo->lastInsertId();
        $rs_id = mysqli_insert_id($conn);

        // Insert payment details into the payment table
        $ewallet = $_POST['eWallet'];
        $accountName = $_POST['accountName'];
        $accountNumber = $_POST['accountNumber'];
        $referenceNumber = $_POST['referenceNumber'];
        $amountPaid = $_POST['amountPaid'];

        $sqlInsertPayment = "INSERT INTO payment (uid, ewallet, e_accountName, e_accountNumber, referenceNo, amountPaid, rs_id) VALUES ('$uid', '$ewallet', '$accountName', '$accountNumber', '$referenceNumber', '$amountPaid', '$rs_id')";

        mysqli_query($conn, $sqlInsertPayment);
        // $stmtInsertPayment = $pdo->prepare($sqlInsertPayment);
        // $stmtInsertPayment->bindParam(':uid', $uid);
        // $stmtInsertPayment->bindParam(':ewallet', $ewallet);
        // $stmtInsertPayment->bindParam(':e_accountName', $accountName);
        // $stmtInsertPayment->bindParam(':e_accountNumber', $accountNumber);
        // $stmtInsertPayment->bindParam(':referenceNo', $referenceNumber);
        // $stmtInsertPayment->bindParam(':amountPaid', $amountPaid);
        // $stmtInsertPayment->bindParam(':rs_id', $rs_id);
        // $stmtInsertPayment->execute();

        //
        // Retrieve the number of rooms reserved and the listing ID
        $numberOfRooms = $_POST['numberOfRooms']; // Assuming you are passing it in your AJAX request
        $listingId = $_POST['listingId'];

        // Update the tbl_listings table to deduct the reserved rooms
        $sqlUpdateRoomsAvailable = "UPDATE tbl_listings SET rooms_Available = rooms_Available - '$numberOfRooms' WHERE listing_id = '$listingId'";
        // $stmtUpdateRoomsAvailable = $pdo->prepare($sqlUpdateRoomsAvailable);
        // $stmtUpdateRoomsAvailable->bindParam(':numberOfRooms', $numberOfRooms, PDO::PARAM_INT);
        // $stmtUpdateRoomsAvailable->bindParam(':listingId', $listingId, PDO::PARAM_INT);

        // Execute the update statement
        if ($conn->query($sqlUpdateRoomsAvailable) === TRUE) { 
            // Update successful
            $response['success'] = true;
            $response['message'] = 'Reservation successfully added.';
        } else {
            // Update failed
            $response['success'] = false;
            $response['message'] = 'Error updating rooms available.';
        }

        echo json_encode($response);
        
    }
} else {
    // Handle other cases or errors
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
