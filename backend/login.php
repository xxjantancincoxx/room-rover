<?php

session_start();
include "DBconn.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
}

$username = validate($_POST['username']);
$pass = validate($_POST['password']);
$hashed_pass = md5($pass);

$sql = "SELECT * FROM accounts WHERE username ='$username' AND password='$hashed_pass'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
	$row = mysqli_fetch_assoc($result);
	if ($row["username"] === $username && $row["password"] === $hashed_pass) {
		setcookie("username",$username, time()+3600*2);
		switch ($row['user_type']) {
			case 'owner':
				header('Location: ../owner');
				break;
			case 'boarder':
				header('Location: ../boarder');
				break;
			default:
				die('Invalid user type');
		}
		if ($_SESSION['user_type'] === "owner") {
			header('Location: ../owner');
		} else if ($_SESSION['user_type'] === "boarder") {
			header('Location: ../boarder');
		}
		exit();
	} else {
		header("Location: ../login.php");
		exit();
	}
} else {
	$_SESSION['error'] = 'Invalid Username or Password!';
	header("Location: ../login.php");
	exit();
}
?>
