<?php
class config{
    public static function get($string) {
        list($array_name, $variable) = explode('|', $string);
        if (isset($GLOBALS['config'][$array_name][$variable])) {
            return $GLOBALS['config'][$array_name][$variable];
        } else {
            return null;
        }
    }
}