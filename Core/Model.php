<?php


namespace Core;
use PDO;

abstract class Model
{
    protected static function getDB(){
        static $db = NULL;

        if($db === NULL) {
            $host = '127.0.0.1';
            $user = 'root';
            $pass = '';
            $dbname = 'davefw';

            try{
                $db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$user,$pass);
            } catch (\PDOException $exception) {
                die($exception->getMessage());
            }
        }
        return $db;
    }
}