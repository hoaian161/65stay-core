<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/classes/auth.php");

$response = new Response();
$response->status(0);

$type = $_GET;
$username = $_GET;
$password = $_GET;

$auth = new Auth($username, $password);

if ($type === "login") {
    if ($auth->login() == 0) {
        $response->message("Invalid username or password");
    } else {
        $response->status(1);
        $response->message("Login successful");
    }
} else if ($type === "register") {
    $register = $auth->register();
    if ($register == 0) {
        $response->message("Username must be 6-30 letters, without special characters");
    } else if ($register == -1){
        $response->message("Password must be 8-30 characters");
    } else if ($register == -2) {
        $response->message("Account already exists");
    } else {
        $response->status(1);
        $response->message("Register successfully");
    }
}

$response->throw();