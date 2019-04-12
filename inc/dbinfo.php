<?php

    $dbserver = "super471-rds-db.cvfq7dezlrgc.ca-central-1.rds.amazonaws.com";
    $dbusername = "super471Master";
    $dbpassword = "super471";
    $database = "super471_schema";
	
	$connection = mysqli_connect($dbserver, $dbusername, $dbpassword, $database);

?>
