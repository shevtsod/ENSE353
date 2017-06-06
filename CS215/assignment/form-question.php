<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["logout"])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
//Prevent access to page if user is not logged in.
if (!isset($_SESSION["loggedin"])) {
    die("<h2>You must be logged in to submit a question.<h1>");
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

<div class="phperror">
    <?php

    include("PHP/ValidationFunctions.php");

    //If found a POST HTTP request, connect to database.
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
        validateQuestion($conn);

        // Close Database connection
        mysqli_close($conn);
    }
    ?>
</div>

<div class="error_box_q" id="error"></div>

<p class="centertext">SUBMIT A NEW QUESTION</p>

<form id="form_q" action="form-question.php" method="post">
    <fieldset>
        <label for="form_q_input">Question:</label><br/>
        <textarea name="form_q_input" id="form_q_input" rows="10" cols="50"></textarea><br/>
        <p id="char_counter">Character Count: 0/300</p>
        <label for="websitelink">Website Link (optional):</label><br/>
        <input type="text" name="websitelink" id="websitelink"/><br/>
        <input type="submit" id="submit"/>
    </fieldset>
</form>

<!-- Page content ends here -->

<?php include "PHP/footer.php" ?>

<!-- Form Validation Javascript DOM 2 Event Registration -->
<script type="text/javascript" src="Javascript/form_validation_r.js"></script>

</body>
</html>