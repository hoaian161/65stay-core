<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/classes/room.php");

$response = new Response();
$room = new Room();

$data = $_POST;

if (!Validate::alnum($data["h_name"], 1, 50)) {
    $response->message("Tên trọ phải có độ dài từ 1 - 25 ký tự, không chứa ký tự đặc biệt");
} else if (!Validate::alpha($data["h_ownerName"], 1, 25)) {
    $response->message("Tên chủ trọ phải có độ dài từ 1 - 25 ký tự, không chứa kí tự đặc biệt và số");
} else if (!Validate::bool($data["h_ownerGender"])) {
    $response->message("Tùy chọn giới tính là bắt buộc");
} else if (!Validate::number($data["h_ownerPhone"], 10, 11, 2 , 2)) {
    $response->message("Số điện thoại chủ trọ phải có độ dài từ 10 - 11 số");
} else if (!Validate::text_spec($data["h_address"], 1, 255)) {
    $response->message("Địa chỉ là bắt buộc");
} else if (!Validate::text_spec($data["h_roadImages"], 1, 255)) {
    $response->message("Đường dẫn hình ảnh đường xáxá là bắt buộc");
} else if (!Validate::number($data["h_emptyRoomNum"], 1, 99, 1, 2)) {
    $response->message("Số phòng trống phải là số từ 1 - 99");
} else if (!Validate::number($data["h_totalRoomNum"], 1, 100, 1, 2)) {
    $response->message("Tổng số phòng phải là số từ 1 - 100");
} else if (!Validate::alpha($data["h_parkingLotType"], 1, 50)) {
    $response->message("Loại bãi đỗ xe phải có độ dài từ 1 đến 50 ký tự, không chứa kí tự đặc biệt và số");
} else if (!Validate::text_spec($data["h_parkingLotImages"], 1, 255)) {
    $response->message("Đường dẫn hình ảnh bãi đỗ xe là bắt buộc");
} else if (!Validate::bool($data["h_shareOwner"])) {
    $response->message("Tùy chọn chung chủ là bắt buộc"); 
} else if (!Validate::bool($data["h_flooding"])) {
    $response->message("Tùy chọn ngập nước là bắt buộc"); 
} else if (!Validate::number($data["h_aroundSize"], 1, 1000, 1, 5)) {
    $response->message("Diện tích lối vào không hợp lệ"); 
} else if (!Validate::integer($data["h_contractDuration"], 0, 60, 1, 2)) {
    $response->message("Thời hạn hợp đồng phải là số từ 0 - 60 (tháng)"); 
} else if (!Validate::text_spec($data["h_security"], 1, 255)) {
    $response->message("Thông tin về an ninh là bắt buộc"); 
} else if (!Validate::text_spec($data["h_feedback"], 1, 255)) {
    $response->message("Phản hồi có độ dài từ 1 đến 255 ký tự"); 
} else if (!Validate::text_spec($data["h_extensions"], 1, 255)) {
    $response->message("Thông tin tiện ích (ví dụ: máy lạnh, tủ lạnh, ...)"); 
} else if (!Validate::alpha($data["r_residenceType"], 1, 50)) {
    $response->message("Dạng cư trú bắt buộc từ 1 - 50 chữ cái");
} else if (!Validate::alnum($data["r_privateTime"], 1, 25)) {
    $response->message("Thời gian ra vào là bắt buộc"); 
} else if (!Validate::alpha($data["r_wallColor"], 1, 50)) {
    $response->message("Màu tường là bắt buộc"); 
} else if (!Validate::bool($data["r_balcony"])) {
    $response->message("Tuỳ chọn ban công là bắt buộc"); 
} else if (!Validate::alpha($data["r_mezzanine"], 1, 50)) {
    $response->message("Gác lửng là bắt buộc"); 
} else if (!Validate::alpha($data["r_window"], 1, 50)) {
    $response->message("Cửa sổ là bắt buộc");
} else if (!Validate::bool($data["r_pet"])) {
    $response->message("Tuỳ chọn nuôi thú cưng là bắt buộc"); 
} else if (!Validate::bool($data["r_child"])) {
    $response->message("Tuỳ chọn nuôi trẻ con là bắt buộc"); 
} else if (!Validate::bool($data["r_drunk"])) {
    $response->message("Tuỳ chọn tụ tập, uống rượu bia là bắt buộc"); 
} else if (!Validate::bool($data["r_allowMixedGender"])) {
    $response->message("Tuỳ chọn cho tụ tập, uống rượu bia là bắt buộc"); 
} else if (!Validate::integer($data["r_maxPeopleNum"], 1, 10, 1, 2)) {
    $response->message("Số lượng người ở phải từ 1 - 10 người"); 
} else if (!Validate::text_spec($data["r_images"], 1, 255)) {
    $response->message("Đường dẫn hình ảnh phòng là bắt buộc");
} else if (!Validate::number($data["r_size"], 1, 1000, 1, 5)) {
    $response->message("Diện tích phòng không hợp lệ");
} else if (!Validate::text_spec($data["r_videos"], 1, 255)) {
    $response->message("Đường dẫn video phòng là bắt buộc");
} else if (!Validate::number($data["r_electricityPrice"], 0, 1000000, 0, 6)) {
    $response->message("Số tiền không hợp lệ");
} else if (!Validate::number($data["r_waterPrice"], 0, 100000, 0, 6)) {
    $response->message("Số tiền không hợp lệ");
} else if (!Validate::integer($data["r_beforeTimeRelease"], 0, 12, 0, 2)) {
    $response->message("Thời gian trước khi trả phòng không hợp lệ");
}

$response->throw();