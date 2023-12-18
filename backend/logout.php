<?php
session_start();

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page or homepage
header("Location: ../index.php"); // Change this to the appropriate URL
exit();
?>
