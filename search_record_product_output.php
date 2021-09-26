<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>

<head>
	<title>Search a record</title>
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

	if (isset($_SESSION["session_flag"])) {
		if ($_SESSION["session_flag"] == "valid") {

			$conn = new mysqli($servername, $server_username, $server_password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("ERROR: Could not connect. " . $conn->connect_error);
			}
			echo "Connected successfully<br>";

			if ($_POST["attribute"] == "ProductID") {
				if (isset($_POST["attribute"])) {
					echo 'You chose: ' . $_POST["attribute"] . ' <br>';
					// Escape user inputs for security
					$ID = $_POST['attributeValue'];

					echo 'You entered ID: ' . $ID . '<br> <br>';
				}
				$sql = 'SELECT ProductID, Name FROM ProductName WHERE ProductID = ' . $ID;
			} elseif ($_POST["attribute"] == "ProductName") {
				if (isset($_POST["attribute"])) {
					echo 'You chose: ' . $_POST["attribute"] . ' <br>';
					// Escape user inputs for security
					$name = $_POST['attributeValue'];

					echo 'You entered the item: ' . $name . '<br> <br>';
				}
				$sql = 'SELECT ProductID, Name FROM ProductName WHERE Name =  ' . $name;
			}

			// attempt insert query execution
			$result = $conn->query($sql);
			if (!$result) {
				echo "Could not get data: " . $conn->error;
			}

			while ($row = $result->fetch_assoc()) {
				echo "ProductID: {$row['ProductID']}  <br> " .
					"Product name: {$row['ProductName']} <br> " .
					"--------------------------------<br>";
			}

			echo "Search completed! <br>";

			$sql = 'SELECT * FROM ProductName';
			$result = $conn->query($sql);

			echo "<h2>ProductName Table</h2>";
			echo "<table>
			<tr>
			<th>ProductID</th>
			<th>ProductName</th>
			</tr>";

			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row['ProductID'] . "</td>";
					echo "<td>" . $row['ProductName'] . "</td>";
				}
			}
			echo "</table>";

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