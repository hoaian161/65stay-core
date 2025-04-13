<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");

class Database {
    private static $db;

    public function __construct() {
        self::$db = new mysqli(Config::database()["host"], Config::database()["username"], Config::database()["password"], Config::database()["name"]);
        self::$db->set_charset("utf8");
    }

    public static function call($query, $type = 1) {
        switch($type){
            case 0:
                return self::$db->query($query);
            case 1:
                return self::$db->query($query)->fetch_array(MYSQLI_ASSOC);
            default:
                break;
        }
    }
}