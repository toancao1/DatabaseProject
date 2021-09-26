<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>

<head>
	<title>Contact</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="CSS/index.css">
	<link rel="stylesheet" href="CSS/navbar.css">
	<link rel="stylesheet" href="CSS/projectreport.css">
	<link rel="stylesheet" href="CSS/report.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
		table, th, td {
			border: 2px solid black;
		}
	</style>
</head>

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
include "connection.php";

// Create connection
$conn = new mysqli($servername, $server_username, $server_password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM output_images WHERE imageID IN (SELECT MAX(imageID) FROM output_images)";

$result = $conn->query($sql);
?>
<table style="width:100%">
	<tr>
		<th>Image name </th>
		<th>Image</th>
		<th>Image text</th>
	</tr>
	<?php
	while ($row = $result->fetch_assoc()) {
		echo '<tr>';
		echo '<td>' . $row['imageName'] . '</td>';
		echo '<td><img src="data:image;base64,' . $row['imageData'] . '" alt="' . $row['imageName'] . '"></td>';
		echo '<td>' . $row['imageText'] . '</td>';
		echo '</tr>';
	}
	$conn->close();
	?>
</table>

</body>

<footer>
	<br />
	&copy; 2020 Future Foods. | &copy; All Rights Reserved.
	<hr>
</footer>

</html>