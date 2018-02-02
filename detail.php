<?php
	session_start();
	
	require_once "conn.php";
	$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
	
	$id = $_REQUEST['id'];
	$result = $conn->query("SELECT * FROM game WHERE id='$id'");
	$game = $result->fetch_assoc();
		
	$userId = $game['author'];
	$userResult = $conn->query("SELECT * FROM user WHERE id='$userId'");
	$user = $userResult->fetch_assoc();
		
	$conn->close();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<meta charset="utf-8"/>
<head>
<body>

	<?php include 'menu_home.php';?>
	
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-2">
					<span>Title: <strong><?php echo $game['name']?></strong></span>
				</div>
				<div class="col-md-2">
					<span>Author: <strong><?php echo $user['username']?></strong></span>
				</div>
				<div class="col-md-2">
					<span>Category: <strong><?php echo $game['category']?></strong></span>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<span><?php echo $game['description']?></span>
		</div>
	</div>

	<a href="home.php" class="btn btn-primary">Back</a>
	
</body>