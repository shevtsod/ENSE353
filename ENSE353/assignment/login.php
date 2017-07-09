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
            require_once "phpClass/Mailer.php";
            require_once 'phpClass/SQLQuery.php';
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
            }

            //Check if password is not empty
            else if($password == "") {
                echo "Empty password not allowed.";
            }

            //Check if a user with this email already exists
            else if($sql->userExists($email)) {
                //If password is correct, login as this user. Otherwise show error
                $db_hash = $sql->getHash($email);
                if(password_verify($password, $db_hash)) {
                    if($sql->userActivated($email)) {
                        //If the user is already activated, go to the subscriptions page

                        //Start a session and remember the user's email address
                        if(!session_id())
                            session_start();
                        $_SESSION["email"] = $email;

                        header("Location: " . URL::urlSubscriptions());
                        die();
                    } else {
                        //If the user is not already activated, show an error
                        echo "This account has not been verified.
                            <br>
                            Please check your email to verify this account.";
                    }
                } else {
                    //If the email and password do not match
                    echo "A user with this email already exists.<br>" .
                        "if this is you, check that you have entered your password correctly.";
                }
            } else {
                //Add this unverified user to the database
                $sql->signUp($email, $hash);

                //Send verification email
                $url = URL::urlVerify() . "?email=" . $_POST['email'] . "&pass=" . $hash;

                $mailer = new Mailer;
                $mailer->sendVerification($_POST['email'], $url);

                //Print verification email message
                echo "<b>
                    Thank you for registering!<br>
                    Please check your email for a verification link to activate your subscription.
                    <br>
                    Your subscription will not be activated until you verify your email address.
                    </b>";
            }
        ?>
        <br><br>
        <a href="index.php">Click here to return to the main page</a>
    </b></p>
</div>

<script src="js/assignment.js"></script>
</body>
</html>
