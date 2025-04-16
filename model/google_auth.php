<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/classes/google_auth.php");

$response = new Response();
$auth = new GoogleAuth();

$userInfo = $_GET;

if($auth->exist($userInfo["gid"])) {
    $response->status(1);
    $response->message("Login successfully");
} else {
    $auth->create($userInfo["gid"], $userInfo["name"], $userInfo["email"], $userInfo["avatar"]);
    
    $response->status(1);
    $response->message("Register successfully");
}

$response->throw();