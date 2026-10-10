<?php
ini_set('display_errors', 0);
//error_reporting(E_ALL);
//error_log($error, 3, "/var/log/php_errors.log");

session_start();


include("db.php");
$error = "";

// --- Handle form submission ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']); 

    $password = trim($_POST['password']);

	

    // --- Prepare SQL statement ---
    $stmt = $mysqli->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");
    if (!$stmt) { 
        die("Prepare failed: " . $mysqli->error); 
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $username_db, $password_db);
        $stmt->fetch();

        // --- Verify password ---
        if (password_verify($password, $password_db)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username_db;
//			$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            header("Location: games.php");
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No account found with that username.";
    }

    $stmt->close();
}

$mysqli->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<?php if ($error): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p><a href="login_register.php">Register New Account</a></p> 
<p><a href="login_resetpassword.php">Reset Password</a></p> 

</body>
</html>