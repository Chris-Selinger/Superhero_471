<?php
	session_start();
	
	//if (!isset($_SESSION["user_type"])) {
	//	header("Location: ../index.php");
	//}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Staff <Entry></Entry></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Enter Event Information </h2>
  <form class="form-horizontal" method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
   
   <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Type of Event:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" placeholder="Enter Type" name="type">
      </div>
    </div>
   
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Description</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" placeholder="Enter Description" name="description">
      </div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Location</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" placeholder="Enter Location" name="location">
      </div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Date:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" placeholder="Enter Date" name="date">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>  
        <a href="index.php"> Return to Menu </a>    

      </div>
    </div>
  </form>
</div>

</body>
</html>
   

<?php
	require_once('../inc/dbinfo.php');
	
	$user = $_SESSION['user'];
	$sql = "SELECT * FROM user_data WHERE user_id = '$user'";
	$result = mysqli_query($connection, $sql);
    $user_data = mysqli_fetch_array($result);
/*
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $query = "";
        $result = mysqli_query($connection, $query);
    }
*/

//Generates UUID
//credit to Jack on stackoverflow
	function guidv4($data)
{
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
?>