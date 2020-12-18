<?php

    const SERVER='localhost';
    const DB='prestamo';
    const USER='root';
    const PASS='';

    class Database{
        public static function connect(){
            $db = new mysqli(SERVER, USER, PASS, DB);
            $db->query("SET NAMES 'utf8'");
            return $db;
        }
    }