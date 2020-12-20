<?php
    require_once '../config/conexion.php';


    // Paginado.
    $sql = $bd->query("SELECT * FROM hardwares");
    $resultados = $sql->fetchAll(PDO::FETCH_OBJ);
    $filas = $sql->rowCount();
    $filasXPagina = 10;
    $paginas = $filas / $filasXPagina;

    // Consulta Hardware.    
    if(!$_GET) {
        header('Location:listadoHardware.php?pagina=1');                        
    }
    if($_GET['pagina']>($paginas+1)) {
        header('Location:listadoHardware.php?pagina=1');                        
    }


    $inicio = ($_GET['pagina']-1)*$filasXPagina ;

    $sql = $bd->query("SELECT * FROM hardwares
                            INNER JOIN tipos_hardware ON hardwares.id_tipo = tipos_hardware.id_tipo_hardware
                            INNER JOIN marcas ON hardwares.id_marca  = marcas.id_marca
                            INNER JOIN estados_hardware on hardwares.id_estado_hardware = estados_hardware.id_estado_hardware
                            ORDER BY hardwares.id_hardware
                            LIMIT $inicio , $filasXPagina");
    $hardwares = $sql->fetchAll(PDO::FETCH_OBJ);



?>

<?php include_once "../views/header.php"; ?>
<div class="container-fluid">
    <?php include_once "../views/navbar.php"; ?>

    <section>
        <div class="row my-3 mx-5">
            <div class="col align-middle">
                <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Hardware</h5>
                        <a href="nuevoHardware.php"class="btn btn-success text-light">Nuevo</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row my-3 mx-5">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col"><small class="font-weight-bold">Hardware<small></th>
                                <th scope="col"><small class="font-weight-bold">Modelo<small></th>
                                <th scope="col"><small class="font-weight-bold">Numero de Serie<small></th>
                                <th scope="col"><small class="font-weight-bold">Código Unahur<small></th>
                                <th scope="col"><small class="font-weight-bold">Estado hardware<small></th>
                                <th scope="col"><small class="font-weight-bold">Editar<small></th>
                                <th scope="col"><small class="font-weight-bold">Eliminar<small></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($hardwares as $hardware) { ?>
                                <tr class="shadow-sm">
                                    <td><span class="d-block"><?= $hardware->tipo_hardware; ?></span><small class="text-muted"><?= $hardware->marca; ?></small>
                                    </td>
                                    <td class="align-middle"><span><?= $hardware->modelo; ?></span></td>
                                    <td class="align-middle"><span><?= $hardware->numero_serie; ?></span></td>
                                    <td class="align-middle"><span><?= $hardware->numero_unahur; ?></span></td>
                                    <td class="align-middle"><span><?= $hardware->estado_hardware; ?></span></td>
                                    <td class="align-middle">
                                        <a href="./editarHardware.php?id=<?=$hardware->id_hardware?>">
                                            <span class="badge bg-secondary"><i class="fas fa-pencil-alt"></i></span> 
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a href ="#">
                                            <span class="badge bg-danger text-white"><i class="fas fa-times"></i></span>
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
                        href= "listadoHardware.php?pagina=<?php echo $_GET['pagina']-1 ?>">
                        Anterior
                        </a>
                    </li>
                    
                    <?php for($i=0; $i<$paginas; $i++): ?>
                    <li class="page-item
                    <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
                        <a class="page-link" href="listadoHardware.php?pagina=<?php echo $i+1 ?>">
                            <?php echo $i+1 ?>
                        </a>
                    </li>
                    <?php endfor ?>
                    
                    <li class="page-item
                    <?php echo $_GET['pagina']>=$paginas ? 'disabled' : '' ?> ">
                        <a class="page-link"
                        href= "listadoHardware.php?pagina=<?php echo $_GET['pagina']+1 ?>">
                        Siguiente
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
</div>

<?php include_once "../views/footer.php"; ?>



