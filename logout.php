<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>

<head>
	<title>Future Foods Delivery Service</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="CSS/index.css">
	<link rel="stylesheet" href="CSS/navbar.css">
	<link rel="stylesheet" href="CSS/projectreport.css">
	<link rel="stylesheet" href="CSS/report.css">
	<link rel="stylesheet" href="CSS/accordion.css">
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
	<p>Future Foods is an online food delivery service. We are dedicated to serving you food.</p>
	<button class="accordion">Who we are</button>
	<div class="panel">
		<p>We deliver high quality food delivery service from the
			various participating restaurants to your homes. You will
			enjoy the food delivered and your satisfaction will be guaranteed. </p>
	</div>
	<button class="accordion">Our Services</button>
	<div class="panel">
		<ul>
			<li>Online Food Order</li>
			<li>Home Food Delivery</li>
		</ul>
	</div>
	<button class="accordion">Project Description</button>
	<div class="panel">
		<p>Click <a href="projectreport.html"> here</a> to learn more about our database.</p>
	</div>
	<script>
		var acc = document.getElementsByClassName("accordion");
		var i;

		for (i = 0; i < acc.length; i++) {
			acc[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight) {
					panel.style.maxHeight = null;
				} else {
					panel.style.maxHeight = panel.scrollHeight + "px";
				}
			});
		}
	</script>
	<?php
	session_start();
	session_unset();
	session_destroy();

	echo "You logged out successfully. <br />";
	echo "<a href=\"index.html\">Click here </a> to go back to the main page.";
	?>

</body>

<footer>
	<br />
	&copy; 2020 Future Foods. | &copy; All Rights Reserved.
	<hr>
</footer>

</html>