<?php

namespace App;

class Utils {

    public static function transformUnderscoreText($string) {
        $string_arr = explode("_", $string);
        for($i = 0; $i < count($string_arr); $i++) {
            $string_arr[$i] = ucfirst($string_arr[$i]);
        }
        return implode(" ", $string_arr);
    }


}