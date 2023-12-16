<?php
session_start();
require_once('DBconn.php');

// Get data from the login form
$g_lastname = $_POST['g_lastname'] ?? null;
$g_middlename = $_POST['g_middlename'] ?? null;
$g_firstname = $_POST['g_firstname'] ?? null;
$g_address = $_POST['g_address'] ?? null;
$lastname = $_POST['lastname'];
$middlename = $_POST['middlename'];
$firstname = $_POST['firstname'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$contact_no = $_POST['contact_no'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$user_type = $_POST['user_type'];
$hashed_pass = md5($password);

// Regenerate session ID
session_regenerate_id(true);
$session_id = session_id();

// Insert into accounts table
$query1 = "INSERT INTO accounts (session_id, username, password, user_type) VALUES (:session_id, :username, :password, :user_type)";
$stmt1 = $pdo->prepare($query1);
$stmt1->bindParam(':session_id', $session_id, PDO::PARAM_STR);
$stmt1->bindParam(':username', $username, PDO::PARAM_STR);
$stmt1->bindParam(':password', $hashed_pass, PDO::PARAM_STR);
$stmt1->bindParam(':user_type', $user_type, PDO::PARAM_STR);
$stmt1->execute();

// Insert into users table
$query2 = "INSERT INTO users (session_id, g_lastname, g_middlename, g_firstname, g_address, lastname, middlename, firstname, age, gender, contact_no, email) VALUES (:session_id, :g_lastname, :g_middlename, :g_firstname, :g_address, :lastname, :middlename, :firstname, :age, :gender, :contact_no, :email)";
$stmt2 = $pdo->prepare($query2);
$stmt2->bindParam(':session_id', $session_id, PDO::PARAM_STR);
$stmt2->bindParam(':g_lastname', $g_lastname, PDO::PARAM_STR);
$stmt2->bindParam(':g_middlename', $g_middlename, PDO::PARAM_STR);
$stmt2->bindParam(':g_firstname', $g_firstname, PDO::PARAM_STR);
$stmt2->bindParam(':g_address', $g_address, PDO::PARAM_STR);
$stmt2->bindParam(':lastname', $lastname, PDO::PARAM_STR);
$stmt2->bindParam(':middlename', $middlename, PDO::PARAM_STR);
$stmt2->bindParam(':firstname', $firstname, PDO::PARAM_STR);
$stmt2->bindParam(':age', $age, PDO::PARAM_INT);
$stmt2->bindParam(':gender', $gender, PDO::PARAM_STR);
$stmt2->bindParam(':contact_no', $contact_no, PDO::PARAM_STR);
$stmt2->bindParam(':email', $email, PDO::PARAM_STR);
$stmt2->execute();

// Redirect to login page regardless of query success or failure
header('Location: ../login.php');
?>
