<?php
include("db.php");

// check if data was submitted
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	
	echo ("<script LANGUAGE='JavaScript'> window.alert('All fields are required!');window.location.href='registration.html';</script>");

}else if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	
	echo ("<script LANGUAGE='JavaScript'> window.alert('All fields are required!');window.location.href='registration.html';</script>");

}else if (! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){// Validate email address.

	echo ("<script LANGUAGE='JavaScript'> window.alert('Email address is not valid!');window.location.href='registration.html';</script>");

}else if ($stmt = $conn->prepare('SELECT user_id, password FROM users WHERE username = ?')) {// Check if the account exists.

	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) { // Account with that user name already exists
		
		echo ("<script LANGUAGE='JavaScript'> window.alert('Username already exists, try again.');window.location.href='registration.html';</script>");
	
	} else { // Create new account
		
		if ($stmt = $conn->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)')) {
			
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
			$stmt->execute();
			
			echo ("<script LANGUAGE='JavaScript'> window.alert('Account created successfully.');window.location.href='login.html';</script>");
		} else {
			echo ("<script LANGUAGE='JavaScript'> window.alert('Unable to create account. Please try again later.');window.location.href='registration.html';</script>");	
		}
	}
	$stmt->close();
} else {
	
	echo ("<script LANGUAGE='JavaScript'> window.alert('Unable to create account please try again later.');window.location.href='registration.html';</script>");
}
$conn->close();

?>
