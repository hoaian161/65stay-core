<?php
// model/add_room.php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/classes/room.php");

$response = new Response();
$room = new Room();

$data = $_POST;
$response->status(0);

if (!Validate::alnum($data["h_name"], 1, 50)) {
    $response->message("House name must be between 1 - 50 characters long and not contain special characters");
} else if (!Validate::alpha($data["h_ownerName"], 1, 25)) {
    $response->message("Owner name must be between 1 - 25 alphabetic characters");
} else if (!Validate::bool($data["h_ownerGender"])) {
    $response->message("Gender selection is required");
} else if (!Validate::number($data["h_ownerPhone"], 1, 99999999999, 10, 11)) {
    $response->message("Owner's phone number must be 10 - 11 digits long");
} else if (!Validate::textSpecial($data["h_address"], 1, 255)) {
    $response->message("Address is required");
} else if (!Validate::textSpecial($data["h_roadImages"], 1, 255)) {
    $response->message("Road image path is required");
} else if (!Validate::number($data["h_emptyRoomNum"], 1, 99, 1, 2)) {
    $response->message("Empty room count must be a number between 1 - 99");
} else if (!Validate::number($data["h_totalRoomNum"], 1, 100, 1, 2)) {
    $response->message("Total room count must be a number between 1 - 100");
} else if (!Validate::alpha($data["h_parkingLotType"], 1, 50)) {
    $response->message("Parking lot type must be between 1 - 50 alphabetic characters");
} else if (!Validate::textSpecial($data["h_parkingLotImages"], 1, 255)) {
    $response->message("Parking lot image path is required");
} else if (!Validate::bool($data["h_shareOwner"])) {
    $response->message("Shared ownership option is required"); 
} else if (!Validate::bool($data["h_flooding"])) {
    $response->message("Flooding option is required"); 
} else if (!Validate::number($data["h_aroundSize"], 0, 50, 1, 5)) {
    $response->message("Alley or road width must be between 1 - 50 (m)"); 
} else if (!Validate::integer($data["h_contractDuration"], 0, 60, 1, 2)) {
    $response->message("Contract duration must be a number between 0 - 60 (months)"); 
} else if (!Validate::textSpecial($data["h_security"], 1, 255)) {
    $response->message("Security information is required"); 
} else if (!Validate::textSpecial($data["h_feedback"], 1, 255)) {
    $response->message("Feedback must be between 1 - 255 characters"); 
} else if (!Validate::textSpecial($data["h_extensions"], 1, 255)) {
    $response->message("Utilities information is required (e.g., air conditioner, fridge, ...)"); 
} else if (!Validate::textSpecial($data["r_roomNum"], 1, 25)) {
    $response->message("Room number must be between 1 - 25 alphabetic characters"); 
} else if (!Validate::number($data["r_price"], 1, 10, 1, 5)) {
    $response->message("Price must be between 1 - 10 (milions)"); 
} else if (!Validate::alpha($data["r_residenceType"], 1, 50)) {
    $response->message("Residence type must be between 1 - 50 alphabetic characters");
} else if (!Validate::textSpecial($data["r_privateTime"], 1, 25)) {
    $response->message("Access time must be between 1 - 25 characters and not contain special characters"); 
} else if (!Validate::alpha($data["r_wallColor"], 1, 50)) {
    $response->message("Wall color must be between 1 - 50 alphabetic characters"); 
} else if (!Validate::bool($data["r_balcony"])) {
    $response->message("Balcony option is required"); 
} else if (!Validate::bool($data["r_mezzanine"])) {
    $response->message("Mezzanine option is required"); 
} else if (!Validate::bool($data["r_window"])) {
    $response->message("Window option is required");
} else if (!Validate::bool($data["r_pet"])) {
    $response->message("Pet-friendly option is required"); 
} else if (!Validate::bool($data["r_child"])) {
    $response->message("Child-friendly option is required"); 
} else if (!Validate::bool($data["r_drunk"])) {
    $response->message("Drinking/gathering option is required"); 
} else if (!Validate::bool($data["r_allowMixedGender"])) {
    $response->message("Mixed-gender gathering option is required"); 
} else if (!Validate::integer($data["r_maxPeopleNum"], 1, 10, 1, 2)) {
    $response->message("Maximum occupancy must be between 1 - 10 people"); 
} else if (!Validate::textSpecial($data["r_images"], 1, 255)) {
    $response->message("Room image path is required");
} else if (!Validate::number($data["r_size"], 1, 1000, 1, 4)) {
    $response->message("Room size is invalid. Please enter a value between 1 - 1000");
} else if (!Validate::textSpecial($data["r_videos"], 1, 255)) {
    $response->message("Room video path is required");
} else if (!Validate::number($data["r_electricityPrice"], 0, 100000, 0, 6)) {
    $response->message("Electricity price is invalid");
} else if (!Validate::number($data["r_waterPrice"], 0, 100000, 0, 6)) {
    $response->message("Water price is invalid");
} else if (!Validate::integer($data["r_beforeTimeRelease"], 0, 24, 0, 2)) {
    $response->message("Invalid time before room return. Please enter a value between 0 - 24 (months)");
} else {
    $room->setPrice(Validate::filter($data["r_price"]));
    $room->setDetail("boarding_house", "name", Validate::filter($data["h_name"]));
    $room->setDetail("boarding_house", "owner_name", Validate::filter($data["h_ownerName"]));
    $room->setDetail("boarding_house", "owner_gender", Validate::filter($data["h_ownerGender"]));
    $room->setDetail("boarding_house", "owner_phone", Validate::filter($data["h_ownerPhone"]));
    $room->setDetail("boarding_house", "address", Validate::filter($data["h_address"]));
    $room->setDetail("boarding_house", "road_images", Validate::filter($data["h_roadImages"]));
    $room->setDetail("boarding_house", "empty_room_num", Validate::filter($data["h_emptyRoomNum"]));
    $room->setDetail("boarding_house", "total_room_num", Validate::filter($data["h_totalRoomNum"]));
    $room->setDetail("boarding_house", "parking_lot_type", Validate::filter($data["h_parkingLotType"]));
    $room->setDetail("boarding_house", "parking_lot_images", Validate::filter($data["h_parkingLotImages"]));
    $room->setDetail("boarding_house", "share_owner", Validate::filter($data["h_shareOwner"]));
    $room->setDetail("boarding_house", "flooding", Validate::filter($data["h_flooding"]));
    $room->setDetail("boarding_house", "around_size", Validate::filter($data["h_aroundSize"]));
    $room->setDetail("boarding_house", "contract_duration", Validate::filter($data["h_contractDuration"]));
    $room->setDetail("boarding_house", "sercurity", Validate::filter($data["h_security"]));
    $room->setDetail("boarding_house", "feedback", Validate::filter($data["h_feedback"]));
    $room->setDetail("boarding_house", "extensions", Validate::filter($data["h_extensions"]));
    $room->setDetail("boarding_room", "room_num", Validate::filter($data["r_roomNum"]));
    $room->setDetail("boarding_room", "pet", Validate::filter($data["r_pet"]));
    $room->setDetail("boarding_room", "child", Validate::filter($data["r_child"]));
    $room->setDetail("boarding_room", "drunk", Validate::filter($data["r_drunk"]));
    $room->setDetail("boarding_room", "allow_mixed_gender", Validate::filter($data["r_allowMixedGender"]));
    $room->setDetail("boarding_room", "max_people_num", Validate::filter($data["r_maxPeopleNum"]));
    $room->setDetail("boarding_room", "residence_type", Validate::filter($data["r_residenceType"]));
    $room->setDetail("boarding_room", "private_time", Validate::filter($data["r_privateTime"]));
    $room->setDetail("boarding_room", "wall_color", Validate::filter($data["r_wallColor"]));
    $room->setDetail("boarding_room", "balcony", Validate::filter($data["r_balcony"]));
    $room->setDetail("boarding_room", "mezzanine", Validate::filter($data["r_mezzanine"]));
    $room->setDetail("boarding_room", "window", Validate::filter($data["r_window"]));
    $room->setDetail("boarding_room", "images", Validate::filter($data["r_images"]));
    $room->setDetail("boarding_room", "size", Validate::filter($data["r_size"]));
    $room->setDetail("boarding_room", "videos", Validate::filter($data["r_videos"]));
    $room->setDetail("boarding_room", "electricityPrice", Validate::filter($data["r_electricityPrice"]));
    $room->setDetail("boarding_room", "waterPrice", Validate::filter($data["r_waterPrice"]));
    $room->setDetail("boarding_room", "beforeTimeRelease", Validate::filter($data["r_beforeTimeRelease"]));
    $room->save();
 
    $response->status(1);
    $response->message("Phòng đã được thêm thành công");
    $response->data("detail", $room->getDetail());
}

$response->throw();