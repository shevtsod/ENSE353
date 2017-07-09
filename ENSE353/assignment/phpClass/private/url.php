<?php
class URL {
    const URL_BASE = "http://localhost/ENSE353/assignment/";

    public static function urlBase() {
        return self::URL_BASE;
    }

    public static function urlVerify() {
        return self::URL_BASE . "verify.php";
    }

    public static function urlSubscriptions() {
        return self::URL_BASE . "subscriptions.php";   
    }

    public static function urlAdmin() {
        return self::URL_BASE . "admin.php";   
    }

    public static function urlLogout() {
        return self::URL_BASE . "logout.php";   
    }
}
?>
