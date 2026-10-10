<?php
include("db.php");

$form_status = "";
    	
if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
	$email = trim($_POST['email']);

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    // Check if username already exists
	// Prepare SQL statement (prevents SQL injection)
	$usernameStmt = $mysqli->prepare("SELECT id, password, created_at FROM users WHERE email = ?");
	if (!$usernameStmt) {
		die("Prepare for registering user failed: " . $mysqli->error);
	}

	// Bind parameters: s = string, i = integer, d = double
	$usernameStmt->bind_param("s", $username);
 	$usernameStmt->execute();
    $usernameStmt->store_result();

    if ($usernameStmt->num_rows > 0) {
        $form_status = "Username already exists";
    } else {
		
        // Prepare Insert statement
        $stmt = $mysqli->prepare("INSERT INTO Users (username, password_hash) VALUES ( ?, ?)");
		if (!$stmt) {
			die("Prepare for registering user failed: " . $mysqli->error);
		}
        $stmt->bind_param("ss", $username, $password);
		
		// Execute statement
		if ($stmt->execute()) {
			$form_status = "New Account registered. Username: " . $username; //$stmt->insert_id;
		} else {
			$form_status = "Error, Could not register user: " . $stmt->error;
		}

        $stmt->close();
    } 	
	$usernameStmt->close();
    $mysqli->close();
} else {
	//echo $_SERVER["REQUEST_METHOD"];
}

echo htmlspecialchars($form_status);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>

<h2>New Account Registration</h2>

	<form method="POST">

		<label>Username:</label><br>
        <input type="text" name="username" id="username" class="form-control" required><br><br>

		<label>Password:</label><br>
		<input type="password" name="password" id="password" class="form-control" required><br><br>

		<button type="submit" style="font-weight: 600;">Create Account</button>
	</form>

	<p><a href="login.php">Return to Login page</a></p>

</body>
</html>