<?php

session_start();
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST');
header('Content-Type:application/json');
include "DBconn.php";
include '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$secret_key = 'room_rover_app';

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
		$payload = [
			'iss' => "localhost",
			'aud' => 'localhost',
			'data' => [
				'session_id' => $row["session_id"],
				'username' => $row["username"],
				'user_type' => $row["user_type"],
			],
		];
		$jwt = JWT::encode($payload, $secret_key, 'HS256');
		$_SESSION['session'] = $jwt;
		$_SESSION['username'] = $row["username"];
		$_SESSION['user_type'] = $row["user_type"];
		$_SESSION['session_id'] = $row["session_id"];
		$_SESSION['id'] = $row["id"];

		echo "<script>console.log(" . $jwt . ");</script>" ;
		if ($row['user_type'] === "owner") {
			$url = 'Location: ../owner?session=' . $jwt;
			header($url);
			exit();
		} else if ($row['user_type'] === "boarder") {
			$url = 'Location: ../boarder?session=' . $jwt;
			header($url);
			exit();
		}
	} else {
		header("Location: ../login.php");
		exit();
	}
} else {
	$_SESSION['error'] = 'Invalid Username or Password!';
	header("Location: ../login.php");
	exit();
}
