<?php
class URL {
    const URL_BASE = "http://192.168.1.115/ENSE353/assignment/";

    public static function urlBase() {
        return self::URL_BASE;
    }

    public static function urlVerify() {
        return self::URL_BASE . "verify.php";
    }

    public static function urlSubscriptions() {
        return self::URL_BASE . "subscriptions.php";   
    }
}
?>
