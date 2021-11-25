<?php

/**
 * Class Utils
 */
class Utils {

    /**
     * @param $date
     * @return string
     */
    public static function parseDate($date) {
        $date = explode('-', $date);
        return $date[2].'/'.$date[1].'/'.$date[0];
    }

    /**
     * @param $date
     * @return string
     */
    public static function unparseDate($date) {
        $date = explode('/', $date);
        return $date[2].'-'.$date[1].'-'.$date[0];
    }
}