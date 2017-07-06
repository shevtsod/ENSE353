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
<h2>ENSE 353 Assignment</h2>
<p>Daniel Shevtsov</p>

<div class="content">
    <p>
        <?php
            require_once "phpClass/Mailer.php";
            require_once 'phpClass/sqlQuery.php';
            //Required to use vanilla PHP 5.4.16 which doesn't support the
            //password hashing functionality added in PHP 5.5
            //Using password_compat (https://github.com/ircmaxell/password_compat)
            //library instead as suggested on the PHP documentation
            //See: http://php.net/manual/en/intro.password.php
            require_once 'phpClass/vendor/password_compat-master/lib/password.php';

            $sql = new sqlQuery;

            $email = $_POST['email'];
            $password = $_POST['password'];
            $hash = password_hash($password, PASSWORD_BCRYPT);

            //Check if this email is valid
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email address entered.";
                die();
            }

            //Check if password is not empty
            if($password == "") {
                echo "Empty password not allowed.";
                die();
            }

            //Check if a user with this email already exists
            if($sql->userExists($email)) {
                //If password is correct, login as this user. Otherwise show error
                $db_hash = $sql->getHash($email);
                if(password_verify($password, $db_hash)) {
                    echo "Logged in successfully!<br>";
                    //TODO: Redirect here
                    echo "User Activated: ";
                    echo $sql->userActivated($email) ? "true" : "false";
                } else {
                    echo "A user with this email already exists.";
                }
            } else {
                //Add this unverified user to the database
                $sql->signUp($email, $hash);

                //Send verification email
                $url = "http://localhost/assignment/confirm.php?email=" . $_POST['email'] .
                    "&pass=" . $hash;

                $mailer = new Mailer;
                $mailer->sendVerification($_POST['email'], $url);

                //Print verification email message
                echo "<b>
                    Thank you for registering! Please check your email for a verification link to activate your subscription.
                    <br>
                    Your subscription will not be activated until you verify your email address.
                    </b>";
            }
        ?>
        <br><br>
        <a href="index.php">Click here to return to the main page</a>
    </p>
</div>

<script src="js/assignment.js"></script>
</body>
</html>