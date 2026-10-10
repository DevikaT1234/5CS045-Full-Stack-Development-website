<?php
session_start();  				// Start session

$_SESSION = array();  			// clear session variables

session_destroy(); 				// Destroy session

header("Location: index.php");  // Redirect to the main page
exit();
?>