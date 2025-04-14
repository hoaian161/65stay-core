<?php
// lib/validate.php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");

class Validate {

    public static function bool($value) {
        return ($value === "1" || $value === "0");
    }

    public static function alpha($value, $min, $max) {
        $value = Validate::base($value);
        $length = strlen((string)$value);

        if ($length < $min || $length > $max){
            return false;
        }

        return ctype_alpha($value);
    }
    
    public static function number($value, $minRange, $maxRange, $minLength, $maxLength) {
        $length = strlen((string)$value);

        if (is_numeric($value) && ($length >= $minLength && $length <= $maxLength)) {
            if ($value >= $minRange && $value <= $maxRange) {
                return true;
            }
        }

        return false;
    }
    
    public static function alnum($value, $min, $max) {
        $value = Validate::base($value);
        
        if (((strlen((string)$value)) < $min) || ((strlen((string)$value)) > $max)) {
            return false;
        }
        
        return ctype_alnum($value);
    }

    public static function integer($value, $minRange, $maxRange, $minLength, $maxLength) {
        $length = strlen((string)$value);

        if (is_numeric($value) && ($length >= $minLength && $length <= $maxLength)) {
            if (($value >= $minRange) && ($value <= $maxRange) && ($value == floor($value))) {
                return true;
            }
        }

        return false;
    }
    
    public static function textSpecial($value, $min, $max) {
        if (((strlen((string)$value)) < $min) || ((strlen((string)$value)) > $max)) {
            return false;
        }
        
        return true;
    }

    public static function filter($value) {
        return str_replace(["'", '"'], "", $value);
    }

    public static function base($value, $allowSpace = false) {
        $vietnamese = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ', 'D' => 'Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
        ];
    
        foreach ($vietnamese as $nonAccent => $accent) {
            $value = preg_replace("/$accent/u", $nonAccent, $value);
        }
    
        return str_replace(" ", ($allowSpace ? " " : ""), $value);
    }
}