<?php
	session_start();
	
	//if (!isset($_SESSION["user_type"])) {
	//	header("Location: ../index.php");
	//}
	
	require_once('../inc/dbinfo.php');
	
	$user = $_SESSION['user'];
	$sql = "SELECT * FROM user_data WHERE user_id = '$user'";
	$result = mysqli_query($connection, $sql);
    $user_data = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create Event</title>
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
      <label class="control-label col-sm-2" for="pwd">Name of Event</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" placeholder="Enter Name" name="name">
      </div>
    </div>
   
   <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Type of Event</label>
      <div class="col-sm-10">          
        <select class="form-control" placeholder="Enter Type" name="type">
			<option value="threat">Threat</option>
			<option value="patrol">Patrol</option>
			<option value="publicity">Publicity</option>
			<option value="other">Other</option>
		</select>
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
        <select class="form-control" name="location">
			<?php
				$query_locs = "SELECT * FROM location_data;";
				$listlocs = mysqli_query($connection, $query_locs);
					
				while($row1 = mysqli_fetch_assoc($listlocs)){
					$output = "{$row1['name']} at lat: {$row1['latitude']} and long: {$row1['longitude']}";
					${$output} = $row1['location_id'];
					echo "<option> $output </option>";
				}
			?>			
		</select>
      </div>
    </div>
	<a href="create_location.php">Create Location (if not in list)</a><br>
     
	 <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Date</label>
      <div class="col-sm-10">          
        <select class="form-control" name="date">
			<?php
				$query_dates = "SELECT * FROM date_data;";
				$listdates = mysqli_query($connection, $query_dates);
					
				while($row2 = mysqli_fetch_assoc($listdates)){
					$output = "{$row2['month']} {$row2['day']}, {$row2['year']}";
					${$output} = $row2['date_id'];
					echo "<option> $output </option>";
				}
			?>			
		</select>
      </div>
    </div>
	<a href="create_date.php">Create Date (if not in list)</a><br>
	
	<div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Time</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" placeholder="Enter Start Time" name="time">
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