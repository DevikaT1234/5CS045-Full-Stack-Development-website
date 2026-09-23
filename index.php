<!doctype html>
<html lang="en">
<head>
	<title>Games</title>
	<link rel="stylesheet" href="index.css">

</head>

<body>
  
<div class = "navbar_top">

	<h1>MyGames</h1>

	<div class = "navbar_right">
<!--		<img src="./assets/images/icon_search.png" alt="Search">  -->
			
		<div class="menu-dropdown">
			<img src="./icon_profile.png" id="accountmenu_button" alt="Account" onclick="showMenu()">
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