<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");

class GoogleAuth {
    public function exist($gid) {
        return !empty(Database::call("SELECT ID FROM `account` WHERE `gid` = '".$gid."'", 1)["ID"]);
    }

    public function create($gid, $name, $email, $avatar) {
        Database::call("INSERT INTO `account` (`gid`, `name`, `email`, `avatar`, `balance`, `pre_subscription`, `created`) VALUES ('".$gid."', '".$name."', '".$email."', '".$avatar."', '0', '0', '".Time::getCurrent()."')", 0);
    }
}