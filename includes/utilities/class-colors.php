<?php
/**
 * Colors Utility
 * 
 * @package mintfaq
 * @since 2.0.0
 */
namespace Mintfaq\Utilities;

/**
 * Colors utility class
 * 
 * @since 2.0.0
 */
class Colors {

    public static function add_to_color($color = "", $addition = 10) {
        $color = self::is_valid($color);

        if (empty($color)) {
            return NULL;
        }

        $r = hexdec(self::get_r($color));
        $g = hexdec(self::get_g($color));
        $b = hexdec(self::get_b($color));

        $figure = self::get_percentage($addition);

        $r = $r + $figure;
        $g = $g + $figure;
        $b = $b + $figure;

        if ($r > 255) {
            $r = 255;
        }
        if ($b > 255) {
            $b = 255;
        }
        if ($g > 255) {
            $g = 255;
        }

        return "#" . strtoupper(str_pad(dechex($r), 2, 0, STR_PAD_LEFT) . str_pad(dechex($g), 2, 0, STR_PAD_LEFT) . str_pad(dechex($b), 2, 0, STR_PAD_LEFT));
    }

    public static function subtract_from_color($color = "", $addition = 10) {

        $color = self::is_valid($color);

        if (empty($color)) {
            return NULL;
        }

        $r = hexdec(self::get_r($color));
        $g = hexdec(self::get_g($color));
        $b = hexdec(self::get_b($color));

        $figure = self::get_percentage($addition);

        $r = $r - $figure;
        $g = $g - $figure;
        $b = $b - $figure;

        if ($r < 0) {
            $r = 0;
        }
        if ($b < 0) {
            $b = 0;
        }
        if ($g < 0) {
            $g = 0;
        }

        return "#" . strtoupper(str_pad(dechex($r), 2, 0, STR_PAD_LEFT) . str_pad(dechex($g), 2, 0, STR_PAD_LEFT) . str_pad(dechex($b), 2, 0, STR_PAD_LEFT));
    }

    public static function is_valid($color) {
        if (is_string($color) || is_integer($color)) {
            $color = str_replace(array(" ", "#"), "", $color);
            if ((strlen($color) == 6) && ctype_xdigit($color)) {
                return strtoupper($color);
            }
        }

        return FALSE;
    }

    public static function get_r($color) {
        return substr($color, 0, 2);
    }

    public static function get_g($color) {
        return substr($color, 2, 2);
    }

    public static function get_b($color) {
        return substr($color, 4, 2);
    }

    public static function get_percentage($d = 0) {
        return floor(255 * ($d / 100));
    }

    public static function lighten_the_color($color, $addition = 10) {
        return self::add_to_color($color, $addition);
    }

    public static function gain_the_color($color, $addition = 10) {
        return self::subtract_from_color($color, $addition);
    }

}