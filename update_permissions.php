<?php
session_start();

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	include_once('login.php'); // This will ensure that login.php is included only once
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	include_once('login.php'); // This will ensure that login.php is included only once
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

echo "<h1>users Table</h1>";
echo "<h3>Set the permissions of users you want to change then click on submit.</h3>";
echo "<form action = \"update_permissions_output.php\" method = \"POST\">";

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
		//if($row['ID']!=1){
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
		//}
	}
}
echo "</table>";

echo "<input type = \"submit\">
			</form> ";

// close connection
$conn->close();

echo "<a href=\"login.php\">Click here </a> to go back to the main page.";
