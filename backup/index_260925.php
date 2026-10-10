<?php

ini_set('display_errors', 0);

session_start();

include("db.php");

$error = "";

// If the user is already logged in, go straight to the dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Basic validation
    if ($username === '' || $password === '') {

        $error = "Please enter your username and password.";

    } else {

        // Prepare SQL statement
        $stmt = $mysqli->prepare(
            "SELECT user_id, username, password_hash
             FROM users
             WHERE username = ?"
        );

        if (!$stmt) {

            $error = "Unable to process login.";

        } else {

            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 1) {

                $stmt->bind_result(
                    $id,
                    $username_db,
                    $password_db
                );

                $stmt->fetch();

                // Verify password
                if (password_verify($password, $password_db)) {

                    // Prevent session fixation
                    session_regenerate_id(true);

                    // Store user information in session
                    $_SESSION['user_id'] = $id;
                    $_SESSION['username'] = $username_db;

                    // Login successful
                    header("Location: dashboard.php");
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
}

$mysqli->close();

?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - MyGames</title>

    <link rel="stylesheet" href="index.css">

</head>

<body>

    <h1>MyGames</h1>

    <h2>Login</h2>

    <?php if ($error): ?>

        <p style="color:red;">
            <?php echo htmlspecialchars($error); ?>
        </p>

    <?php endif; ?>


    <form method="POST" action="">

        <label for="username">Username:</label>
        <br>

        <input
            type="text"
            id="username"
            name="username"
            required
            autocomplete="username"
        >

        <br><br>


        <label for="password">Password:</label>
        <br>

        <input
            type="password"
            id="password"
            name="password"
            required
            autocomplete="current-password"
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