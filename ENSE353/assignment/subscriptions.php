<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <meta name="theme-color" content="#000000">
    <title>Daniel Shevtsov</title>
    <link rel="stylesheet" type="text/css" href="css/assignment.css">
</head>
<body>

<div class="content">
    <p><b>
        <?php
            require_once 'phpClass/sqlQuery.php';

            $sql = new sqlQuery;
            $email = $_SESSION['email'];

            echo "Preferences Page for $email";
        ?>
        <br><br>
        <a href="logout.php">Click here to log out and return to the main page</a>
    </b></p>
</div>

<script src="js/assignment.js"></script>
</body>
</html>
