<!-- ------- -->
<?php
if (isset($_SESSION['editHardware']) && $_SESSION['editHardware'] == 'complete'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-info" role="alert">
			<i class="far fa-smile fa-2x mx-2"></i>Tu hardware se ha editado correctamente. 
		</div>
	</div>
<?php elseif(isset($_SESSION['editHardware']) && $_SESSION['editHardware'] == 'failed'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-danger" role="alert">
			<i class="far fa-angry fa-2x mx-2"></i> <strong>Edicion fallida</strong>, intenta nuevamente. 
		</div>
	</div>
<?php endif;?>
<?php Utils::deleteSession('editHardware');?>

<!-- ------- -->
<?php
if (isset($_SESSION['hardwareRegistrado']) && $_SESSION['hardwareRegistrado'] == 'complete'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-info" role="alert">
			<i class="far fa-smile fa-2x mx-2"></i> Tu hardware se ha agregado correctamente. 
		</div>
	</div>
<?php elseif(isset($_SESSION['hardwareRegistrado']) && $_SESSION['hardwareRegistrado'] == 'failed'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-danger" role="alert">
			<i class="far fa-angry fa-2x mx-2"></i> <strong> Registro fallido</strong>, introduce los datos correctamente. 
		</div>
	</div>
<?php endif;?>
<?php Utils::deleteSession('hardwareRegistrado');?>

<!-- ------- -->

<div class="row">
    <div class="col align-middle">
        <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="mb-0"> Hardware <?= $hardware->getEncabezado()?></h5>
                <a href="<?= URL ?>hardware/nuevo"class="btn btn-success text-light">Nuevo</a>
			</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col"><small class="font-weight-bold"><small></th>
                        <th scope="col"><small class="font-weight-bold">Hardware<small></th>
                        <th scope="col"><small class="font-weight-bold">Modelo<small></th>
                        <th scope="col"><small class="font-weight-bold">Numero de Serie<small></th>
                        <th scope="col"><small class="font-weight-bold">Código Unahur<small></th>
                        <th scope="col" colspan=2><small class="font-weight-bold">Estado Préstamo<small></th>                        
                        <th scope="col"><small class="font-weight-bold"><small></th>
                    </tr>
                </thead>

                <tbody>
                    <?php while($dato = $hardwares->fetch_object()): ?>
                    <?php  $estadoHardware = $dato->id_estado_hardware;
                        if($estadoHardware == $estado) {
                    ?>
                        <tr class="shadow-sm">
                            <td class="align-middle text-center">
                                <i class="fas fa-laptop"
                                        <?php
                                            switch ($estado) {
                                                case 1:
                                                    echo  'style="color:rgba(0, 244, 0, 0.5)"';
                                                break;
                                                case 2:
                                                    echo 'style="color:rgba(244, 0, 0, 0.5)"';
                                                break;
                                        }
                                    ?>                                
                                > </i>
                            </td>
                            
                            <td><span class="d-block"><?= $dato->tipo_hardware; ?></span><small class="text-muted"><?= $dato->marca; ?></small>
                            </td>
                            <td class="align-middle"><span><?= $dato->modelo; ?></span></td>
                            <td class="align-middle"><span><?= $dato->numero_serie; ?></span></td>
                            <td class="align-middle"><span><?= $dato->codigo_interno; ?></span></td>
                            <td class="align-middle">
                                <span>
                                    <i class="far fa-handshake fa-sm"
                                                <?php
                                                    switch ($dato->id_estado_prestamo) {
                                                        case 1:
                                                            echo  'style="color:rgba(244, 244, 0, 0.5)"';
                                                        break;
                                                        case 2:
                                                            echo 'style="color:rgba(0, 64, 208, 0.5)"';
                                                        break;
                                                        case 3:
                                                            echo 'style="color:rgba(0, 244, 0, 0.5)"';
                                                        break;
                                                        case 4:
                                                            echo 'style="color:rgba(244, 0, 0, 0.5)"';
                                                        break;
                                                }
                                            ?>                                
                                        > </i>                                
                                </span>
                            </td>
                            <td class="align-middle">
                                <?= $dato->estado_prestamo; ?>
                            </td>
                            <td class="align-middle">
                                <a href = "<?= URL ?>hardware/editar&id=<?=$dato->id_hardware?>">
                                    <span class="badge badge-secondary"><i class="fas fa-pencil-alt"></i></span> 
                                </a>
                            </td>
                        </tr>
                    <?php } endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>