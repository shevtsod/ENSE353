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
    <?php
        require_once "phpClass/private/URL.php";
        require_once 'phpClass/sqlQuery.php';

        $admin = false;

        //Check that the session is set
        if(!isset($_SESSION)) {
            echo "Error: not logged in!";
        } else {
            $sql = new sqlQuery;

            //The admin page sends POST data to this page, first check if this data was sent
            if(isset($_POST['email'])) {
                $email = $_POST['email'];
                $admin = true;
            } else {
                //If no POST data, just proceed to the subscriptions page
                $email = $_SESSION['email'];

                //If user is admin, redirect to the administration page instead
                if($email == "admin@subscription-service.com") {
                    header("Location: " . URL::urlAdmin());
                    die();
                }
            }
            echo "<h2>Preferences Page for $email</h2>";
        }
    ?>

    <div class="content" id="form-login">
        <form method=POST action="phpClass/private/handleEdit.php">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <label for="option-a">Subscription Option A:</label>
            <input type="checkbox" name="option-a" <?php if($sql->getOption($email, "optionA")) echo "checked"; ?>>
            <label for="option-b">Subscription Option B:</label>
            <input type="checkbox" name="option-b" <?php if($sql->getOption($email, "optionB")) echo "checked"; ?>>
            <label for="option-c">Subscription Option C:</label>
            <input type="checkbox" name="option-c" <?php if($sql->getOption($email, "optionC")) echo "checked"; ?>>
            <label for="option-delete" class="warning">Delete Account? (Cannot be Undone!)</label>
            <input type="checkbox" name="option-delete">
            <input type="submit">
        </form>

        <div class="spacer"></div>
    </div>

    <?php
        echo $admin 
            ? "<a href=\"admin.php\">Click here to return to the administrator page</a>"
            : "<a href=\"logout.php\">Click here to log out and return to the main page</a>";
    ?>
</div>

<script src="js/assignment.js"></script>
</body>
</html>
