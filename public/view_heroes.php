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
	
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $searchValue = $_POST['searchingValue'];
        $searchquery = "SELECT * " 
					. " FROM user_data ";
					//. " WHERE is_hero=1 AND CONCAT('event_type`, 'description', 'location', 'date', 'name') LIKE '%".$searchValue."%'";
        $searchResult = mysqli_query($connection, $searchquery);
    } else {
        $searchquery = "SELECT * " 
					. " FROM user_data"
					. " WHERE is_hero=1";
        $searchResult = mysqli_query($connection, $searchquery);
    }
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Heroes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Heroes</h2>

<form method = "post" action =   "<?php echo $_SERVER['PHP_SELF'];?>">
     <input type = "text" name = "searchingValue" placeholder="Search">
     <input type = "submit" name = "searchBtn" value = "Search"> <br>
 
  <table class="table table-bordered table table-hover">
    <thead>
      <tr>
	    <th>Name</th>
        <th>Powers</th>
        <th>Costumes</th>
        <th>Sidekick</th>
		<th>Fan Page</th>
      </tr>
    </thead>
    <tbody>
     <?php while(null != $searchResult and $row = mysqli_fetch_assoc($searchResult)): ?>
      <tr>
		<td><a href="view_event.php?id_number=<?php echo $row['user_id'] ?>"><?php echo $row['u_name'] ?></a></td>
        <td><?php echo "has powers"; ?> </td>
        <td><?php echo "has costumes"; ?> </td>
        <td><?php echo "has a sidekick"; ?> </td>
		<td><?php echo $row['u_name']; ?> </td>
      </tr>
    <?php endwhile;?>
    </tbody>
  </table>
   </form>
   <a href="index.php"> Return to Menu </a>    
</div>


</body>
</html>