<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");

class Time {
    private static $current;

    public function __construct() {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        self::$current = time();
    }

    public static function getCurrent() {
        return self::$current;
    }
}