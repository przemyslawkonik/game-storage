<?php
	$username;
	if(isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
	}
	else {
		$username = "";
	}
?>

<nav class="navbar navbar-inverse">
	<ul class="nav navbar-nav">
		<li><a href="home.php">Homepage</a></li>
		<li><a href="home.php">Games</a></li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
		<li><a>Logged as <?php echo $username?></a></li>
		<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
	</ul>
</nav>