<?php
	session_start();
	
	if(isset($_POST['submit'])) {
		$valid = true;
		$title = $_POST['title'];
		$category = $_POST['category'];
		$description = $_POST['description'];

		if(strlen($title) <= 0) {
			$valid = false;
			$_SESSION['error_title'] = "Game must have some title";
		}
		
		if(strlen($description) <= 0) {
			$valid = false;
			$_SESSION['error_description'] = "Game must have some description";
		}

		if($valid == true) {
			require_once "conn.php";
			$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
			
			$result = $conn->query("SELECT * FROM game WHERE name='$title'");
			if($result->num_rows == 1) {
				$game = $result->fetch_assoc();
				if($game['category'] == $category) {
					$valid = false;
					$_SESSION['error_title'] = "Game with this title already exists in this category";
				}
			}
			
			if($valid == true) {
				$userId = $_SESSION['user_id'];
				if($conn->query("INSERT INTO game (name, description, category, author) VALUES ('$title', '$description', '$category', '$userId')")) {
				header('Location: home.php');
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

	<?php include 'menu_home.php';?>

	<div class="container">
		<form method="post" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-sm-2" for="title">Title</label>
				<div class="col-sm-10">
					<input class="form-control" type="text" id="title" name="title"/>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2"></label>
				<div class="col-sm-10">
					<?php
						printSessionError("error_title");
						unset($_SESSION["error_title"]);
					?>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Category</label>
				<div class="col-sm-10">
					<label class="form-check-label radio-inline"><input class="form-check-input" type="radio" name="category" value="others" checked="checked">Others</label>
					<label class="form-check-label radio-inline"><input class="form-check-input" type="radio" name="category" value="video">Video</label>
					<label class="form-check-label radio-inline"><input class="form-check-input" type="radio" name="category" value="board">Board</label>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2" for="description">Description</label>
				<div class="col-sm-10">
					<textarea class="form-control" type="text" id="description" name="description" rows="5"></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2"></label>
				<div class="col-sm-10">
					<?php
						printSessionError("error_description");
						unset($_SESSION["error_description"]);
					?>
				</div>
			</div>

			<div class="form-group">        
				<div class="col-sm-offset-2 col-sm-10">
					<a href="home.php" class="btn btn-primary">Back</a>
					<button type="submit" name="submit" class="btn btn-primary">Create</button>
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