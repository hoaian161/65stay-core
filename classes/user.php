<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");

class User {
    private static $id;
    private static $info;

    public function __construct($info) {
        self::$info = $info;
    }

    public static function getInfo() {
        return self::$info;
    }
}