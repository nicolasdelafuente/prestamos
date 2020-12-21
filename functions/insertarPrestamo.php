<?php


IF (!isset($_POST['numeror_serie'])) {
    echo "No se especificó numero de serie.";
}


include '../config/conexion.php';

$id_solicitud = $_POST['id_solicitud'];
$id_hardware = $_POST['id_hardware'];



$sql = $bd->prepare("INSERT INTO prestamos(  id_solicitud, 
                                            id_hardware) 
                            VALUES(?,?);");

$resultado = $sql->execute([$id_solicitud,
                            $id_hardware]);

if ($resultado === TRUE) {
    header ("Location: ../pages/listadoHardware.php");
}else{    
    echo 'Error al agregar Hardware';
}