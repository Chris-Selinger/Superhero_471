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
      <label class="control-label col-sm-2" for="pwd">Day</label>
      <div class="col-sm-10">          
        <input type="number" class="form-control" min="1" step="1" max="31" name="day">
      </div>
    </div>
   
   <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Month</label>
      <div class="col-sm-10">          
        <select class="form-control" name="month">
			<option value="january">January</option>
			<option value="february">February</option>
			<option value="march">March</option>
			<option value="april">April</option>
			<option value="may">May</option>
			<option value="june">June</option>
			<option value="july">July</option>
			<option value="august">August</option>
			<option value="september">September</option>
			<option value="october">October</option>
			<option value="november">November</option>
			<option value="december">December</option>
		</select>
      </div>
    </div>
   
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Year</label>
      <div class="col-sm-10">          
        <input type="number" class="form-control" min="2019" step="1" max="2050" name="year">
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

		$day = filter_var(trim($_POST['day']), FILTER_SANITIZE_NUMBER_INT);
		$month = filter_var($_POST['month'], FILTER_SANITIZE_STRING);
		$year = filter_var(trim($_POST['year']), FILTER_SANITIZE_NUMBER_INT);
		
        $query = "SELECT * FROM date_data WHERE day='$day' AND month='$month' AND year='$year';";
        $result = mysqli_query($connection, $query);
		if (null == $result){
			$date_id = guidv4(openssl_random_pseudo_bytes(16));
			$query = "INSERT INTO date_data (date_id, day, month, year) VALUES ('$date_id', '$day', '$month', '$year');";
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