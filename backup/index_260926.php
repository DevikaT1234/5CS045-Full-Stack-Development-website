<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit;

}

$username = $_SESSION["username"];

?>

<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>MyGames</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            margin: 0;
            padding: 0;
        }

        .top-bar {
            height: 100px;
            background-color: #a9d9e8;
            border: 1px solid #e0c36e;
            position: relative;
        }

        .site-title {
            color: white;
            font-size: 30px;
            font-weight: bold;
            margin-left: 5px;
        }

        .profile-icon {
            position: absolute;
            right: 15px;
            top: 48px;
            font-size: 30px;
            text-decoration: none;
        }

        .side-menu {
            margin-top: 20px;
            margin-left: 5px;
        }

        .side-menu a {
            display: block;
            width: 135px;
            margin-bottom: 10px;
        }

        .dashboard {
            margin-left: 160px;
            margin-top: -120px;
        }

    </style>

</head>

<body>

    <!-- Top header -->

    <div class="top-bar">

        <div class="site-title">
            MyGames
        </div>

        <!-- Profile icon -->

        <a
            href="logout.php"
            class="profile-icon"
            title="Logout"
        >
            👤
        </a>

    </div>


    <!-- Side menu -->

    <div class="side-menu">

        <a
            href="#Dashboard"
            class="btn btn-outline-primary"
        >
            Dashboard
        </a>

        <a
            href="#Records"
            class="btn btn-outline-primary"
        >
            Records
        </a>

        <a
            href="#AddRecord"
            class="btn btn-outline-primary"
        >
            Add Record
        </a>

    </div>


    <!-- Dashboard -->

    <div
        id="Dashboard"
        class="dashboard"
    >

        <h2>Dashboard</h2>

        <p>
            Welcome,
            <?php echo htmlspecialchars($username); ?>!
        </p>

        <p>
            You are successfully logged in.
        </p>

    </div>


    <!-- Records -->

    <div
        id="Records"
        class="dashboard"
        style="display:none;"
    >

        <h2>Records</h2>

    </div>


    <!-- Add Record -->

    <div
        id="AddRecord"
        class="dashboard"
        style="display:none;"
    >

        <h2>Add Record</h2>

    </div>


</body>

</html>