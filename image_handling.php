<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>

<head>
	<title>Image Handling</title>
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
	<form action="" method="post" enctype="multipart/form-data">
		<label>Upload Image File:</label><br>
		<input name="userImage" type="file">
		<input type="submit" value="Submit">
		<p><a href="getLastImage.php" style="color: red;">Click here to display last inserted image in the database</a> </p>
		<p><a href="listImages.php" style="color: red;">Click here to display all images in the database</a> </p>
		<p><a href="ajax_image_form.html" style="color: red;">Click here to search images using ajax</a> </p>
		<?php

		include "connection.php";

		if (count($_FILES) > 0) {
			if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
				// If upload button is clicked ...
				// Get image name

				// [tmp_name] A temporary address where the file is located before processing the upload request
				$imgData = $_FILES['userImage']['tmp_name'];

				// [name] Name of file which is uploading
				$imgName = $_FILES['userImage']['name'];

				// base64_encode(): Encodes the given data with base64
				// file_get_contents(): Reads entire file into a string
				// addslashes(): Quote string with slashes where needed
				$imgData = base64_encode(file_get_contents(addslashes($imgData)));

				// getimagesize()determines the size, the dimensions and the file type (mime) of an image file 
				$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);

				// mime: get the image type 
				$imageType = $imageProperties['mime'];

				// Create connection
				$conn = new mysqli($servername, $server_username, $server_password, $dbname);

				// Check connection
				if ($con->connect_error) {
					die("Connection failed: " . $con->connect_error);
				}

				// Insert the image into the table
				$sql = "INSERT INTO output_images(imageData, imageType, imageName) VALUES('$imgData', '$imageType','$imgName')";
				$current_id = $conn->query($sql);
				if ($current_id) {
					echo "Image added successfully.<br>";
				} else {
					echo "ERROR" . $sql . "<br>" . $conn->error;
				}

				// Call listImages.php to display the last inserted image
				/*if (isset($current_id)) {
			    header("Location: getLastImage.php");
	        }*/
			}
		}
		?>
</body>

<footer>
	<br />
	&copy; 2020 Future Foods. | &copy; All Rights Reserved.
	<hr>
</footer>

</html>