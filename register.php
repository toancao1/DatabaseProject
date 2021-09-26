<?php include('server.php') ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>

<head>
    <title>Register</title>
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
            <a class="active" href="register.php">Register</a>
            <a href="login.php">Login</a>
        </div>
    </div>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <h3>Account Details</h3>
        <p>Please fill this form to create an account.</p>
        <form action="register.php" method="post">
            <?php include('errors.php'); ?>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <h3>Billing Details</h3>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="number" name="phone" class="form-control">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" class="form-control">
            </div>
            <div class="form-group">
                <label>Province</label>
                <select name="province">
                    <option value="AB">Alberta</option>
                    <option value="BC">British Columbia</option>
                    <option value="MB">Manitoba</option>
                    <option value="NB">New Brunswick</option>
                    <option value="NL">Newfoundland and Labrador</option>
                    <option value="NS">Nova Scotia</option>
                    <option value="ON">Ontario</option>
                    <option value="PE">Prince Edward Island</option>
                    <option value="QC">Quebec</option>
                    <option value="SK">Saskatchewan</option>
                    <option value="NT">Northwest Territories</option>
                    <option value="NU">Nunavut</option>
                    <option value="YT">Yukon</option>
                </select>
            </div>
            <div class="form-group">
                <label>Postal Code</label>
                <input type="text" name="postal_code" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
    <?php
    // Include connection file
    require_once "connection.php";


    // Define variables and initialize with empty values
    $email = $password = $confirm_password = "";
    $email_err = $password_err = $confirm_password_err = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Validate email
        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter a email.";
        } else {
            // Prepare a select statement
            $sql = "SELECT customers_id FROM customers WHERE email = ?";

            if ($stmt = $conn->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_email);

                // Set parameters
                $param_email = trim($_POST["email"]);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // store result
                    $stmt->store_result();

                    if ($stmt->num_rows == 1) {
                        $email_err = "This email is already taken.";
                    } else {
                        $email = trim($_POST["email"]);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                $stmt->close();
            }
        }

        // Validate password
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have atleast 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Validate confirm password
        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm password.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
            }
        }

        // Check input errors before inserting in database
        if (empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

            // Prepare an insert statement
            $sql = "INSERT INTO customers (email, password, first_name, last_name, phone, address, city, province, postal_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("sssssssss", $param_email, $param_password, $param_first_name, $param_last_name, $param_phone, $param_address, $param_city, $param_province, $param_postal_code);

                // Set parameters
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                $param_first_name = trim($_POST["first_name"]);
                $param_last_name = trim($_POST["last_name"]);
                $param_phone = trim($_POST["phone"]);
                $param_address = trim($_POST["address"]);
                $param_city = trim($_POST["city"]);
                $param_province = trim($_POST["province"]);
                $param_postal_code = trim($_POST["postal_code"]);
                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Redirect to login page
                    header("location: login.php");
                } else {
                    echo ("Something went wrong. Please try again later." . $stmt->error);
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