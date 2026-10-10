<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//echo $_SESSION['user_id'] ?? 'Not set';

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

?>

<!doctype html>
<html lang="en">
<head>
	<title>Games</title>
	<link rel="stylesheet" href="index.css">

</head>

<body>
  
<div class = "navbar_top">

	<h1>MyGames</h1>
	<h1>Welcome <?php echo $_SESSION["username"] ?></h1>
		

	<div class = "navbar_right">
<!--		<img src="./assets/images/icon_search.png" alt="Search">  -->
			
		<div class="menu-dropdown">
			<a href="login.php" aria-label = "Log in">
			<img src="./icon_profile.png" id="login_button" alt="Account">
			<a href="login_logout.php" aria-label = "Log Out">
			<img src="./icon_logout.jpg" id="logout_button" alt="Logout">
<!--		<button type="button" onclick="showMenu()">Login</button> -->
		</div>
	</div>
</div>


<!-- Site navigation menu -->
<ul class="navbar_side" id="navbar_side_category">

  <li> <a href="#Dashboard" onclick="fetchMenuItems('Dashboard')">Dashboard</a>
  <li> <a href="#Records" onclick="fetchMenuItems('Records')">Records</a>
  <li> <a href="#AddRecord" onclick="fetchMenuItems('AddRecord')">Add Record</a>
  
</ul>

<!-- Main content -->

<div class="menu_items" id="items_container"> 

	<!-- MUST leave sections blank, will be populated by Ajax call -->

	<section id="Dashboard">
	</section>
	<section id="Records">
	</section>
	<section id="AddRecord">
	</section>
	
</div>

</body>
</html>

<script>
</script>