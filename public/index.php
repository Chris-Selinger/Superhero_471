<?php
	session_start();
	
	if (!isset($_SESSION["user"])) {
		header("Location: ../index.php");
	}

	require_once('../inc/dbinfo.php');
	
	$user = $_SESSION['user'];
	$sql = "SELECT * FROM user_data WHERE user_id = '$user'";
	$result = mysqli_query($connection, $sql);
    $user_data = mysqli_fetch_array($result);

?>


<html>

	<head>

	<title> Superhero App Options </title>
		<link rel="stylesheet" type="text/css" href="../css_and_imgs/super471_login_css.css">
	</head>
	<body>
		<div class="loginbox">
		<img src="../css_and_imgs/silhouette-logo.png" class="silh-logo">
			<h1>Options</h1>
			<form >
				<h1><a href="view_my_events.php">View My Events</a><br></h1>
				<h1><a href="view_events.php">View All Events</a><br></h1>
				<h1><a href="create_event.php">Create An Event</a><br></h1>
				<h1><a href="view_heroes.php">View Heroes</a><br></h1>
				<h1><a href="user_settings_h.php">My Settings</a><br></h1>
				<h1><a href="logout.php">Logout</a><br></h1>
			</form>

		</div>
	</body>

	
</html>
