<?php
session_start();
require_once('DBconn.php');

// Get data from the login form

/*     GUARDIAN      */
$g_fullname = $_POST['g_fullname'];
$g_address = $_POST['g_address'];
$g_contact_no = $_POST['g_contact_no'];

/*     BOARDER / OWNER       */
$fullname = $_POST['fullname'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$contact_no = $_POST['contact_no'];
$email = $_POST['email'];
$username = $_POST['username'];
$user_type = $_GET['type'];
$password = $_POST['password'];
$hashed_pass = md5($password);

// Regenerate session ID
session_regenerate_id(true);
$session_id = session_id();

// Insert into accounts table

$accountsQuery = "INSERT INTO accounts (session_id, username, password, user_type) VALUES ('$session_id', '$username', '$hashed_pass', '$user_type')";

if (mysqli_query($conn, $accountsQuery)) {
  echo "<script>console.log('New record created successfully for accounts table!');</script>";
} else {
  echo "<script>console.log('Error: " . $accountsQuery . "<br>" . $conn->error . "');</script>";
}

$usersQuery = "INSERT INTO users (session_id, g_fullname, g_address, fullname, age, gender, contact_no, email, g_contact_no) VALUES ('$session_id, '$g_fullname', '$g_address', '$fullname', '$age', '$gender', '$contact_no', '$email', '$g_contact_no')";

if (mysqli_query($conn, $usersQuery)) {
  echo "<script>console.log('New record created successfully for users table!');</script>";
} else {
  echo "<script>console.log('Error: " . $usersQuery . "<br>" . $conn->error . "');</script>";
}

$conn->close();

header('Location: ../login.php');
?>
