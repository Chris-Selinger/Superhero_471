<?php
	session_start();
	
	//if (!isset($_SESSION["user_type"])) {
	//	header("Location: ../index.php");
	//}

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
				<a href="view_events.php">View Events</a><br>
				<a href="view_events.php">Create Event</a><br>
				<a href="view_events.php">View Heroes</a><br>
				<a href="logout.php">Logout</a><br>
			</form>

		</div>
	</body>

	
</html>
                <li>
                    
				</li>
                <li>
                    <a href="#" class="active1" onclick="return openPage('./add_event.php');"></i>Add Event</a>
				</li>
                <li>
                    <a href="#" class="active1" onclick="return openPage('./view_heroes.php');"></i>View Heroes</a>
				</li>
                    

</html>

