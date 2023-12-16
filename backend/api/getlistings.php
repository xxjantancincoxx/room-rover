<?php 
session_start();
require_once('../DBconn.php');


$owner_id = $_SESSION['id'];

$query = "SELECT * FROM tbl_listings WHERE owner_id = :owner_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':owner_id', $owner_id, PDO::PARAM_STR);

$stmt->execute();

if ($stmt->rowCount() > 0) {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);

}else{
    echo json_encode(NULL);
}




?>