<?php
session_start();
require_once('DBconn.php');

// Get data from the login form

/*     GUARDIAN      */
$g_fullname = $_POST['g_fullname'] ?? NULL;
$g_address = $_POST['g_address'] ?? NULL;
$g_contact_no = $_POST['g_contact_no'] ?? NULL;

/*     BOARDER / OWNER       */
$fullname = $_POST['fullname'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$contact_no = $_POST['contact_no'];
$email = $_POST['email'];
$username = $_POST['username'];
$user_type = $_SESSION['user_type'];
$password = $_POST['password'];
$hashed_pass = md5($password);

// Regenerate session ID
session_regenerate_id(true);
$session_id = session_id();

$query = "INSERT INTO `accounts` (session_id, username, password, user_type, status) VALUES ('$session_id', '$username', '$hashed_pass', '$user_type', 'pending');";
$query = $query . " INSERT INTO `users` (session_id, g_fullname, g_address, g_contact_no, fullname, age, gender, contact_no, email) VALUES ('$session_id', '$g_fullname', '$g_address', '$g_contact_no', '$fullname', '$age', '$gender', '$contact_no', '$email');";

if ($conn->multi_query($query) === TRUE) {
  echo "Success creating user!";
} else {
  echo "Error creating user!";
}

$conn->close();

header('Location: ../login.php');
?>
