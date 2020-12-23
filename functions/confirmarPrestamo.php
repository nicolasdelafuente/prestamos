<?php



include '../config/conexion.php';

$numero_serie = $_POST['numero_serie'];

$sql = $bd->prepare("SELECT * FROM hardwares WHERE numero_serie=:numero_serie");
$sql->execute(['numero_serie' => $numero_serie]); 
$resultado = $sql->fetch();

$id_hardware = $resultado[0];
$id_solicitud = $_POST['id_solicitud'];
$id_estado_solicitud = 1;



$sql = $bd->prepare("UPDATE solicitudes
                            SET id_estado_solicitud = ?
                            WHERE id_solicitud = ?
                                ");

$resultado = $sql->execute([$id_estado_solicitud,
                            $id_solicitud]);  

if ($resultado === TRUE) {
echo 'Se modifico solicitud';
}else{    
echo 'Error al modificar solicitud';
}


$sql = $bd->prepare("INSERT INTO prestamos(  id_solicitud, 
                                            id_hardware) 
                            VALUES(?,?);");

$resultado = $sql->execute([$id_solicitud,
                            $id_hardware]);

if ($resultado === TRUE) {
    echo 'Se creo prestamo';
}else{    
    echo 'Error al crear prestamo';
}