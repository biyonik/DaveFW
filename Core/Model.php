<?php


namespace Core;
use PDO;
use App\Config;
abstract class Model
{
    protected static function getDB(){
        static $db = NULL;

        if($db === NULL) {
            try{
                $db = new PDO('mysql:host='.Config::DB_HOST.';dbname='.Config::DB_NAME.';charset='.Config::DB_CHARSET,Config::DB_USER,Config::DB_PASS);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $exception) {
                die($exception->getMessage());
            }
        }
        return $db;
    }
}