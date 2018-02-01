<?php
	session_start();
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
		<form method="post" action="login.php" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-sm-2" for="username">Username</label>
				<div class="col-sm-10">
					<input class="form-control" type="text" id="username" name="username"/>
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
						printSessionError("login_error");
						unset($_SESSION['login_error']);
					?>
				</div>
			</div>
			
			<div class="form-group">        
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">Log in</button>
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
