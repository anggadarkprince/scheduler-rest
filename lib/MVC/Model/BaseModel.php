<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 1/20/15
 * Time: 1:11 AM
 */

namespace lib\MVC\Model;


use lib\Database\DB;

abstract class BaseModel extends DB{
    public static $host = "localhost";
    public static $database = "framework";
    public static $username = "root";
    public static $password = "";

    public static function getDB(){
        try{
            $connection = new \PDO("mysql:host=".BaseModel::$host.";dbname=".BaseModel::$database,BaseModel::$username,BaseModel::$password);
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $connection;
        }
        catch(\PDOException $error){
            echo $error->getMessage();
            return null;
        }
    }

} 