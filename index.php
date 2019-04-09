<?php 
session_start();

if (isset($_SESSION["user_type"])){
	
    header("Location: ./super471_login.php");
} else {
    header("Location: ./super471_login.php");
}

die(); ?>
