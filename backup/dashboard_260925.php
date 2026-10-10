<?php

session_start();

// Make sure the user is logged in
if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit;
}

?>

<!doctype html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MyGames - Dashboard</title>

    <link rel="stylesheet" href="index.css">

</head>


<body>


<!-- Top navigation -->

<div class="navbar_top">

    <h1>MyGames</h1>


    <div class="navbar_right">

        <div class="menu-dropdown">

            <img
                src="./icon_profile.png"
                id="accountmenu_button"
                alt="Account"
                onclick="showMenu()"
            >

        </div>

    </div>

</div>



<!-- Logged-in user -->

<div class="user_info">

    <p>
        Welcome,
        <?php echo htmlspecialchars($_SESSION['username']); ?>
    </p>

    <p>
        <a href="logout.php">Logout</a>
    </p>

</div>



<!-- Site navigation menu -->

<ul class="navbar_side" id="navbar_side_category">


    <li>
        <a
            href="#Dashboard"
            onclick="fetchItems('Dashboard')"
        >
            Dashboard
        </a>
    </li>


    <li>
        <a
            href="#Records"
            onclick="fetchItems('Records')"
        >
            Records
        </a>
    </li>


    <li>
        <a
            href="#AddRecord"
            onclick="fetchItems('AddRecord')"
        >
            Add Record
        </a>
    </li>


</ul>



<!-- Main content -->

<div
    class="main_games"
    id="games_container"
>


    <!-- MUST leave sections blank,
         they will be populated by AJAX call -->

    <section id="Dashboard">
    </section>


    <section id="Records">
    </section>


    <section id="AddRecord">
    </section>


</div>



<script>

// Your existing JavaScript functions can go here.
//
// For example:
//
// function fetchItems(section) {
//     ...
// }
//
// function showMenu() {
//     ...
// }

</script>


</body>

</html>