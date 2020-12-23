<?php

if (!isset($_POST['id_hardware'])) {
    echo 'No existe ID';
}else{

    include '../config/conexion.php';

    $id_hardware = $_POST['id_hardware'];
    $id_tipo = $_POST['id_tipo_hardware'];
    $id_marca = $_POST['id_marca'];
    $id_estado_hardware = $_POST['id_estado_hardware'];
    $descripcion = $_POST['descripcion'];
    $modelo = $_POST['modelo'];
    $numero_serie = $_POST['numero_serie'];
    $numero_unahur = $_POST['codigo_unahur'];           

    $sql = $bd->prepare("UPDATE hardwares
                            SET id_tipo = ?,
                                id_marca = ?, 
                                id_estado_hardware = ?,
                                descripcion = ?, 
                                modelo = ?,
                                numero_serie = ?,
                                numero_unahur = ?
                            WHERE id_hardware = ?
                                ");
    
    $resultado = $sql->execute([$id_tipo,
                                $id_marca,
                                $id_estado_hardware,
                                $descripcion,
                                $modelo,
                                $numero_serie,
                                $numero_unahur,
                                $id_hardware]);

    if ($resultado === TRUE) {
        header ("Location: ../pages/listadoHardware.php");
    }else{    
        echo 'Error al editar Hardware';
    }
    
}