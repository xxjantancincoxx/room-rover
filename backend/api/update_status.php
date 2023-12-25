<?php
session_start();

require_once('../../backend/DBconn.php');


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_POST["id"];

if ($_POST["status"] === "deactivate") {
  $query = "UPDATE `accounts` SET status = 'inactive' WHERE session_id = '$id';";

  if ($conn->query($query) === TRUE) {
    echo "Success updating user!";
  } else {
    echo "Error updating user!";
  }
} else if ($_POST["status"] === "activate") {
  $query = "UPDATE `accounts` SET status = 'active' WHERE session_id = '$id';";

  if ($conn->query($query) === TRUE) {
    echo "Success updating user!";
  } else {
    echo "Error updating user!";
  }
} else if ($_POST["status"] === "approve") {
  $query = "UPDATE `accounts` SET status = 'active' WHERE session_id = '$id';";

  if ($conn->query($query) === TRUE) {
    echo "Success updating user!";
  } else {
    echo "Error updating user!";
  }
}

$conn->close();

header('Location: ../../admin/user_management.php');
exit();
