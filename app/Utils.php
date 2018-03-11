<?php

class Utils {

    function underscoreToPlain($string) {
        $string = str_replace($string, "_", " ");
        $string = strtolower($string);
        $stringArray = explode(" ", $string);

        forEach($stringArray as $s) {
            $s = ucfirst($s);
        }

        dd($stringArray);
    }


}