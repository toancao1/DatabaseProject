<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>

<head>
	<title>Menu</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="CSS/navbar.css">
	<link rel="stylesheet" href="CSS/index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="CSS/projectreport.css">
	<link rel="stylesheet" href="CSS/report.css">
	<script src="JavaScript/projectreport.js"></script>
</head>

<body>
	<h1 style="text-align: center;">Welcome to the Future Foods website</h1>
	</div>
	<div class="navigationbar">
		<a href="index.html">Home</a>
		<a href="menu.html">Menu</a>
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
		<a class="active" href="contact.html">Contact Us</a>
		<div class="login-container">
			<a href="register.php">Register</a>
			<a href="login.php">Login</a>
		</div>
	</div>
	<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		include_once('login_updated.php'); // This will ensure that login.php is included only once
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		include_once('login_updated.php'); // This will ensure that login.php is included only once
		$_SESSION['msg'] = "You must log in first";
	}
	include 'connection.php';

	$conn = new mysqli($servername, $server_username, $server_password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("ERROR: Could not connect. " . $conn->connect_error);
	}
	echo "Connected successfully<br>";

	$sql = 'SELECT * FROM users;';

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			if (isset($_POST[$row['username']]) && $row['Permissions'] == 2) {
				//If the option is now 1 (isset checks returns true if the box is selected) and the option in the db is 2 then update.
				$sql = "UPDATE users SET Permissions = 1 WHERE username ='" . $row['username'] . "'";
				mysqli_query($conn, $sql);
			}
			if (!isset($_POST[$row['username']]) && $row['Permissions'] == 1) {
				//If the option is now 2 (isset checks returns false if the box is not selected) and the option in the db is 1 then update.
				$sql = "UPDATE users SET Permissions = 2 WHERE username ='" . $row['username'] . "'";
				mysqli_query($conn, $sql);
			}
		}
	}

	$sql = 'SELECT * FROM users;';

	$result = $conn->query($sql);

	echo "<table>
	<tr>
	<th>Username</th>
	<th>Email</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Admin</th>
	</tr>";

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			if ($row['ID'] != 0) {
				echo "<tr>";
				echo "<td>" . $row['username'] . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				echo "<td>" . $row['FirstName'] . "</td>";
				echo "<td>" . $row['LastName'] . "</td>";
				echo "<td>";
				if ($row['Permissions'] == 1) {
					echo "<input type='checkbox' name=\"" . $row['username'] . "\" checked>";
				} else {
					echo "<input type='checkbox' name=\"" . $row['username'] . "\">";
				}
				echo "</td>";
				echo "</tr>";
			}
		}
	}
	echo "</table>";
	// close connection
	$conn->close();

	echo "<a href=\"index.html\">Click here </a> to go back to the main page.";
	?>
</body>

<footer>
	<br />
	&copy; 2020 Future Foods. | &copy; All Rights Reserved.
	<hr>
</footer>

</html>