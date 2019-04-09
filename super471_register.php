<?php session_start(); ?>

<html>

	<head>

	<title> Superhero App Login </title>
		<link rel="stylesheet" type="text/css" href="css_and_imgs/super471_register_css.css">
	</head>
	<body>
		<div class="loginbox">
		<img src="css_and_imgs/silhouette-logo.png" class="silh-logo">
			<h1>Login</h1>
			<form method="POST" /*action="<?php echo $_SERVER['PHP_SELF']; ?>"*/>
				<p>Email</p>
				<input type="text" name="u_email" placeholder="Enter Email">
				<p>Password</p>
				<input type="password" name="user_pw" placeholder="Enter Password">
				<input type="checkbox" name="rem_login" value="Remember"><p2>Remember Me</p2>
				<input type="submit" name="" value="Login">
				<a href="super471_login.php">Return to Login</a><br>
			</form>

		</div>
	</body>

	
</html>

<?php
$email = "";
$password = "";
$errors = "";

require_once('./inc/dbinfo.php'); 
$connection = mysqli_connect($dbserver, $dbusername, $dbpassword, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower(filter_var(trim($_POST['u_email']), FILTER_SANITIZE_EMAIL));
    $password = filter_var(trim($_POST['user_pw']), FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM user_data WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    $user_data = mysqli_fetch_array($result);
    
    if(password_verify($password, $user_data['password_hash'])){
        $_SESSION["user"] = $user_data['user_id'];
		$_SESSION["loggedin"] = True;
		$_SESSION["Imember"] = filter_var($_POST['rem_login'], FILTER_VALIDATE_BOOLEAN);
        header("Location: ./uaj300_dashboard.php");
    }else{
       echo "email password combination does not exist in database";
    }
    
}


?>
