<?php
require_once "phpClass/private/URL.php";

session_start();

//If the session exists, destroy it
if(isset($_SESSION)) {
    $_SESSION = array();

    //See: http://php.net/manual/en/function.session-destroy.php
    //for information on completely destroying a session
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
}

//Return to the main page
header("Location: " . URL::urlBase());
?>
