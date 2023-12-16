<?php

require_once('../../backend/DBconn.php'); // Adjust the path as needed

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the rsId parameter is set
    if (isset($_POST['rsId'])) {
        // Get the reservation ID from the POST data
        $rsId = $_POST['rsId'];

        try {
            // Fetch the listing ID and number of rooms for the reservation
            $reservationDetailsSql = "SELECT lid, num_Rooms FROM tbl_reservations WHERE rs_id = :rsId";
            $reservationDetailsStmt = $pdo->prepare($reservationDetailsSql);
            $reservationDetailsStmt->bindParam(':rsId', $rsId, PDO::PARAM_INT);
            $reservationDetailsStmt->execute();
            $reservationDetails = $reservationDetailsStmt->fetch(PDO::FETCH_ASSOC);

            if ($reservationDetails) {
                $listingId = $reservationDetails['lid'];
                $numberOfRooms = $reservationDetails['num_Rooms'];

                // Update the number of available rooms in tbl_listings
                $updateRoomsSql = "UPDATE tbl_listings SET rooms_Available = rooms_Available + :numberOfRooms WHERE listing_id = :listingId";
                $updateRoomsStmt = $pdo->prepare($updateRoomsSql);
                $updateRoomsStmt->bindParam(':numberOfRooms', $numberOfRooms, PDO::PARAM_INT);
                $updateRoomsStmt->bindParam(':listingId', $listingId, PDO::PARAM_INT);
                $updateRoomsStmt->execute();
            }

            // Delete related records in the payment table first
            $deletePaymentSql = "DELETE FROM payment WHERE rs_id = :rsId";
            $deletePaymentStmt = $pdo->prepare($deletePaymentSql);
            $deletePaymentStmt->bindParam(':rsId', $rsId, PDO::PARAM_INT);
            $deletePaymentStmt->execute();

            // Your SQL query to delete the reservation
            $deleteSql = "DELETE FROM tbl_reservations WHERE rs_id = :rsId";
            $deleteStmt = $pdo->prepare($deleteSql);
            $deleteStmt->bindParam(':rsId', $rsId, PDO::PARAM_INT);
            $deleteStmt->execute();

            // Check if the delete was successful
            if ($deleteStmt->rowCount() > 0) {
                // If successful, send a JSON response indicating success
                http_response_code(200); // OK
                echo json_encode(['success' => true]);
            } else {
                // If no rows were affected, send a JSON response indicating failure
                http_response_code(400); // Bad Request
                echo json_encode(['success' => false, 'error' => 'No rows were affected']);
            }
        } catch (PDOException $e) {
            // Log the error to the PHP error log for debugging
            error_log("PDOException: " . $e->getMessage());

            // Echo the error for client-side debugging (remove in production)
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        // If rsId parameter is not set, send a JSON response indicating failure
        http_response_code(400); // Bad Request
        echo json_encode(['success' => false, 'error' => 'Reservation ID not provided']);
    }
} else {
    // If the request method is not POST, send a JSON response indicating failure
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
