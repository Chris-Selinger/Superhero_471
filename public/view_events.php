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

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $searchValue = $_POST['searchingValue'];
        $query = "SELECT * FROM event_data LEFT JOIN user_data ON poster_id=user_id WHERE CONCAT('event_type`, 'description', 'location', 'date', 'name') LIKE '%".$searchValue."%'";
        $searchResult = searchTable($query);
    } else {
        $query = "SELECT * FROM event_data LEFT JOIN user_data ON poster_id=user_id";
        $searchResult = searchTable($query);
    }
    function searchTable($query) {
		$searchedResult = null;
		if (null!=mysqli_query($connection, $query))
        $searchedResult = mysqli_query($connection, $query);
        return $searchedResult;
    }
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
  <h2>Events</h2>

<form method = "post" action =   "<?php echo $_SERVER['PHP_SELF'];?>">
     <input type = "text" name = "searchingValue" placeholder="Search"> <br>
     <input type = "submit" name = "searchBtn" value = "Search"> <br>
 
  <table class="table table-bordered table table-hover">
    <thead>
      <tr>
        <th>Type</th>
        <th>Description</th>
        <th>Location</th>
		<th>Poster</th>
        <th>Date</th>
        <th>View</th>
      </tr>
    </thead>
    <tbody>
     <?php while(null != $searchResult and $row = mysqli_fetch_assoc($searchResult)): ?>
      <tr>
        <td><?php echo $row['type'] ?></td>
        <td><?php echo $row['description']?></td>
        <td><?php echo $row['location']?></td>
        <td><?php echo $row['date']?></td>
        <td><a class = "btn btn-primary" href="view_event.php?id_number=<?php echo $row['event_id'] ?>"> View</a></td>
      </tr>
    <?php endwhile;?>
    </tbody>
  </table>
   </form>
</div>

</body>
</html>