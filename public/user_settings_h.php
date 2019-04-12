<?php
	session_start();
	
	if (!isset($_SESSION["user"])) {
		header("Location: ../index.php");
	}
	
	require_once('../inc/dbinfo.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>


  <title>Account Settings</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	<form method = "post" action =   "<?php echo $_SERVER['PHP_SELF'];?>">
  <h2>My Locations</h2> 
  <table class="table table-bordered table table-hover">
    <thead>
      <tr>
	    <th>Name</th>
        <th>Coordinates</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>
     <?php 
		$loc_query = "SELECT * from userlocation_data AS ul LEFT JOIN location_data AS l ON ul.location_id=l.location_id "
				. " WHERE ul.user_id='{$_SESSION['user']}';";
		$locResult = mysqli_query($connection, $loc_query);
	 
	 while($row = mysqli_fetch_assoc($locResult)): ?>
      <tr>
		<td><?php echo $row['l_name'] ?> </td>
        <td><?php echo "lat: '{$row['latitude']}', long: '{$row['longitude']}'"; ?> </td>
        <td> <input type="checkbox" name="remove_locs[]" value="<?php echo $row['location_id'] ?>"> </td>
      </tr>
    <?php endwhile;?>
    </tbody>
  </table>
	<input type = "submit" name = "RemoveLocs" value = "Remove"></form>
	
<form method = "post" action =   "<?php echo $_SERVER['PHP_SELF'];?>">
     <div class="form-group">
      <div class="col-sm-10">          
        <select class="form-control" name="location_to_add">
			<?php
				$query_locs = "SELECT * FROM location_data;";
				$listlocs = mysqli_query($connection, $query_locs);
					
				while($row1 = mysqli_fetch_assoc($listlocs)){
					$output = "{$row1['l_name']} at lat: {$row1['latitude']} and long: {$row1['longitude']}";
					${$output} = $row1['location_id'];
					echo "<option> $output </option>";
				}
			?>			
		</select>
      </div>
    </div>
	<input type = "submit" name = "AddLocs" value = "Add"></form> <br>
	<a href="create_location.php">Create Location (if not in list)</a><br>
	

<form method = "post" action =   "<?php echo $_SERVER['PHP_SELF'];?>">
  <h2>My Powers</h2> 
  <table class="table table-bordered table table-hover">
    <thead>
      <tr>
	    <th>Power</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>
    <?php 
		$power_query = "SELECT * from power_data "
				. " WHERE hero_id='{$_SESSION['user']}';";
		$powerResult = mysqli_query($connection, $power_query);
	 
	 while($row = mysqli_fetch_assoc($powerResult)): ?>
      <tr>
		<td><?php echo $row['power'] ?> </td>
        <td> <input type="checkbox" name="remove_pows[]" value="<?php echo $row['power'] ?>"> </td>
      </tr>
    <?php endwhile;?>
    </tbody>
  </table>
	<input type = "submit" name = "RemovePowers" value = "Remove"></form>
	
<form method = "post" action =   "<?php echo $_SERVER['PHP_SELF'];?>">
     <div class="form-group">
      <div class="col-sm-10">          
        <input type = "text" name = "power_to_add" placeholder = "type Power to add">
      </div>
    </div>
	<input type = "submit" name = "AddPower" value = "Add"></form> <br>

	
   <a href="index.php"> Return to Menu </a>    
</div>

</body>
</html>
   

<?php


    if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if(isset($_POST['RemoveLocs'])){
		if(!empty($_POST['remove_locs'])){
			foreach($_POST['remove_locs'] as $loc_id){
				$del_loc_query = "DELETE FROM userlocation_data WHERE user_id='{$_SESSION['user']}' AND location_id='$loc_id';";
				mysqli_query($connection, $del_loc_query);
			}
			header("Refresh:0");
		}
    }
	if(isset($_POST['AddLocs'])){
		$location = filter_var($_POST['location_to_add'], FILTER_SANITIZE_STRING);
		$location_id = ${$location};
		$add_loc_query = "INSERT INTO userlocation_data (user_id, location_id) VALUES ('{$_SESSION['user']}', '$location_id');";
		mysqli_query($connection, $add_loc_query);
		header("Refresh:0");
    }
	}
	if(isset($_POST['RemovePowers'])){
		if(!empty($_POST['remove_pows'])){
			foreach($_POST['remove_pows'] as $pow_id){
				$del_pow_query = "DELETE FROM power_data WHERE hero_id='{$_SESSION['user']}' AND power='$pow_id';";
				mysqli_query($connection, $del_pow_query);
			}
			header("Refresh:0");
		}
    }
	if(isset($_POST['AddPower'])){
		$power = filter_var($_POST['power_to_add'], FILTER_SANITIZE_STRING);
		$add_pow_query = "INSERT INTO power_data (hero_id, power) VALUES ('{$_SESSION['user']}', '$power');";
		mysqli_query($connection, $add_pow_query);
		header("Refresh:0");
    }
	

?>