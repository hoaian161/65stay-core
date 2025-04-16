<?php
session_start();
// error_reporting(0);
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/time.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/config.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/validate.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/database.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/response.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/classes/user.php");

new Database();
new Time();

function antiInj($str){
    return str_replace(['"', "'"], "", $str);
}