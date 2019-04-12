<?php 
session_start();
require_once('./inc/dbinfo.php');

if (isset($_SESSION["user_type"])){
	
	if ($_SESSION["user_type"] == "public"){
		header("Location: ./public");
	}else{
		header("Location: ./admin");
	}
} else {
    header("Location: ./super471_login.php");
}
	
?>

