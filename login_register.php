<?php
session_start(); 
include("db.php");

$form_status = "";
    	
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
      
    $username = trim($_POST['username'] ?? "");	  
	$email = trim($_POST['email']);
    $password = password_hash($_POST['password'] ?? "", PASSWORD_DEFAULT);
	
    // Check if username or email already exists
	// Prepare SQL statement (prevents SQL injection)
	$usernameStmt = $mysqli->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
	if (!$usernameStmt) {
		die("Prepare for registering user failed: " . $mysqli->error);
	}

	// Bind parameters: s = string, i = integer, d = double
	$usernameStmt->bind_param("ss", $username, $email);
 	$usernameStmt->execute();
    $usernameStmt->store_result();

    if ($usernameStmt->num_rows > 0) {
        $form_status = "Username or email already exists";
    } else {
		
        // Prepare Insert statement
        $stmt = $mysqli->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
		if (!$stmt) {
			die("Prepare for registering user failed: " . $mysqli->error);
		}
        $stmt->bind_param("sss", $username, $email, $password);
		
		// Execute statement
		if ($stmt->execute()) {
			$new_user_id = $stmt ->insert_id; 
			
			session_start(); 
			$_SESSION['user_id'] = $new_user_id;
			$_SESSION['username'] = $username;
			
			$form_status = "New Account registered. Username: " . $username; //$stmt->insert_id;
			header("Location: index.php");
			exit;
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
		
		<label>Email:</label><br>
		<input type="email" name="email" id="email" class="form-control" required><br><br>

		<label>Password:</label><br>
		<input type="password" name="password" id="password" class="form-control" required><br><br>

		<button type="submit" style="font-weight: 600;">Create Account</button>
	</form>

	<p><a href="login.php">Return to Login page</a></p>

</body>
</html>