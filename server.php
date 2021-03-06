<?php 
	if (!isset($_SESSION)) {
		session_start(); 
	}
	
	include "connection.php";
	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";
	$_SESSION['permissions'] = "";

	// connect to database
	$conn = new mysqli($servername, $server_username, $server_password, $dbname);
	
	// Check connection
	if ($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
		
	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username	= mysqli_real_escape_string($conn, $_POST['username']);
		$email		= mysqli_real_escape_string($conn, $_POST['email']);
		$password_1	= mysqli_real_escape_string($conn, $_POST['password_1']);
		$password_2	= mysqli_real_escape_string($conn, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// check if username exists
		$query = "SELECT * FROM users WHERE username='$username'";
		$results = $conn->query($query);
		
		if($results->num_rows !=  0){
			array_push($errors, "This username already exists");
		}
			
			
		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database


			$query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";

			if($conn->query($query) === TRUE){
				echo "You are registered successfully<br>";
			}else{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";

		
			header('location: index.php');

		}
	}

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = $conn->query($query);

			if($results->num_rows ==  1){
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
	$conn->close();
