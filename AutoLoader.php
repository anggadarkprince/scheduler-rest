<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 1/19/15
 * Time: 9:14 PM
 */

spl_autoload_extensions(".php");
spl_autoload_register();

function uri($segment){
    if(isset($_GET['id'])){
        $parts = explode('/', $_GET['id']);
        $part = $parts[$segment-1];;
    }
    else{
        $part = null;
    }
    return $part;
}

function root(){
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https' ? 'https://' : 'http://';

    $path = $_SERVER['PHP_SELF'];

    $path_parts = pathinfo($path);
    $directory = $path_parts['dirname'];

    $directory = ($directory == "/") ? "" : $directory;

    /**
     * @return
     * localhost
     * or mysite.com
     */
    $host = $_SERVER['HTTP_HOST'];

    /**
     * @return
     * http://localhost/mysite
     * or http://mysite.com
     */
    return $protocol.$host.$directory;
}

function transport($destination){
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https' ? 'https://' : 'http://';

    $path = $_SERVER['PHP_SELF'];

    $path_parts = pathinfo($path);
    $directory = $path_parts['dirname'];

    $directory = ($directory == "/") ? "" : $directory;

    $host = $_SERVER['HTTP_HOST'];

    header("location:".$protocol.$host.$directory."/".$destination);
}

