<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 1/21/15
 * Time: 7:25 AM
 */

namespace models;


class Utils
{
    public static function prettyPrint($var)
    {
        //echo '<pre>';
        print_r($var);
        //echo '</pre>';
    }

    public static function dumpVar($var, $title)
    {
        echo '<pre>';
        echo '<h1>' . $title . '</h1>';
        var_dump($var);
        echo '</pre>';
    }
}
