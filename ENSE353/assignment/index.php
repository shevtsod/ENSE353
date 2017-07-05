<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <meta name="theme-color" content="#000000">
    <title>Daniel Shevtsov</title>
    <link rel="stylesheet" type="text/css" href="css/assignment.css">
    <!-- Roboto Font by Google Fonts (https://fonts.google.com/specimen/Roboto) -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>

<h1>Subscription Service</h1>
<h2>ENSE 353 Assignment</h2>
<p>Daniel Shevtsov</p>

<div class="form" id="form_login">
    <h3>Sign Up/Login</h3>
    <form>
        <label for="email">Email:</label>
        <input id="email" type="text" name="email">
        <label for="password">Password:</label>
        <input id="password" type="password" name="password">
        <input type="submit">
    </form>
</div>

<?php /*
    require_once 'phpClass/Mailer.php';

    $mail = new Mailer;

    $to = 'i965215@mvrht.net';
    $link = 'http://127.0.0.1/';
    
    echo "Sending mail to " . $to;
    
    $mail->sendVerification($to, $link);
    */
?>
</body>
</html>
