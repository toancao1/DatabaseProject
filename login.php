<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>

<head>
    <title>Login</title>
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
        <a href="contact.html">Contact Us</a>
        <div class="login-container">
            <a href="register.php">Register</a>
            <a class="active" href="login.php">Login</a>
        </div>
    </div>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="login_check.php" method="POST">
            Username: <input type="text" name="login"><br />
            Password: <input type="password" name="password"><br />
            <input type="submit">
        </form>
    </div>
    <?php
    // Initialize the session
    session_start();

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        header("location: order.php");
        exit;
    }

    // Include connection file
    require_once "connection.php";

    // Define variables and initialize with empty values
    $email = $password = "";
    $email_err = $password_err = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Check if email is empty
        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter email.";
        } else {
            $email = trim($_POST["email"]);
        }

        // Check if password is empty
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter your password.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Validate credentials
        if (empty($email_err) && empty($password_err)) {
            // Prepare a select statement
            $sql = "SELECT customers_id, email, password FROM customers WHERE email = ?";

            if ($stmt = $conn->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_email);

                // Set parameters
                $param_email = $email;

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Store result
                    $stmt->store_result();

                    // Check if email exists, if yes then verify password
                    if ($stmt->num_rows == 1) {
                        // Bind result variables
                        $stmt->bind_result($customers_id, $email, $hashed_password);
                        if ($stmt->fetch()) {
                            if (password_verify($password, $hashed_password)) {
                                // Password is correct, so start a new session
                                session_start();

                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["customers_id"] = $customers_id;
                                $_SESSION["email"] = $email;

                                // Redirect user to welcome page
                                header("location: welcome.php");
                            } else {
                                // Display an error message if password is not valid
                                $password_err = "The password you entered was not valid.";
                            }
                        }
                    } else {
                        // Display an error message if email doesn't exist
                        $email_err = "No account found with that email.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                $stmt->close();
            }
        }

        // Close connection
        $conn->close();
    }
    ?>
</body>

</html>