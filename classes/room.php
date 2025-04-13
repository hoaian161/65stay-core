<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");

class Room {
    private $code;
    private $price;
    private $detail;
    
    
    public function  __construct() {
        $this->detail = [
            "boarding_house" => [
                "name" => "",
                "owner_name" => "",
                "owner_gender" => "",
                "owner_phone" => "",
                "address" => "",
                "road_images" => "",
                "empty_room_num" => "",
                "total_room_num" => "",
                "parking_lot_type" => "",
                "parking_lot_images" => "",
                "share_owner" => "",
                "flooding" => "",
                "around_size" => "",
                "contract_duration" => "",
                "sercurity" => "",
                "feedback" => "",
                "extensions" => "",
            ],
            "boarding_room" => [
                "room_num" => "",
                "residence_type" => "",
                "private_time" => "",
                "wall_color" => "",
                "balcony" => "",
                "mezzanine" => "",
                "window" => "",
                "pet" => "",
                "child" => "",
                "drunk" => "",
                "allow_mixed_gender" => "",
                "max_people_num" => "",
                "images" => "",
                "size" => "",
                "videos" => "",
                "electricityPrice" => "",
                "waterPrice" => "",
                "beforeTimeRelease" => ""
            ]
        ];
    }

    public function getDetail() {
        return $this->detail;
    }

    public function setDetail($level, $key, $val) {
        $this->detail[$level][$key] = $val;
    }
}