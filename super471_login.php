<?php session_start(); ?>

<html>

	<head>

	<title> Superhero App Login </title>
		<link rel="stylesheet" type="text/css" href="css_and_imgs/super471_login_css.css">
	</head>
	<body>
		<div class="loginbox">
		<img src="css_and_imgs/silhouette-logo.png" class="silh-logo">
			<h1>Login</h1>
			<form method="post" >
				<p>Email</p>
				<input type="text" name="u_email" 
				value="<?php echo (isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''); ?>"
				placeholder = 'Enter Email'>
				<p>Password</p>
				<input type="password" name="user_pw" placeholder="Enter Password">
				<input type="checkbox" name="rem_login" value="Remember"><p2>Remember Me</p2>
				<input type="submit" name="" value="Login">
				<a href="./super471_register.php">Register New Account</a><br>
			</form>

		</div>
	</body>

	
</html>

<?php
$email = "";
$password = "";

require_once('./inc/dbinfo.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower(filter_var(trim($_POST['u_email']), FILTER_SANITIZE_EMAIL));
    $password = filter_var(trim($_POST['user_pw']), FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM user_data WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    $user_data = mysqli_fetch_array($result);
	
    //if(password_verify($password, $user_data['password'])){
        $_SESSION["user"] = $user_data['user_id'];
		$_SESSION["email"] = $user_data['email'];
		$_SESSION["user_type"] = $user_data['type'];
        header("Location: index.php");
    //}else{
    //   echo "'{$user_data['password']}' is not equal to '$pass_h' combination does not exist in database";
    //}
    
}


?>
