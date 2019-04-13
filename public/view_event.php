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

$event = $_GET['id_number'];
$userID = $user_data['user_id'];


    $searchValue = $_POST['searchingValue'];
    $searchquery1 = "SELECT * "
      . "FROM event_data AS e LEFT JOIN user_data AS u ON e.poster_id=u.user_id "
      . " LEFT JOIN location_data AS l ON e.location_id=l.location_id "
      . " LEFT JOIN date_data AS d ON e.date_id=d.date_id"
      . " WHERE event_id = '" .$event. "' ";
    $searchResult1 = mysqli_query($connection, $searchquery1);


    $searchValue = $_POST['searchingValue'];
    $searchquery2 = "SELECT responder_id "
      . " FROM respondsto_data"
      . " WHERE event_id = '" .$event. "' ";
    $searchResult2 = mysqli_query($connection, $searchquery2);

    $searchValue = $_POST['searchingValue'];
    $searchquery3 = "SELECT * "
      . "FROM event_data"
      . "WHERE event_id = '" .$event. "' ";
    $searchResult3 = mysqli_query($connection, $searchquery3)



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
  <h2>Event Details</h2>


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
     <?php if(null != $searchResult1 and $row = mysqli_fetch_array($searchResult1) and $row['event_id'] = $event) ?>
      <tr>
		    <td><?php echo $row['e_name']  ?></a></td>
        <td><?php echo $row['type'] ?></td>
        <td><?php echo $row['description']?></td>
        <td><?php echo "{$row['l_name']} at lat: {$row['latitude']} and long: {$row['longitude']}"?></td>
        <td><?php echo "{$row['month']} {$row['day']}, {$row['year']}"?></td>
		    <td><?php echo $row['u_name']?></td>
      </tr>
  </table>
  <tr>
    <th>Responding Heroes</th>
    <br>
        <?php $row = mysqli_fetch_array($searchResult2); ?>
        <td><?php echo $row['responder_id'] ?></td>
      </tr>
    </tbody>
   </form>
   <br>
   <form method = "post" action =   "view_event.php?id_number=<?php echo $event ?>">
        <input type = "submit" name = "respondBtn" value = "Respond"> <br>
<?php
if (isset($_POST['respondBtn'])){
      $sql = "INSERT INTO respondsto_data (responder_id, event_id) "
        . "VALUES ( '$userID', '$event')";
      if (mysqli_query($connection, $sql)) {
        echo "You are now responding";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
      }
}

?>

   <a href="index.php"> Return to Menu </a>
</div>

</body>
</html>
