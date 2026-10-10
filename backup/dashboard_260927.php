<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>MyGames Dashboard</title>

</head>

<body>

    <h1>MyGames</h1>

    <h2>Dashboard</h2>

    <p>Dashboard page loaded successfully.</p>

    <?php

    if (isset($_SESSION['user_id'])) {

        echo "<p>User ID: " .
             htmlspecialchars($_SESSION['user_id']) .
             "</p>";

    } else {

        echo "<p>No user session found.</p>";

    }

    ?>

</body>

</html>