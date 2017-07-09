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

<h1>Subscription Service</h1>
<h2>Edit Subscriptions</h2>

<div class="content">
    <p>
        <?php
            require_once "phpClass/private/URL.php";
            require_once 'phpClass/sqlQuery.php';

            //This file handles changes made and submitted in the form in subscriptions.php

            //Check that our session variable from the subscriptions page is set, otherwise terminate
            if(!isset($_SESSION['email-to-edit'])) {
                echo "Error! You should not be on this page!";
                die();
            }

            $sql = new sqlQuery;
            $email_to_edit = $_SESSION['email-to-edit'];
            $optionA = (isset($_POST['option-a'])) ? true : false;
            $optionB = (isset($_POST['option-b'])) ? true : false;
            $optionC = (isset($_POST['option-c'])) ? true : false;
            $optionDelete = (isset($_POST['option-delete'])) ? true : false;

            //Ensure admin account cannot be deleted
            if($email_to_edit == "admin@subscription-service.com")
                $optionDelete = false;

            //Some debug messages
            /*
            echo "email-to-edit: " . $email_to_edit . "<br>";
            echo "optionA: " . ($optionA ? "true" : "false") . "<br>";
            echo "optionB: " . ($optionB ? "true" : "false") . "<br>";
            echo "optionC: " . ($optionC ? "true" : "false") . "<br>";
            echo "optionDelete: " . ($optionDelete ? "true" : "false") . "<br>";
            */

            //If delete was selected, delete the user account from the database
            if($optionDelete) {
                $sql->deleteUser($email_to_edit);

                echo "<span class=\"warning\">Account has been deleted  successfully! Returning to previous page in 3 seconds...</span>";

                $_SESSION['email-to-edit'] = null;

                if($_SESSION['email'] == "admin@subscription-service.com") {
                    echo "<div class=\"spacer\"></div>" .
                        "<a href=\"subscriptions.php\">Click here if your browser does not automatically redirect you.</a>";

                    header("refresh:3, url=" . URL::urlSubscriptions());
                } else {
                    echo "<div class=\"spacer\"></div>" .
                        "<a href=\"logout.php\">Click here if your browser does not automatically redirect you.</a>";

                    header("refresh:3, url=" . URL::urlLogout());
                }
            } else {
                //Otherwise save the changes to the database
                $sql->setOption($email_to_edit, "optionA", $optionA);
                $sql->setOption($email_to_edit, "optionB", $optionB);
                $sql->setOption($email_to_edit, "optionC", $optionC);

                echo "Edits have been applied successfully! Returning to previous page in 3 seconds..." .
                    "<div class=\"spacer\"></div>" .
                    "<a href=\"subscriptions.php\">Click here if your browser does not automatically redirect you.</a>";

                $_SESSION['email-to-edit'] = null;
                header("refresh:3, url=" . URL::urlSubscriptions());
            }
        ?>
    </p>
</div>

<script src="js/assignment.js"></script>
</body>
</html>
