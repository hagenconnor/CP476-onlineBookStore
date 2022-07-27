<?php

//start the session
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = new mysqli("localhost", "root", "password", "online_bookstore");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");
} catch(Exception $e) {
    error_log($e->getMessage());
    exit('Error connecting to database'); 
}

if ( !isset($_POST['username'], $_POST['password']) ) {
	
	exit('Both username and password fields are required!');
}

if ($stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username = ?")) {
	
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$stmt->bind_result($id, $password);
		$stmt->fetch();
		
		// verify the password.
		if (password_verify($_POST['password'], $password)) {

			// Create a session so we know the user is logged in
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $_POST['username'];
			$_SESSION['id'] = $id;

			//Redirect to homepage
			header('Location: ../online_store.php');

		} else {
			// password is incorrect
		echo ("<script LANGUAGE='JavaScript'> window.alert('Password is incorrect.');window.location.href='log_in.php';</script>");

		}
	} else {
		// username is incorrect
		echo ("<script LANGUAGE='JavaScript'> window.alert('Username is incorrect or user does not exist.');window.location.href='log_in.php';</script>");

	}
	$stmt->close();
}
$conn->close();

?> 