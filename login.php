<?php
	session_start();

	require_once "conn.php";
	$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$result = $conn->query("SELECT * FROM user WHERE username='$username'");
	
	if($username == "admin") {
		if($password == "admin") {
			$_SESSION['user_id'] = 1;
			$_SESSION['username'] = "admin";
			saveLoginData(1, "succes");
			header('Location: home.php');
			exit();
		}
		else {
			saveLoginData(1, "fail");
			$_SESSION['login_error'] = "Invalid login data";
			header('Location: index.php');
			exit();
		}
	}
	
	if($result->num_rows == 1) {
		$user = $result->fetch_assoc();

		if(password_verify($password, $user['password'])) {
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			saveLoginData($user['id'], "sucess");
			header('Location: home.php');
		}
		else {
			saveLoginData($user['id'], "fail");
			$_SESSION['login_error'] = "Invalid login data";
			header('Location: index.php');
		}
	}
	else {
		$_SESSION['login_error'] = "Invalid login data";
		header('Location: index.php');
	}
	
	$result->close();
	$conn->close();

	function saveLoginData($userId, $status) {
		$ip = $_SERVER["REMOTE_ADDR"];
		$GLOBALS["conn"]->query("INSERT INTO login (ip, status, user_id) VALUES ('$ip', '$status', '$userId')");
	}
?>

