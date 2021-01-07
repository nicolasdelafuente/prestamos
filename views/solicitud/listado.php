<!-- ------- -->
<?php
if (isset($_SESSION['edit']) && $_SESSION['edit'] == 'complete'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-info" role="alert">
			<i class="far fa-smile fa-2x"></i> Tu hardware se ha editado correctamente. 
		</div>
	</div>
<?php elseif(isset($_SESSION['edit']) && $_SESSION['edit'] == 'failed'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-danger" role="alert">
			<i class="far fa-angry fa-2x"></i> <strong> Edicion fallida</strong>, intenta nuevamente. 
		</div>
	</div>
<?php endif;?>
<?php Utils::deleteSession('edit');?>

<!-- ------- -->



<div class="row">
    <div class="col align-middle">
        <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="mb-0"> Solicitudes</h5>
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
                        <th scope="col"><small class="font-weight-bold">Usuario<small></th>
                        <th scope="col"><small class="font-weight-bold">Tipo<small></th>
                        <th scope="col"><small class="font-weight-bold">Edificio<small></th>
                        <th scope="col"><small class="font-weight-bold">Desde<small></th>
                        <th scope="col"><small class="font-weight-bold">Hasta<small></th>
                        <th scope="col"><small class="font-weight-bold">Editar<small></th>
                    </tr>
                </thead>
                <tbody>


                    <?php while($dato = $solicitudes->fetch_object()): ?>
                        <tr class="shadow-sm">
                        <td class="align-middle">
                                <i class="fas fa-circle mr-1"
                                    <?php
                                        switch ($dato->id_estado_solicitud) {
                                            case 1:
                                                echo  'style="color:rgba(0, 244, 0, 0.5)"';
                                                break;
                                            case 2:
                                                echo 'style="color:rgba(244, 0, 0, 0.5)"';
                                                break;
                                            case 3:
                                                echo 'style="color:rgba(150, 152, 154, 0.5)"';
                                                break;
                                        }
                                    ?>
                                
                                > </i>
                            </td>
                            <td><span class="d-block"><?= $dato->apellido; ?></span><small class="text-muted"><?= $dato->nombre; ?></small>
                            </td>
                            <td class="align-middle"><span><?= $dato->tipo_hardware; ?></span></td>
                            <td class="align-middle"><span><?= $dato->edificio; ?></span></td>
                            <td class="align-middle"><span><?= $dato->fecha_desde; ?></span></td>
                            <td class="align-middle"><span><?= $dato->fecha_hasta; ?></span></td>
                            <td class="align-middle">
                                <a href = "http://localhost/prestamoHardware/solicitud/editar&id=<?=$dato->id_solicitud?>">
                                    <span class="badge badge-secondary"><i class="fas fa-pencil-alt"></i></span> 
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>