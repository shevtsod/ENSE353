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
            require_once "phpClass/private/URL.php";
            require_once 'phpClass/SQLQuery.php';
            //Required to use vanilla PHP 5.4.16 which doesn't support the
            //password hashing functionality added in PHP 5.5
            //Using password_compat (https://github.com/ircmaxell/password_compat)
            //library instead as suggested on the PHP documentation
            //See: http://php.net/manual/en/intro.password.php
            require_once 'phpClass/vendor/password_compat-master/lib/password.php';

            $sql = new sqlQuery;

            $email = $_GET['email'];
            $hash_pass = $_GET['pass'];
            $hash = $sql->getHash($email);

            //Check if the email and password match
            $hash = $sql->getHash($email);

            //Stop if the encrypted passwords do not match or the user is already activated
            if($hash != $hash_pass || $sql->userActivated($email)) {
                echo "This activation link is invalid.";
            } else {
                //If the information is valid, set the user as active in the database
                $sql->activateUser($email);
                echo "Account activated successfully. You can now login on the main page<br>" .
                        "to adjust your subscription preferences.";
            }
        ?>
        <br><br>
        <a href="index.php">Click here to return to the main page</a>
    </b></p>
</div>

<script src="js/assignment.js"></script>
</body>
</html>
