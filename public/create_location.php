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
      <label class="control-label col-sm-2" for="pwd">Name of Location</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" placeholder="Enter Name" name="name">
      </div>
    </div>
   
   <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Type of Location</label>
      <div class="col-sm-10">          
        <select class="form-control" placeholder="Enter Type" name="type">
			<option value="threat">Region</option>
			<option value="patrol">City/Town</option>
			<option value="publicity">Venue</option>
		</select>
      </div>
    </div>
   
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Latitude</label>
      <div class="col-sm-10">          
        <input type="number" class="form-control" placeholder="Enter Latitude" name="latitude">
      </div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Longitude</label>
      <div class="col-sm-10">          
        <input type="number" class="form-control" placeholder="Enter Longitude" name="longitude">
      </div>
    </div>
	
	<div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Address (if type is venue)</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" placeholder="Enter Address" name="address">
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
	
    if($_SERVER["REQUEST_METHOD"] == "POST") {

		$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
		$type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
		$lat = filter_var(trim($_POST['latitude']), FILTER_SANITIZE_STRING);
		$lon = filter_var(trim($_POST['longitude']), FILTER_SANITIZE_STRING);
		$address = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
		
        $query = "SELECT * FROM location_data WHERE name='$name' AND latitude='$lat' AND longitude='$lon';";
        $result = mysqli_query($connection, $query);
		if (null == $result){
			$location_id = guidv4(openssl_random_pseudo_bytes(16));
			$query = "INSERT INTO location_data (location_id, name, type, latitude, longitude, address) "
				. " VALUES ('$location_id', '$name', '$type', '$lat', '$lon', '$address');";
			$result = mysqli_query($connection, $query);
		}
    }

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