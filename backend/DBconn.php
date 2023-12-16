<?php
// Database Configuration
$DB_SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "db_room_rover";
$BASE_URL = "localhost/room_rover";

$conn = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Database Connection
// try {
//     $pdo = new PDO("mysql:host=$DB_SERVER; dbname=$DB_NAME", $DB_USERNAME, $DB_PASSWORD);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
// } catch (PDOException $error) {
//     die("Connection failed: " . $error->getMessage());
// }

if (!$conn) {
    echo "Cannot connect to database!";
}



?>