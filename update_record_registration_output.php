<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>

<head>
	<title>Update a record</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="CSS/index.css">
	<link rel="stylesheet" href="CSS/navbar.css">
	<link rel="stylesheet" href="CSS/projectreport.css">
	<link rel="stylesheet" href="CSS/report.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
	<h1 style="text-align: center;">Welcome to the Future Foods website</h1>
	</div>
	<div class="navigationbar">
		<a href="index.html">Home</a>
		<a class="active" href="menu.html">Menu</a>
		<div class="dropdown">
			<button class="dropbtn">Project Report
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-content">
				<a href="projectreport.html">Project Description</a>
				<a href="entities_attributes.html">Entities and Attributes</a>
				<a href="ER_EERmodel.html">ER and EER model</a>
				<a href="physicaldesign_steps.html">Physical Design and Steps</a>
				<a href="normalizedtables_websiteskeleton.html">Normalized Tables and Website Skeleton</a>
				<a href="groupcontributions.html">Group Member Contributions</a>
				<a href="summary_conclusion.html">Summary of Experience and Conclusion</a>
			</div>
		</div>
		<a href="restaurant.html">Restaurant</a>
		<a href="contact.html">Contact Us</a>
		<div class="login-container">
			<a href="register.php">Register</a>
			<a href="login.php">Login</a>
		</div>
	</div>
	<?php
	session_start();

	include "connection.php";

	$_SESSION["session_flag"] = 'valid';
	if (isset($_SESSION["session_flag"])) {
		if ($_SESSION["session_flag"] == "valid") {

			$conn = new mysqli($servername, $server_username, $server_password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("ERROR: Could not connect. " . $conn->connect_error);
			}
			echo "Connected successfully" . "<br>";

			if (isset($_POST)) {
				// Escape user inputs for security
				$ID = $_POST['UserID'];
				$Email = $_POST['Email'];
				$PhoneNumber = $_POST['PhoneNumber'];
				$first_name = $_POST['FirstName'];
				$last_name = $_POST['LastName'];
				$PostalCode = $_POST['PostalCode'];
			}


			// attempt insert query execution
			$sql = "UPDATE Customer SET Email='$email', PhoneNumber = '$PhoneNumber', FirstName = '$FirstName', LastName='$last_name', PostalCode = '$PostalCode' WHERE UserID='$ID'";

			$query = $conn->query($sql);

			if (!$query) {
				die('ERROR: ' . $conn->error);
			} else {
				echo "Record updated successfully. <br>";
			}

			$sql = 'SELECT UserID, Email, PhoneNumber, FirstName, LastName, PostalCode FROM Customer WHERE UserID = ' . $ID;

			// attempt insert query execution
			$result = $conn->query($sql);
			if (!$result) {
				echo "Could not get data: " . $conn->error;
			}

			while ($row = $result->fetch_assoc()) {
				echo "ID: {$row['UserID']}  <br> " .
					"Email: {$row['Email']}  <br> " .
					"PhoneNumber: {$row['PhoneNumber']}  <br> " .
					"First Name: {$row['FirstName']} <br> " .
					"Last Name: {$row['LastName']} <br> " .
					"PostalCode: {$row['PostalCode']}  <br> " .
					"--------------------------------<br>";
			}

			$conn->close();

			echo "<a href=\"login_check.php\"> Click here </a> to go to main menu.";
		} else {
			echo "Invalid session!";
		}
	} else {
		echo "Session not set!";
		echo "<a href=\"login.html\">Click here </a> to go back to the main page.";
	}
	?>

</body>

<footer>
	<br />
	&copy; 2020 Future Foods. | &copy; All Rights Reserved.
	<hr>
</footer>

</html>