<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'dissertation';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}





//login
// Now we check if the data from the login form was submitted, isset() will check if the data exists.



// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, userName FROM newregister WHERE userName = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['user']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	echo 'username exists';
} else {
	// new user
	$stmt = $con->prepare('INSERT INTO newregister (firstName, lastName, userName, password) VALUES  (?, ?, ?, ?)');
	
	$stmt->bind_param('ssss', $_POST['firstname'], $_POST['lastname'], $_POST['user'], $_POST['pass']);
	echo 'registration successful';
	// Redirecting user back to login page
	header ("Location: http://localhost/index.html");
	$stmt->execute();
}


	$stmt->close();
}





?>