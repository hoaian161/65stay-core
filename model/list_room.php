<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/classes/room.php");

$response = new Response();
// column: ID, price, detail
// Database::call("INSERT INTO `rooms` (`price`, `detail`) VALUES ('".$this->price."', '".json_encode($this->detail)."')", 0);
/*

Fields of user:
ID
gid
name
email
avatar
balance
pre_subscription
created

Call ID field: User::getInfo()["ID"]
Get current seconds (epoch): Time::getCurrent()
*/

// array_push($target, $elm);

new User([
    "pre_subscription" => Time::getCurrent() + 120
]);

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