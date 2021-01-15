<!-- ------- -->
<?php
if (isset($_SESSION['edit']) && $_SESSION['edit'] == 'complete'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-info" role="alert">
			<i class="far fa-smile fa-2x mx-2"></i> Tu hardware se ha editado correctamente. 
		</div>
	</div>
<?php elseif(isset($_SESSION['edit']) && $_SESSION['edit'] == 'failed'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-danger" role="alert">
			<i class="far fa-angry fa-2x mx-2"></i> <strong> Edicion fallida</strong>, intenta nuevamente. 
		</div>
	</div>
<?php endif;?>
<?php Utils::deleteSession('edit');?>

<!-- ------- -->

<div class="row">
    <div class="col align-middle">
        <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="mb-0"> Prestamos <?= $prestamo->getEncabezado()?></h5>
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
                        <th scope="col"><small class="font-weight-bold">Id<small></th>
                        <th scope="col"><small class="font-weight-bold">Tipo<small></th>
                        <th scope="col"><small class="font-weight-bold">Numero de serie<small></th>
                        <th scope="col"><small class="font-weight-bold">Codigo Interno<small></th>
                        <th scope="col"><small class="font-weight-bold">Solicitante<small></th>
                        <th scope="col"><small class="font-weight-bold">Edificio<small></th>
                        <th scope="col"><small class="font-weight-bold">Desde<small></th>
                        <th scope="col"><small class="font-weight-bold">Hasta<small></th>
                        <th scope="col"><small class="font-weight-bold">Confirmar<small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($dato = $prestamos->fetch_object()): ?>
                    <?php $estadoPrestamo = $dato->id_estado_prestamo;
                        if($estadoPrestamo == $estado) {
                    ?>                    
                        <tr class="shadow-sm">
                        <td class="align-middle">
                                <i class="fas fa-grip-lines-vertical"
                                    <?php
                                        switch ($estado) {
                                            case 1:
                                                echo  'style="color:rgba(244, 0, 0, 0.5)"';
                                                break;
                                            case 2:
                                                echo 'style="color:rgba(0, 244, 0, 0.5)"';
                                                break;
                                            case 3:
                                                echo 'style="color:rgba(0, 244, 0, 0.5)"';
                                                break;
                                            case 4:
                                                echo  'style="color:rgba(244, 0, 0, 0.5)"';
                                                break;
                                            case 5:
                                                echo 'style="color:rgba(244, 244, 0, 0.5)"';
                                                break;
                                        }
                                    ?>
                                
                                > </i>
                            </td>
                            <td class="align-middle"><span><?= $dato->id_prestamo; ?></span></td>
                            <td><span class="d-block"></i>     <?= $dato->tipo_hardware; ?>
                                </span><small class="text-muted"><?= $dato->marca; ?></small>
                            </td>
                            <td class="align-middle"><span><?= $dato->numero_serie; ?></span></td>
                            <td class="align-middle"><span><?= $dato->codigo_interno; ?></span></td>
                            <td><span class="d-block"></i>     <?= $dato->nombre; ?> <?= $dato->apellido; ?>
                                </span><small class="text-muted"><i class="far fa-envelope fa-xs"></i>     <?= $dato->email; ?></small>
                            </td>
                            <td class="align-middle"><span><?= $dato->edificio; ?></span></td>
                            <td class="align-middle"><span><?= $dato->fecha_desde; ?></span></td>
                            <td class="align-middle"><span><?= $dato->fecha_hasta; ?></span></td>
                            <td class="align-middle">
                                <a href = "<?= URL ?>prestamo/confirmarPrestamo&id=<?=$dato->id_prestamo?>">
                                    <span class="text-success"><i class="fas fa-check"></i></i></span> 
                                </a>
                            </td>
                        </tr>
                    <?php } endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="/js/confirmacion.js"></script>
