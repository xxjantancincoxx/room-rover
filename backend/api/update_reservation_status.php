<?php
session_start();
require_once('../../backend/DBconn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rsId = $_POST['rsId'];
    $status = $_POST['status'];

    // Update the reservation status in the database
    $sqlUpdateStatus = "UPDATE tbl_reservations SET status = '$status' WHERE rs_id = '$rsId'";
    // $stmtUpdateStatus = $pdo->prepare($sqlUpdateStatus);
    // $stmtUpdateStatus->bindParam(':status', $status, PDO::PARAM_INT);
    // $stmtUpdateStatus->bindParam(':rsId', $rsId, PDO::PARAM_INT);

    if ($conn->query($sqlUpdateStatus) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        $errorInfo = $conn -> connect_errno;
        echo json_encode(['success' => false, 'error' => 'Error updating status: ' . ($errorInfo[2] ?? 'Unknown error')]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
