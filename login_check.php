<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>

<head>
	<title>Menu</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="CSS/index.css">
	<link rel="stylesheet" href="CSS/navbar.css">
	<link rel="stylesheet" href="CSS/projectreport.css">
	<link rel="stylesheet" href="CSS/report.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
		.active {
			background-color: #004e7a;
		}
	</style>
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
				<a href="projectreport.html">Project Report</a>
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
	?>

	<!-- // notification message -->
	<?php
	if (!isset($_SESSION['username'])) {
		echo "<h3>";
		echo $_SESSION['msg'];
		echo "</h3>";
	} else if (isset($_SESSION['success'])) {
		echo "<h3>";
		echo $_SESSION['success'];
		unset($_SESSION['success']);
		echo "</h3>";
	}

	?>

	<!-- logged in user information -->
	<?php if (isset($_SESSION['username'])) {
		echo "<p>Welcome <strong>";
		echo $_SESSION['username'];
		echo "</strong></p>";

		if ($_SESSION['permissions'] == 1) {
			echo "<h3>";
			echo "This content is only shown to administrators <br>";
			echo "</h3>";
		}
		if ($_SESSION['permissions'] == 2 || $_SESSION['permissions'] == 1) {
			echo "<h3>";
			echo "This content is shown to registered users<br>";
			echo "</h3>";
		}
		echo "<p> <a href=\"index.php?logout='1'\" style=\"color: red;\">logout</a> </p>";
	}
	?>
	<?php
	if ($permissions > 0) {
		echo "<h3>";
		echo "<a href=\"search_record.php\">Click here</a> to search existing record. <br>";
		echo "</h3>";
		if ($permissions == 1) {
			echo "<h2>Admin Content!!</h2>";
			echo "<h3>";
			echo "<a href=\"search_record_updated.php\">Click here</a> to search existing record . <br>";
			echo "<a href=\"update_record.php\">Click here</a> update a record. <br>";
			echo "</h3>";
		}
	} else {
		echo "<h3>";
		echo "This content is shown to everyone (Guest) <br>";
		echo "</h3>";
	}
	?>



	<?php

	session_start();

	if (isset($_SESSION["session_flag"])) {
		if ($_SESSION["session_flag"] == "valid") {
			print_menu();
		} else {
			echo "<h2>Invalid session!</h2>";
			echo "<a href=\"login.html\">Click here </a> to go back to the main page.";
		}
	} else if ($_POST["login"] || $_POST["password"]) {
		if ($_POST["login"] == "futurefoods" && $_POST["password"] == "food123") {
			echo "<h3>Login " . $_POST['login'] . " Success! </h3>";
			$_SESSION["session_flag"] = "valid";
			print_menu();
		} else {
			echo "<p>Incorrect login or password. <p>";
			echo "<a href=\"index.html\">Click here </a> to go back to the main page.";
		}
	} else {
		echo "<h2>No login or password entered! </h2>";
		echo "<a href=\"index.html\">Click here </a> to go back to the main page.";
	}
	function print_menu()
	{
		echo "<h3>You logged-in successfully! </h3>";
		echo "<h3>Add a record</h3>";
		echo "<a href=\"add_new_record_order.php\">Click here</a> to add a new record to orders table. <br>";
		echo "<a href=\"add_new_record_product.php\">Click here</a> to add a new record to product table. <br><br>";
		echo "<h3>Search a record</h3>";
		echo "<a href=\"search_record_orders.php\">Click here</a> to search existing record in the orders table. <br>";
		echo "<a href=\"search_record_product.php\">Click here</a> to search existing record in the product table. <br>";
		echo "<h3>View all records</h3>";
		echo "<a href=\"view_all_records_output.php\">Click here</a> to view all records. <br>";
		echo "<h3>Update a record</h3>";
		echo "<a href=\"update_record_registration.php\">Click here</a> update a record in the registration table. <br>";
		echo "<a href=\"update_record_product.php\">Click here</a> update a record in the product table. <br>";
		echo "<h3>View a joined record</h3>";
		echo "<a href=\"join_tables_customer_output.php\">Click here</a> to join two tables for the customer table. <br>";
		echo "<a href=\"join_tables_product_output.php\">Click here</a> to join two tables for the product table. <br>";
		echo "<h3>Delete a record</h3>";
		echo "<a href=\"delete_record_product.php\">Click here</a> to delete a record from the product table. <br>";
		echo "<a href=\"delete_record_restaurant.php\">Click here</a> to delete a record from the restaurant table. <br>";
		echo "<h3>Upload and view an image</h3>";
		echo "<a href=\"image_handling.php\">Click here</a> to upload and view an image from the database. <br>";
		echo "<br>";
		echo "<a href=\"logout.php\">Click here</a> to logout. <br>";
	}
	?>


</body>

<footer>
	<br />
	&copy; 2020 Future Foods. | &copy; All Rights Reserved.
	<hr>
</footer>

</html>