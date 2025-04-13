<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");

class Validate {

    public static function bool($value) {
        return (($value == 0) || ($value == 1));
    }

    public static function alpha($value, $min, $max) {
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
    
    public static function text_spec($value, $min, $max) {
        if (((strlen((string)$value)) < $min) || ((strlen((string)$value)) > $max)) {
            return false;
        }
        
        return true;
    }
 
}