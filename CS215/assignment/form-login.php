<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["logout"])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>
<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
        "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--meta charset="UTF-8"-->
    <title>Question Cards</title>
    <link rel="stylesheet" type="text/css" href="CSS/sitestyle.css"/>
    <!-- Form Validation Javascript -->
    <script type="text/javascript" src="Javascript/form_validation.js"></script>
</head>
<body>

<?php include "PHP/header.php" ?>

<!-- Page content starts here -->

<div id="branding">
    <p>
        Welcome to Question Cards! Our site offers a platform for
        users to ask questions and receive answers. Statistics have shown that
        our platform has a user satisfaction 100% above the next question asking
        platform that has no users!
    </p>
</div>

<div id="benefits">
    <p>Users who are logged into the site receive the following benefits:</p>
    <ul>
        <li>Ability to ask questions</li>
        <li>Ability to answer questions</li>
        <li>Ability to vote on answers</li>
    </ul>
</div>

<div class="phperror">
    <?php

    include("PHP/ValidationFunctions.php");

    //If found an HTTP POST request, connect to database.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Create a MySQL database connection:
        $username = "shevtsod";
        $password = "Ds1234#";
        $databasename = $username;

        $conn = mysqli_connect("localhost", $username, $password, $databasename);

        // Check connection:
        // if failed to establish a connection, then exit the php program

        if (!$conn) {
            die("<p>Connection failed: " . mysqli_connect_error() . "</p>");
        }

        //Execute requested action.
        validateLogin($conn);

        // Close Database connection
        mysqli_close($conn);
    }
    ?>
</div>

<div class="error_box" id="error"></div>

<form id="form_login" action="form-login.php" method="post">
    <fieldset>
        <label for="email">Email:</label><br/>
        <input type="text" name="email" id="email"/><br/>
        <label for="password">Password:</label><br/>
        <input type="password" name="password" id="password"/><br/>
        <input type="submit" id="submit"/>
    </fieldset>
</form>

<p class="centertext">No account?</p>

<div id="button_signup">
    <a class="b_signup_link" href="form-signup.php">
        SIGN UP
    </a>
</div>

<!-- Page content ends here -->

<?php include "PHP/footer.php" ?>

<!-- Form Validation Javascript DOM 2 Event Registration -->
<script type="text/javascript" src="Javascript/form_validation_r.js"></script>

</body>
</html>