<?php
	session_start();
	
	if (!isset($_SESSION["user_type"])) {
		header("Location: ../index.php");
	}

	require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/dbinfo.php');
	
	$user = $_SESSION['user'];
	$sql = "SELECT * FROM user_data WHERE user_id = '$user'";
	$result = mysqli_query($connection, $sql);
    	$user_data = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html>
    <head>

        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" 
		integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <title>PublicUser - Dashboard</title>
    </head>

    <body>
        <section id="header">
            <div style="display: table; height: 100%; overflow: hidden; margin-left: 20px;">
                <div style="display: table-cell; vertical-align: middle;">
                    <div id="title">PublicUser Dashboard</div>
                    <div id="path">Home</div>
                </div>
            </div>
        </section>

        <div id="embedWrapper">
            <iframe src="home.html" id="contentEmbed" frameBorder="0">Browser not compatible.</iframe>
        </div>

        <section id="sideNav">
            <ul>
                <li>
                    <a href="#" class="active1" onclick="return openPage('./view_events.php');">View Events</a>
				</li>
                <li>
                    <a href="#" class="active1" onclick="return openPage('./add_event.php');"></i>Add Event</a>
				</li>
                <li>
                    <a href="#" class="active1" onclick="return openPage('./view_heroes.php');"></i>View Heroes</a>
				</li>
                    
                <li><a href="#" class="active1" onclick="return openPage('reviewer/all_pending_journals.php');">My Account</a></li>
                <li onclick=<?php session_destroy(); header("Refresh:0");?>
				style="cursor: pointer;"><a class="active1"> Logout</a></li>
            </ul>
        </section>
        
        <section id="sideBox">
            <img src="../css_and_imgs/silhouette-logo.png" alt="Logo" class="logo"; style="cursor: pointer;">
        </section>
    </body>
<script>
let embedFrame = document.getElementById("contentEmbed");

function openPage(url) {
    embedFrame.src = url;
    path.innerText = url.replace(/\//g, ' > ').replace(/_/g, ' ').replace(/\b[a-z]/g, function(l) { return l.toUpperCase(); }).replace(/.html/gi, '').replace(/.php/gi, '');
    return true;
}
</script>
</html>

