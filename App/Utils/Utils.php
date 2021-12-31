<?php

namespace App\Utils;

class Utils {

    /**
     * Methode pour parser une date
     *
     * EX : 2021-10-31 -> 31/10/2021
     *
     * @param $date
     * @return string
     */
    public static function parseDate($date) {
        $date = explode('-', $date);
        return $date[2].'/'.$date[1].'/'.$date[0];
    }

    /**
     * Methode pour deparser une date
     *
     * EX : 31/10/2021 -> 2021-10-31
     *
     * @param $date
     * @return string
     */
    public static function unparseDate($date) {
        $date = explode('/', $date);
        return $date[2].'-'.$date[1].'-'.$date[0];
    }

    public static function parsePrice($price) {

    }
}