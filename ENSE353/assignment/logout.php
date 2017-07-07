<?php
require_once "phpClass/private/url.php";

//If the session exists, destroy it
if(session_id()) {
    $_SESSION = array();
    session_destroy();
}
//Return to the main page
header("Location: " . URL::urlBase());
?>
