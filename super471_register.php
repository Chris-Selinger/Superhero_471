<?php session_start(); ?>

<html>

	<head>

	<title> Superhero App Registration </title>
		<link rel="stylesheet" type="text/css" href="css_and_imgs/super471_register_css.css">
	</head>
	<body>
		<div class="loginbox">
		<img src="css_and_imgs/silhouette-logo.png" class="silh-logo">
			<h1>Register</h1>
			<form method="POST" /*action="<?php echo $_SERVER['PHP_SELF']; ?>"*/>
				<p>Email</p>
				<input type="text" name="u_email" placeholder="Enter Email">
				<p>Password</p>
				<input type="password" name="u_pw" placeholder="Enter Password">
				<p>Name</p>
				<input type="text" name="u_name" placeholder="Enter Name">
				<input type="checkbox" name="rem_login" value="Hero"><p2>I am a Hero</p2>
				<input type="submit" name="" value="Register">
				<a href="super471_login.php">Return to Login</a><br>
			</form>

		</div>
	</body>

	
</html>

<?php
$email = "";
$password = "";
$name = "";

require_once('./inc/dbinfo.php'); 
$connection = mysqli_connect($dbserver, $dbusername, $dbpassword, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower(filter_var(trim($_POST['u_email']), FILTER_SANITIZE_EMAIL));
    $password = filter_var(trim($_POST['u_pw']), FILTER_SANITIZE_STRING);
	$name = filter_var(trim($_POST['u_name']), FILTER_SANITIZE_STRING);

	$check_exists = "SELECT * FROM user_data WHERE email = '$email'";
	
	if (null!=$email and null!=$password and null!=$name){
	if (0 == mysqli_num_rows(mysqli_query($connection, $check_exists))){

		$user_id = guidv4(openssl_random_pseudo_bytes(16));
		$pass_h = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO user_data (email, name, user_id, password) "
			. "VALUES ( '$email', '$name', '$user_id', '$pass_h')";

		if (mysqli_query($connection, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($connection);
		}
	} else {
		echo "email in use";
	}
	} else {
		echo "missing required field";
	}
    
}

//Generates UUID
//credit to Jack on stackoverflow
function guidv4($data)
{
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

?>
