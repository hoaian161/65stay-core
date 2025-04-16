<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/classes/room.php");

$response = new Response();

$rooms = Database::call("SELECT * FROM `rooms` WHERE 1", 0);
$allRooms = [];

foreach ($rooms as $room) {
    $roomObj = new Room($room["ID"]);

    if (User::getInfo()["pre_subscription"] >= Time::getCurrent()) {
        $room["detail"] = $roomObj->getPremiumDetails();
    } else {
        $room["detail"] = $roomObj->getPublicDetails();
    }

    $allRooms[$room["ID"]] = $room;
}

$response->status(1);
$response->data("room_list", $allRooms);

$response->throw();