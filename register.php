<?php
	session_start();
	
	if(isset($_POST['submit'])) {
		$valid = true;
		$username = $_POST['username'];
		$email = $_POST['email'];
		$filterEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];

		if(strlen($username) <= 0) {
			$valid = false;
			$_SESSION['error_username'] = "Username cannot be empty";
		}

		if((filter_var($filterEmail, FILTER_VALIDATE_EMAIL) == false) || ($email != $filterEmail)) {
			$valid = false;
			$_SESSION['error_email'] = "Enter correct email";
		}
		
		if(strlen($password) <= 0) {
			$valid = false;
			$_SESSION['error_password'] = "Password cannot be empty";
		}
		
		if($password != $confirm_password) {
			$valid = false;
			$_SESSION['error_password'] = "Both passwords must match";
		}

		if($valid == true) {
			require_once "conn.php";
			$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
			
			$result = $conn->query("SELECT id FROM user WHERE username='$username'");
			if($result->num_rows == 1) {
				$valid = false;
				$_SESSION['error_username'] = "Username already taken";
			}
			
			$result = $conn->query("SELECT id FROM user WHERE email='$email'");
			if($result->num_rows == 1) {
				$valid = false;
				$_SESSION['error_email'] = "Email already taken";
			}
			
			if($valid == true) {
				$hashPassword = password_hash($password, PASSWORD_DEFAULT);
				if($conn->query("INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$hashPassword')")) {
					header('Location: logout.php');
				}
			}
			
			$result->close();
			$conn->close();
		}
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<meta charset="utf-8"/>
<head>
<body>

	<?php include 'menu_index.php';?>

	<div class="container">
		<form method="post" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-sm-2" for="username">Username</label>
				<div class="col-sm-10">
					<input class="form-control" type="text" id="username" name="username"/>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2"></label>
				<div class="col-sm-10">
					<?php
						printSessionError("error_username");
						unset($_SESSION["error_username"]);
					?>
				</div>
			</div>
	
			<div class="form-group">
				<label class="control-label col-sm-2" for="email">Email</label>
				<div class="col-sm-10">
					<input class="form-control" type="text" id="email" name="email"/>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2"></label>
				<div class="col-sm-10">
					<?php
						printSessionError("error_email");
						unset($_SESSION["error_email"]);
					?>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="password">Password</label>
				<div class="col-sm-10">
					<input class="form-control" type="password" id="password" name="password"/>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2"></label>
				<div class="col-sm-10">
					<?php
						printSessionError("error_password");
						unset($_SESSION["error_password"]);
					?>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2" for="confirm_password">Confirm password</label>
				<div class="col-sm-10">
					<input class="form-control" type="password" id="confirm_password" name="confirm_password"/>
				</div>
			</div>

			<div class="form-group">        
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" name="submit" class="btn btn-primary">Register</button>
				</div>
			</div>
		</form>
	</div>

</body>

<?php
	function printSessionError($error) {
		if(isset($_SESSION[$error])) {
			echo "<span class='text-danger'>$_SESSION[$error]</span>";
		}
	}
?>