<!-- ------- -->
<?php
if (isset($_SESSION['confirmarEntrega']) && $_SESSION['confirmarEntrega'] == 'complete'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-info" role="alert">
			<i class="far fa-smile fa-2x mx-2"></i>El préstamo se ha confirmado. 
		</div>
	</div>
<?php elseif(isset($_SESSION['confirmarEntrega']) && $_SESSION['confirmarEntrega'] == 'failed'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-danger" role="alert">
			<i class="far fa-angry fa-2x mx-2"></i> <strong>Error.</strong> No se ha registrado el préstamo. Intenta nuevamente. 
		</div>
	</div>
<?php endif;?>
<?php Utils::deleteSession('confirmarEntrega');?>

<!-- ------- -->
<?php
if (isset($_SESSION['confirmarDevolucion']) && $_SESSION['confirmarDevolucion'] == 'complete'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-info" role="alert">
			<i class="far fa-smile fa-2x mx-2"></i>La devolución se ha confirmado. 
		</div>
	</div>
<?php elseif(isset($_SESSION['confirmarDevolucion']) && $_SESSION['confirmarDevolucion'] == 'failed'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-danger" role="alert">
			<i class="far fa-angry fa-2x mx-2"></i> <strong>Error.</strong> No se ha registrado la devolución. Intenta nuevamente. 
		</div>
	</div>
<?php endif;?>
<?php Utils::deleteSession('confirmarDevolucion');?>

<!-- ------- -->

<div class="row">
    <div class="col align-middle">
        <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="mb-0"> Préstamos <?= $prestamo->getEncabezado()?></h5>
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
                        <th scope="col"><small class="font-weight-bold">Préstamo<small></th>
                        <th scope="col"><small class="font-weight-bold">Solicitud<small></th>
                        <th scope="col"><small class="font-weight-bold">Tipo<small></th>
                        <th scope="col"><small class="font-weight-bold">Solicitante<small></th>
                        <th scope="col"><small class="font-weight-bold">Edificio<small></th>
                        <th scope="col"><small class="font-weight-bold">Desde<small></th>
                        <th scope="col"><small class="font-weight-bold">Hasta<small></th>
                        <th scope="col"><small class="font-weight-bold"><small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($dato = $prestamos->fetch_object()): ?>
                    <?php $estadoPrestamo = $dato->id_estado_prestamo;
                        if($estadoPrestamo == $estado) {
                    ?>                    
                        <tr class="shadow-sm">
                        <td class="align-middle">
                                <i class="far fa-handshake" style="color:rgba(244, 244, 0, 0.5)";> </i>
                            </td>
                            <td class="align-middle"><span><?= $dato->id_prestamo; ?></span></td>
                            <td class="align-middle"><span><?= $dato->id_solicitud; ?></span></td>
                            <td class="align-middle"><span><?= $dato->tipo_hardware; ?></span></td>
                            <td><span class="d-block"></i><?= $dato->nombre; ?> <?= $dato->apellido; ?>
                                </span><small class="text-muted"><i class="far fa-envelope fa-xs"></i>     <?= $dato->email; ?></small>
                            </td>
                            <td class="align-middle"><span><?= $dato->edificio; ?></span></td>
                            <td class="align-middle"><span><?= $dato->fecha_desde; ?></span></td>
                            <td class="align-middle"><span><?= $dato->fecha_hasta; ?></span></td>
                            <td class="align-middle">
                            <td class="align-middle">
                                <a href = "<?= URL ?>prestamo/editarPendiente&id=<?=$dato->id_prestamo?>">
                                    <span class="badge badge-secondary"><i class="fas fa-binoculars"></i></span> 
                                </a>
                            </td>
                            </td>
                        </tr>
                    <?php } endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="/js/confirmacion.js"></script>
