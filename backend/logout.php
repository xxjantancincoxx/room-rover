<?php
session_start();

$helper = array_keys($_SESSION);
foreach ($helper as $key) {
  unset($_SESSION[$key]);
}

// Destroy the session
session_destroy();

// Redirect to the login page or homepage
header("Location: ../index.php"); // Change this to the appropriate URL
exit();
