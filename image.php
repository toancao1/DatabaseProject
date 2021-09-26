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