<?php


IF (!isset($_POST['id_tipo_hardware'])) {
    echo "no hay datos";
}

print_r($_POST);

include '../config/conexion.php';

$id_tipo = $_POST['id_tipo_hardware'];
$id_marca = $_POST['id_marca'];
$id_estado_hardware = $_POST['id_estado_hardware'];
$descripcion = $_POST['descripcion'];
$modelo = $_POST['modelo'];
$numero_serie = $_POST['numero_serie'];
$numero_unahur = $_POST['codigo_unahur'];


$sql = $bd->prepare("INSERT INTO hardwares(  id_tipo, 
                                            id_marca,
                                            id_estado_hardware,
                                            descripcion,
                                            modelo,
                                            numero_serie,
                                            numero_unahur) 
                            VALUES(?,?,?,?,?,?,?);");

$resultado = $sql->execute([$id_tipo,
                            $id_marca,
                            $id_estado_hardware,
                            $descripcion,
                            $modelo,
                            $numero_serie,
                            $numero_unahur]);

if ($resultado === TRUE) {
    header ("Location: ../pages/listadoHardware.php");
}else{    
    echo 'Error al agregar Hardware';
}




