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
	
        
        $searchValue = $_POST['searchingValue'];
        $searchquery1 = "SELECT * " 
					. "FROM event_data AS e LEFT JOIN user_data AS u ON e.poster_id=u.user_id "
					. " LEFT JOIN location_data AS l ON e.location_id=l.location_id "
					. " LEFT JOIN date_data AS d ON e.date_id=d.date_id"
					. " WHERE e.poster_id= '{$_SESSION['user']}'";
        $searchResult1 = mysqli_query($connection, $searchquery1);

        $searchValue = $_POST['searchingValue'];
        $searchquery2 = "SELECT * " 
					. "FROM respondsto_data AS r LEFT JOIN event_data AS e ON r.event_id=e.event_id"
					. " LEFT JOIN user_data AS u ON e.poster_id=u.user_id "
					. " LEFT JOIN location_data AS l ON e.location_id=l.location_id "
					. " LEFT JOIN date_data AS d ON e.date_id=d.date_id"
					. " WHERE r.responder_id= '{$_SESSION['user']}'";
        $searchResult2 = mysqli_query($connection, $searchquery2);
		
		$searchValue = $_POST['searchingValue'];
        $searchquery3 = "SELECT * " 
					. "FROM event_data AS e LEFT JOIN user_data AS u ON e.poster_id=u.user_id "
					. " LEFT JOIN location_data AS l ON e.location_id=l.location_id "
					. " LEFT JOIN date_data AS d ON e.date_id=d.date_id"
					. " WHERE EXISTS(SELECT * FROM userlocation_data AS ul WHERE e.location_id=ul.location_id "
					. " AND ul.user_id='{$_SESSION['user']}')";
        $searchResult3 = mysqli_query($connection, $searchquery3);

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Events</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Events I've posted</h2>

  <table class="table table-bordered table table-hover">
    <thead>
      <tr>
	    <th>Name</th>
        <th>Type</th>
        <th>Description</th>
        <th>Location</th>
        <th>Date</th>
		<th>Posted By</th>
      </tr>
    </thead>
    <tbody>
     <?php while(null != $searchResult1 and $row = mysqli_fetch_assoc($searchResult1)): ?>
      <tr>
		<td><a href="view_event.php?id_number=<?php echo $row['event_id'] ?>"><?php echo $row['e_name'] ?></a></td>
        <td><?php echo $row['type'] ?></td>
        <td><?php echo $row['description']?></td>
        <td><?php echo "{$row['l_name']} at lat: {$row['latitude']} and long: {$row['longitude']}"?></td>
        <td><?php echo "{$row['month']} {$row['day']}, {$row['year']}"?></td>
		<td><?php echo $row['u_name']?></td>
      </tr>
    <?php endwhile;?>
    </tbody>
  </table>
  
  <h2>Events I'm responding to</h2>

  <table class="table table-bordered table table-hover">
    <thead>
      <tr>
	    <th>Name</th>
        <th>Type</th>
        <th>Description</th>
        <th>Location</th>
        <th>Date</th>
		<th>Posted By</th>
      </tr>
    </thead>
    <tbody>
     <?php while(null != $searchResult2 and $row = mysqli_fetch_assoc($searchResult2)): ?>
      <tr>
		<td><a href="view_event.php?id_number=<?php echo $row['event_id'] ?>"><?php echo $row['e_name'] ?></a></td>
        <td><?php echo $row['type'] ?></td>
        <td><?php echo $row['description']?></td>
        <td><?php echo "{$row['l_name']} at lat: {$row['latitude']} and long: {$row['longitude']}"?></td>
        <td><?php echo "{$row['month']} {$row['day']}, {$row['year']}"?></td>
		<td><?php echo $row['u_name']?></td>
      </tr>
    <?php endwhile;?>
    </tbody>
  </table>
  
  <h2>Events in my locations</h2>

  <table class="table table-bordered table table-hover">
    <thead>
      <tr>
	    <th>Name</th>
        <th>Type</th>
        <th>Description</th>
        <th>Location</th>
        <th>Date</th>
		<th>Posted By</th>
      </tr>
    </thead>
    <tbody>
     <?php while(null != $searchResult3 and $row = mysqli_fetch_assoc($searchResult3)): ?>
      <tr>
		<td><a href="view_event.php?id_number=<?php echo $row['event_id'] ?>"><?php echo $row['e_name'] ?></a></td>
        <td><?php echo $row['type'] ?></td>
        <td><?php echo $row['description']?></td>
        <td><?php echo "{$row['l_name']} at lat: {$row['latitude']} and long: {$row['longitude']}"?></td>
        <td><?php echo "{$row['month']} {$row['day']}, {$row['year']}"?></td>
		<td><?php echo $row['u_name']?></td>
      </tr>
    <?php endwhile;?>
    </tbody>
  </table>

   <a href="index.php"> Return to Menu </a>    
</div>


</body>
</html>