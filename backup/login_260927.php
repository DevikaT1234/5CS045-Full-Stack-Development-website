<?php

session_start();

require_once "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {

        $error = "Please enter your username and password.";

    } else {

        $stmt = $mysqli->prepare(
            "SELECT user_id, username, password_hash
             FROM users
             WHERE username = ?"
        );

        if (!$stmt) {
            die("Database query failed: " . $mysqli->error);
        }

        $stmt->bind_param("s", $username);

        if (!$stmt->execute()) {
            die("Query failed: " . $stmt->error);
        }

        $stmt->store_result();

        if ($stmt->num_rows === 1) {

            $stmt->bind_result(
                $user_id,
                $username_db,
                $password_hash
            );

            $stmt->fetch();

            if (password_verify($password, $password_hash)) {

                // Login successful
                session_regenerate_id(true);

                $_SESSION["user_id"] = $user_id;
                $_SESSION["username"] = $username_db;

                // Go to your Dashboard
                header("Location: Dashboard.php#Dashboard");
                exit;

            } else {

                $error = "Incorrect password.";
            }

        } else {

            $error = "No account found with that username.";
        }

        $stmt->close();
    }
}

$mysqli->close();

?>

<!doctype html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Login - MyGames</title>

</head>

<body>

    <h2>Login</h2>

    <?php if ($error !== ""): ?>

        <p style="color: red;">
            <?php echo htmlspecialchars($error); ?>
        </p>

    <?php endif; ?>


    <form method="POST" action="login.php">

        <label for="username">
            Username:
        </label>

        <br>

        <input
            type="text"
            id="username"
            name="username"
            required
        >

        <br><br>


        <label for="password">
            Password:
        </label>

        <br>

        <input
            type="password"
            id="password"
            name="password"
            required
        >

        <br><br>


        <button type="submit">
            Login
        </button>

    </form>


    <p>
        <a href="login_register.php">
            Register New Account
        </a>
    </p>

    <p>
        <a href="login_resetpassword.php">
            Reset Password
        </a>
    </p>

</body>

</html>