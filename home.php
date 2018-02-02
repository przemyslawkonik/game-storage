<?php
	session_start();
	
	require_once "conn.php";
	$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
	$result;
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<meta charset="utf-8"/>
<head>
<body>

	<?php include 'menu_home.php';?>
	
	<nav class="navbar">
		<form method="post" class="navbar-form navbar-left">
			<label class="form-check-label radio-inline"><input class="form-check-input" type="radio" name="category" value="video">Video</label>
			<label class="form-check-label radio-inline"><input class="form-check-input" type="radio" name="category" value="board">Board</label>
			<label class="form-check-label radio-inline"><input class="form-check-input" type="radio" name="category" value="others">Others</label>
			<input class="btn btn-primary" type="submit" name="search" class="btn btn-default" value="Search"/>
		</form>
		
		<div class="navbar-form navbar-right">
			<a href="add_game.php" class="btn btn-primary">Create new</a>
		</div>
	</nav>
	
	<?php
		if(isset($_POST['search'])) {
			if(isset($_POST['category'])) {
				$category = $_POST['category'];
				$result = $conn->query("SELECT * FROM game WHERE category='$category'");
				createTable($result);
			}
			else {
				$result = $conn->query("SELECT * FROM game");
				createTable($result);
			}
		} 
		else {
			$result = $conn->query("SELECT * FROM game");
			createTable($result);
		}
		
		$result->close();
		$conn->close();
	?>
	
</body>

<?php
	function createTable($data) {
		if($data->num_rows > 0) {
			echo
			"<table class='table table-striped table-hover'>
			<tr>
			<th>Name</th>
			<th>Category</th>
			<th>Author</th>
			<th>Details</th>
			</tr>";
			
			while($row = $data->fetch_assoc()) {
				$userResult = $GLOBALS["conn"]->query("SELECT * FROM user WHERE id=".$row['author']);
				$user = $userResult->fetch_assoc();

				echo 
				"<tr>
				<td>".$row['name']."</td>
				<td>".$row['category']."</td>
				<td>".$user['username']."</td>
				<td><a href='detail.php?id=".$row['id']."'>more</a></td>
				</tr>";
				
				$userResult->close();
			}
			echo "</table>";
		}
	}
?>