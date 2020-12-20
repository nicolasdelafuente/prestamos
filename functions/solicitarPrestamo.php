<?php


IF (!isset($_POST['id_tipo_hardware'])) {
    echo "no hay datos";
}


include '../config/conexion.php';


$id_tipo = $_POST['id_tipo_hardware'];
$id_usuario = $_POST['id_usuario'];
$fecha_desde = $_POST['fecha_desde'];
$fecha_hasta = $_POST['fecha_hasta'];
$id_edificio = $_POST['id_edificio'];
$motivo = $_POST['motivo'];


$sql = $bd->prepare("INSERT INTO solicitudes(  id_tipo_hardware,
                                            id_usuario,
                                            fecha_desde,
                                            fecha_hasta,                                       
                                            id_edificio,
                                            motivo)
                            VALUES(?,?,?,?,?,?);");

$resultado = $sql->execute([$id_tipo,
                            $id_usuario,
                            $fecha_desde,
                            $fecha_hasta,
                            $id_edificio,
                            $motivo,]);

if ($resultado === TRUE) {
    header ("Location: ../pages/main.php");
}else{    
    echo 'Error al agregar Hardware';
}




