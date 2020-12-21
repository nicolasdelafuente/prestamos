<?php
    require_once '../config/conexion.php';


    // Paginado.
    $sql = $bd->query("SELECT * FROM solicitudes");
    $resultados = $sql->fetchAll(PDO::FETCH_OBJ);
    $filas = $sql->rowCount();
    $filasXPagina = 10;
    $paginas = $filas / $filasXPagina;

    // Consulta Hardware.    
    if(!$_GET) {
        header('Location:listadoSolicitud.php?pagina=1');                        
    }
    if($_GET['pagina']>($paginas+1)) {
        header('Location:listadoSolicitud.php?pagina=1');                        
    }


    $inicio = ($_GET['pagina']-1)*$filasXPagina ;

    $sql = $bd->query("SELECT * FROM solicitudes
                            INNER JOIN usuarios ON solicitudes.id_usuario  = usuarios.id_usuario
                            INNER JOIN tipos_hardware ON solicitudes.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                            INNER JOIN edificios ON solicitudes.id_edificio = edificios.id_edificio
                            INNER JOIN estados_solicitud ON solicitudes.id_estado_solicitud = estados_solicitud.id_estado_solicitud
                            ORDER BY solicitudes.fecha_desde
                            LIMIT $inicio , $filasXPagina");
    $solicitudes = $sql->fetchAll(PDO::FETCH_OBJ);
?>



<?php     
/* Para ver los numeros de serie */
    function serie($idTipo) {
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

        $sql = $bd->query("SELECT * FROM hardwares WHERE id_tipo = $idTipo ORDER BY numero_serie");
        return $hardwares = $sql->fetchAll(PDO::FETCH_OBJ);
    }
?>

<?php include_once "../views/header.php"; ?>
<div class="container-fluid">
    <?php include_once "../views/navbar.php"; ?>

    <section>
        <div class="row my-3 mx-5">
            <div class="col align-middle">
                <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Confirmación de solicitudes</h5>
                    </div>
                </div>
            </div>
        </div>

        <?php serie(3); ?>

        <div class="row my-3 mx-5">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col"><small class="font-weight-bold">Solicitante<small></th>
                                <th scope="col"><small class="font-weight-bold">Tipo<small></th>
                                <th scope="col"><small class="font-weight-bold">Edificio<small></th>
                                <th scope="col"><small class="font-weight-bold">Período<small></th>
                                <th scope="col"><small class="font-weight-bold">Estado<small></th>
                                <th colspan=2 scope="col"><small class="font-weight-bold">Numero Serie<small></th>
                                <th scope="col"><small class="font-weight-bold">Editar<small></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($solicitudes as $solicitud) { ?>
                                <tr class="shadow-sm">
                                    <td><span class="d-block"><?= $solicitud->apellido; ?></span><small class="text-muted"><?= $solicitud->nombre; ?></small>
                                    </td>
                                    <td class="align-middle"><span><?= $solicitud->tipo_hardware; ?></span></td>
                                    <td class="align-middle"><span><?= $solicitud->edificio; ?></span></td>
                                    <td><span class="d-block">desde: <small class="text-muted"><?= $solicitud->fecha_hasta; ?></small><span class="d-block">hasta: <small class="text-muted"><?= $solicitud->fecha_hasta; ?></small>
                                    </td>
                                    <td class="align-middle"><span><?= $solicitud->estado_solicitud; ?></span></td>
                                    <td class="align-middle">
                                        <span>
                                            <select class="form-select" name="numero_serie" required>
                                                <option disabled selected>Selecciona una opción</option>
                                                <?php foreach(serie($solicitud->id_tipo_hardware) as $hardware) { ?>
                                                <option
                                                    value="<?= $hardware->numero_serie ?>"><?= $hardware->numero_serie ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <span>
                                            <a href="./confirmarPrestamo.php?id=<?=$solicitudes->id_hardware?>">
                                                <span class="badge bg-success"><i class="fas fa-check"></i></span> 
                                            </a>
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="./editarSolicitud.php?id=<?=$solicitudes->id_hardware?>">
                                            <span class="badge bg-secondary"><i class="fas fa-pencil-alt"></i></span> 
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--Paginado-->                                
        <div class="row justify-content-center mt-1">
            <nav class="col align-self-center">
                <ul class="pagination">
                    <li class="page-item
                    <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?> ">
                        <a class="page-link"
                        href= "confirmarPrestamo.php?pagina=<?php echo $_GET['pagina']-1 ?>">
                        Anterior
                        </a>
                    </li>
                    
                    <?php for($i=0; $i<$paginas; $i++): ?>
                    <li class="page-item
                    <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
                        <a class="page-link" href="listadoSolicitud.php?pagina=<?php echo $i+1 ?>">
                            <?php echo $i+1 ?>
                        </a>
                    </li>
                    <?php endfor ?>
                    
                    <li class="page-item
                    <?php echo $_GET['pagina']>=$paginas ? 'disabled' : '' ?> ">
                        <a class="page-link"
                        href= "listadoSolicitud.php?pagina=<?php echo $_GET['pagina']+1 ?>">
                        Siguiente
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
</div>

<?php include_once "../views/footer.php"; ?>



