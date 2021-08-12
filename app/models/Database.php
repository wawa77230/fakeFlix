<?php

abstract class Database
{
    private static $pdo;
    private static function setBdd(){
        self::$pdo = new PDO( "mysql:host=localhost;dbname=fakeflix; 
             charset=UTF8",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
            ]);
    }
    protected function getBdd(){
        if (self::$pdo === null){
            self::setBdd();
        }
        return self::$pdo;
    }
}