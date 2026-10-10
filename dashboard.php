<?php

session_start();

// Make sure the user is logged in
if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit;
}


// Connect to the database
require_once "db.php";

$records = [];

$result = $mysqli->query(
    "SELECT id, title, genre, release_year FROM games"
);

if ($result) {

    while ($row = $result->fetch_assoc()) {

        $records[] = $row;

    }

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


// Display the selected section

function fetchItems(section) {


    // Dashboard

    if (section === "Dashboard") {

        const dashboardSection =
            document.getElementById("Dashboard");

        dashboardSection.innerHTML =
            "<h2>Welcome to MyGames</h2>" +
            "<p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>" +
            "<p>Use the menu on the left to view your game records or add a new record.</p>";

    }


    // Records

    if (section === "Records") {

        const recordsSection =
            document.getElementById("Records");

        let html = "<h2>Records</h2>";

        html += "<table class='records-table'>";


        // Table headings

        html += "<tr>";

        html += "<th>ID</th>";

        html += "<th>Title</th>";

        html += "<th>Genre</th>";

        html += "<th>Release Year</th>";

        html += "</tr>";


        // Database records

        <?php foreach ($records as $record): ?>

            html += "<tr>";

            html +=
                "<td><?php echo htmlspecialchars($record['id']); ?></td>";

            html +=
                "<td><?php echo htmlspecialchars($record['title']); ?></td>";

            html +=
                "<td><?php echo htmlspecialchars($record['genre']); ?></td>";

            html +=
                "<td><?php echo htmlspecialchars($record['release_year']); ?></td>";

            html += "</tr>";

        <?php endforeach; ?>


        html += "</table>";


        recordsSection.innerHTML = html;

    }


    // Add Record

    if (section === "AddRecord") {

        const addRecordSection =
            document.getElementById("AddRecord");

        addRecordSection.innerHTML =
            "<h2>Add Record</h2>" +
            "<p>The Add Record section will be added here.</p>";

    }

}

</script>


</body>

</html>