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
                    "electricityPrice" => "", // premi
                    "waterPrice" => "", // pub
                    "beforeTimeRelease" => "" // premi
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
            Database::call("UPDATE `rooms` SET `price` = '".$this->price."',` detail` = ".json_encode($this->detail)." WHERE `ID` = '".$this->id."'");
        } else {
            Database::call("INSERT INTO `rooms` (`price`, `detail`) VALUES ('".$this->price."', '".json_encode($this->detail)."')", 0);
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
                    "waterPrice"
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
                    "electricityPrice",
                    "waterPrice",
                    "beforeTimeRelease"
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