<?php
// model/test.php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/classes/room.php");

$response = new Response();
$room = new Room();
$response->data("detail", $room->getPremiumDetails());

$response->throw();