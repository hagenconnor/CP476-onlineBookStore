<?php
include("db.php");

//start the session
session_start();

if ( !isset($_POST['username'], $_POST['password']) ) {
	
	exit('Username and password is required!');
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

			// Create a session
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $_POST['username'];
			$_SESSION['id'] = $id;

			//Redirect to homepage
			header('Location: ../online_store.php');

		} else {
			// password is incorrect
		echo ("<script LANGUAGE='JavaScript'> window.alert('Password is incorrect.');window.location.href='login.html';</script>");

		}
	} else {
		// username is incorrect
		echo ("<script LANGUAGE='JavaScript'> window.alert('Username is incorrect or user does not exist.');window.location.href='login.html';</script>");

	}
	$stmt->close();
}
$conn->close();

?> 