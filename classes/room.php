<?php
// classes/room.php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");

class Room {
    private $id;
    private $price;
    private $detail;
    
    public function  __construct($id = 0) {
        $this->id = $id;

        if ($this->id) {
            $this->detail = json_decode(Database::call("SELECT * FROM `rooms` WHERE `ID` = '".$this->id."'", 1)["detail"], true);
        } else {
            $this->detail = [
                "boarding_house" => [
                    "name" => "", //Private
                    "owner_name" => "", //Private
                    "owner_gender" => "", //premi
                    "owner_phone" => "", //Private
                    "address" => "", //private
                    "road_images" => "", //premium
                    "empty_room_num" => "", // pub
                    "total_room_num" => "", //pub
                    "parking_lot_type" => "", //pub
                    "parking_lot_images" => "", //premi
                    "share_owner" => "", //pub
                    "flooding" => "", //pub
                    "around_size" => "", //pub
                    "contract_duration" => "", //pub
                    "security" => "", // pub
                    "feedback" => "", // pub
                    "extensions" => ""// pub
                ],
                "boarding_room" => [
                    "room_num" => "", //pub
                    "residence_type" => "", //pub
                    "private_time" => "", //premi
                    "wall_color" => "", //pub
                    "balcony" => "", //pub
                    "mezzanine" => "", //pub
                    "window" => "", //pub
                    "pet" => "", // pub
                    "child" => "", // pre
                    "drunk" => "", // pub
                    "allow_mixed_gender" => "", //premi
                    "max_people_num" => "", // pub
                    "images" => "", // pub
                    "size" => "", // pub
                    "videos" => "", // pre
                    "electricity_price" => "", // premi
                    "water_price" => "", // pub
                    "before_time_pelease" => "" // premi
                ]
            ];
        }
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setDetail($level, $key, $val) {
        $this->detail[$level][$key] = $val;
    }

    public function getDetail() {
        return $this->detail;
    }

    public function isDuplicated() {
        return !empty(Database::call("SELECT * FROM `rooms` WHERE JSON_EXTRACT(detail, '$.boarding_house.name') = '".$this->detail["boarding_house"]["name"]."' AND JSON_EXTRACT(detail, '$.boarding_house.address') = '".$this->detail["boarding_house"]["address"]."'", 1)["ID"]);
    }

    public function save() {
        if ($this->id) {
            Database::call("UPDATE `rooms` SET
                `h_name` = '".$this->detail["boarding_house"]["name"]."',
                `h_owner_name` = '".$this->detail["boarding_house"]["owner_name"]."',
                `h_owner_gender` = '".$this->detail["boarding_house"]["owner_gender"]."',
                `h_owner_phone` = '".$this->detail["boarding_house"]["owner_phone"]."',
                `h_address` = '".$this->detail["boarding_house"]["address"]."',
                `h_road_images` = '".$this->detail["boarding_house"]["road_images"]."',
                `h_empty_room_num` = '".$this->detail["boarding_house"]["empty_room_num"]."',
                `h_total_room_num` = '".$this->detail["boarding_house"]["total_room_num"]."',
                `h_parking_lot_type` = '".$this->detail["boarding_house"]["parking_lot_type"]."',
                `h_parking_lot_images` = '".$this->detail["boarding_house"]["parking_lot_images"]."',
                `h_share_owner` = '".$this->detail["boarding_house"]["share_owner"]."',
                `h_flooding` = '".$this->detail["boarding_house"]["flooding"]."',
                `h_around_size` = '".$this->detail["boarding_house"]["around_size"]."',
                `h_security` = '".$this->detail["boarding_house"]["security"]."',
                `h_contract_duration` = '".$this->detail["boarding_house"]["contract_duration"]."',
                `h_feedback` = '".$this->detail["boarding_house"]["feedback"]."',
                `h_extensions` = '".$this->detail["boarding_house"]["extensions"]."',
                `r_room_num` = '".$this->detail["boarding_room"]["room_num"]."',
                `r_residence_type` = '".$this->detail["boarding_room"]["residence_type"]."',
                `r_private_time` = '".$this->detail["boarding_room"]["private_time"]."',
                `r_wall_color` = '".$this->detail["boarding_room"]["wall_color"]."',
                `r_balcony` = '".$this->detail["boarding_room"]["balcony"]."',
                `r_mezzanine` = '".$this->detail["boarding_room"]["mezzanine"]."',
                `r_window` = '".$this->detail["boarding_room"]["window"]."',
                `r_pet` = '".$this->detail["boarding_room"]["pet"]."',
                `r_child` = '".$this->detail["boarding_room"]["child"]."',
                `r_drunk` = '".$this->detail["boarding_room"]["drunk"]."',
                `r_allow_mixed_gender` = '".$this->detail["boarding_room"]["allow_mixed_gender"]."',
                `r_max_people_num` ='".$this->detail["boarding_room"]["max_people_num"]."',
                `r_images` = '".$this->detail["boarding_room"]["images"]."',
                `r_size` = '".$this->detail["boarding_room"]["size"]."',
                `r_videos` = '".$this->detail["boarding_room"]["videos"]."',
                `r_electricity_price` = '".$this->detail["boarding_room"]["electricity_price"]."',
                `r_water_price` = '".$this->detail["boarding_room"]["water_price"]."',
                `r_before_time_release` = '".$this->detail["boarding_room"]["before_time_release"]."'
            WHERE `ID` = '".$this->id."'");
        } else {
            Database::call("INSERT INTO `rooms`
            (
                `h_name`,
                `h_owner_name`,
                `h_owner_gender`,
                `h_owner_phone`,
                `h_address`,
                `h_road_images`,
                `h_empty_room_num`,
                `h_total_room_num`,
                `h_parking_lot_type,
                `h_parking_lot_images`,
                `h_share_owner`,
                `h_flooding`,
                `h_around_size`,
                `h_security`,
                `h_contract_duration`,
                `h_feedback`,
                `h_extensions`,
                `r_room_num`,
                `r_residence_type`,
                `r_private_time`,
                `r_wall_color`,
                `r_balcony`,
                `r_mezzanine`,
                `r_window`,
                `r_child`,
                `r_drunk`,
                `r_allow_mixed_gender`,
                `r_max_people_num`,
                `r_images`,
                `r_size`,
                `r_videos`,
                `r_electricity_price`,
                `r_water_price`,
                `r_before_time_release`
            )
                VALUES
            (
                '".$this->detail["boarding_house"]["name"]."',
                '".$this->detail["boarding_house"]["owner_name"]."',
                '".$this->detail["boarding_house"]["owner_gender"]."',
                '".$this->detail["boarding_house"]["owner_phone"]."',
                '".$this->detail["boarding_house"]["address"]."',
                '".$this->detail["boarding_house"]["road_images"]."',
                '".$this->detail["boarding_house"]["empty_room_num"]."',
                '".$this->detail["boarding_house"]["total_room_num"]."',
                '".$this->detail["boarding_house"]["parking_lot_type"]."',
                '".$this->detail["boarding_house"]["parking_lot_images"]."',
                '".$this->detail["boarding_house"]["share_owner"]."',
                '".$this->detail["boarding_house"]["flooding"]."',
                '".$this->detail["boarding_house"]["around_size"]."',
                '".$this->detail["boarding_house"]["security"]."',
                '".$this->detail["boarding_house"]["contract_duration"]."',
                '".$this->detail["boarding_house"]["feedback"]."',
                '".$this->detail["boarding_house"]["extensions"]."',
                '".$this->detail["boarding_room"]["room_num"]."',
                '".$this->detail["boarding_room"]["residence_type"]."',
                '".$this->detail["boarding_room"]["private_time"]."',
                '".$this->detail["boarding_room"]["wall_color"]."',
                '".$this->detail["boarding_room"]["balcony"]."',
                '".$this->detail["boarding_room"]["mezzanine"]."',
                '".$this->detail["boarding_room"]["window"]."',
                '".$this->detail["boarding_room"]["pet"]."',
                '".$this->detail["boarding_room"]["child"]."',
                '".$this->detail["boarding_room"]["drunk"]."',
                '".$this->detail["boarding_room"]["allow_mixed_gender"]."',
                '".$this->detail["boarding_room"]["max_people_num"]."',
                '".$this->detail["boarding_room"]["images"]."',
                '".$this->detail["boarding_room"]["size"]."',
                '".$this->detail["boarding_room"]["videos"]."',
                '".$this->detail["boarding_room"]["electricity_price"]."',
                '".$this->detail["boarding_room"]["water_price"]."',
                '".$this->detail["boarding_room"]["before_time_release"]."'
            )", 0);
        }
    }

    public function getDetailList($fields) {
        $detail = $this->detail;

        foreach ($detail as $type => $level) {
            foreach ($level as $field => $val) {
                if (!in_array($field, $fields[$type])) {
                    unset($detail[$type][$field]);
                }
            }
        }

        return $detail;
    }

    public function getPublicDetails() {
        return $this->getDetailList(
            [
                "boarding_house" => [
                    "empty_room_num",
                    "total_room_num",
                    "parking_lot_type", 
                    "share_owner",
                    "flooding",
                    "around_size",
                    "contract_duration",
                    "security",
                    "feedback",
                    "extensions"
                ],
                "boarding_room" => [
                    "room_num",
                    "residence_type",
                    "wall_color",
                    "balcony",
                    "mezzanine",
                    "window",
                    "pet",
                    "drunk",
                    "max_people_num",
                    "images",
                    "size",
                    "water_pprice"
                ]
            ]
        );
    }

    public function getPremiumDetails() {
        return $this->getDetailList(
            [
                "boarding_house" => [ 
                    "owner_gender", 
                    "road_images",
                    "empty_room_num",
                    "total_room_num",
                    "parking_lot_type",
                    "parking_lot_images",
                    "share_owner",
                    "flooding",
                    "around_size",
                    "contract_duration",
                    "security",
                    "feedback",
                    "extensions",
                ],
                "boarding_room" => [
                    "room_num",
                    "residence_type",
                    "private_time",
                    "wall_color",
                    "balcony",
                    "mezzanine",
                    "window",
                    "pet",
                    "child",
                    "drunk",
                    "allow_mixed_gender",
                    "max_people_num",
                    "images",
                    "size",
                    "videos",
                    "electricity_pprice",
                    "water_pprice",
                    "before_time_release"
                ]
            ]
        );
    }

    public function getPrivateDetails() {
        return $this->getDetailList(
            [
                "boarding_house" => [
                    "name",
                    "owner_name",
                    "owner_phone",
                    "address"
                ],
                "boarding_room" => [
                ]
            ]
        );
    }
}

/*
(
    `h_name`,
    `h_owner_name`,
    `h_owner_gender`,
    `h_owner_phone`,
    `h_address`,
    `h_road_images`,
    `h_empty_room_num`,
    `h_total_room_num`,
    `h_parking_lot_type,
    `h_parking_lot_images`,
    `h_share_owner`,
    `h_flooding`,
    `h_around_size`,
    `h_security`,
    `h_contract_duration`,
    `h_feedback`,
    `h_extensions`,
    `r_room_num`,
    `r_residence_type`,
    `r_private_time`,
    `r_wall_color`,
    `r_balcony`,
    `r_mezzanine`,
    `r_window`,
    `r_child`,
    `r_drunk`,
    `r_allow_mixed_gender`,
    `r_max_people_num`,
    `r_images`,
    `r_size`,
    `r_videos`,
    `r_electricity_price`,
    `r_water_price`,
    `r_before_time_release`,
)
    VALUES
(
    '".$this->detail["boarding_house"]["name"]."',
    '".$this->detail["boarding_house"]["owner_name"]."',
    '".$this->detail["boarding_house"]["owner_gender"]."',
    '".$this->detail["boarding_house"]["owner_phone"]."',
    '".$this->detail["boarding_house"]["address"]."',
    '".$this->detail["boarding_house"]["road_images"]."',
    '".$this->detail["boarding_house"]["empty_room_num"]."',
    '".$this->detail["boarding_house"]["total_room_num"]."',
    '".$this->detail["boarding_house"]["parking_lot_type"]."',
    '".$this->detail["boarding_house"]["parking_lot_images"]."',
    '".$this->detail["boarding_house"]["share_owner"]."',
    '".$this->detail["boarding_house"]["flooding"]."',
    '".$this->detail["boarding_house"]["around_size"]."',
    '".$this->detail["boarding_house"]["security"]."',
    '".$this->detail["boarding_house"]["contract_duration"]."',
    '".$this->detail["boarding_house"]["feedback"]."',
    '".$this->detail["boarding_house"]["extensions"]."',

    '".$this->detail["boarding_room"]["room_num"]."',
    '".$this->detail["boarding_room"]["residence_type"]."',
    '".$this->detail["boarding_room"]["private_time"]."',
    '".$this->detail["boarding_room"]["wall_color"]."',
    '".$this->detail["boarding_room"]["balcony"]."',
    '".$this->detail["boarding_room"]["mezzanine"]."',
    '".$this->detail["boarding_room"]["window"]."',
    '".$this->detail["boarding_room"]["pet"]."',
    '".$this->detail["boarding_room"]["child"]."',

    '".$this->detail["boarding_room"]["drunk"]."',
    '".$this->detail["boarding_room"]["allow_mixed_gender"]."',
    '".$this->detail["boarding_room"]["max_people_num"]."',
    '".$this->detail["boarding_room"]["images"]."',
    '".$this->detail["boarding_room"]["size"]."',
    '".$this->detail["boarding_room"]["videos"]."',
    '".$this->detail["boarding_room"]["electricity_price"]."',
    '".$this->detail["boarding_room"]["water_price"]."',
    '".$this->detail["boarding_room"]["before_time_release"]."',
    
)

*/