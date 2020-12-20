<?php

    $dsn = 'mysql:dbname=prestamo;localhost';
    $usuario = "root";
    $password = "";
    $bd = "prestamo";


    try{
        $bd = new PDO(  $dsn,
                        $usuario, 
                        $password);
    } catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
    }