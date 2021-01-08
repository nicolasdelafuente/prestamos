<?php 
    require_once 'models/tipoHardwareModel.php';
    require_once 'models/edificioModel.php';
?>

<?php 
    $tipoHardware = new TipoHardwareModel();
    $tiposHardware = $tipoHardware->getAll();

	$edificio = new EdificioModel();
	$edificios = $edificio->getAll();
?>

<?php 
// Id del Usuario logueado.
$usuarioSolicitante = 2; ?>

<!-- ------- -->
<?php
if (isset($_SESSION['solicitar']) && $_SESSION['solicitar'] == 'complete'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-info" role="alert">
			<i class="far fa-smile fa-2x"></i> Tu solicitud se ha realizado correctamente. 
		</div>
	</div>
<?php elseif(isset($_SESSION['solicitar']) && $_SESSION['solicitar'] == 'failed'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-danger" role="alert">
			<i class="far fa-angry fa-2x"></i> <strong> Solicitud fallida</strong>, introduce los datos correctamente. 
		</div>
	</div>
<?php endif;?>
<?php Utils::deleteSession('solicitar');?>

<!-- ------- -->

    <div class="row my-3">
        <div class="col align-middle">
            <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Solictar préstamo</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3">
		<div class="col-xl-12 col-lg-12">			

			<div class="card card-body shadow-sm p-3 mb-5 bg-white rounded border-0">
				<form action="<?= URL?>solicitud/guardar" method="POST">

					<input type="hidden" name="id_usuario" value="<?php echo $usuarioSolicitante ?>">

					<div class="row my-1">
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Tipo</h5>
									<select class="form-select" name="id_tipo_hardware" required>
										<option disabled selected>Selecciona una opción</option>
										<?php while($dato = $tiposHardware->fetch_object()): ?>
										<option value="<?= $dato->id_tipo_hardware ?>"><?= $dato->tipo_hardware ?> </option>
										<?php endwhile; ?>
									</select>
                                    <small class="form-text text-muted">Campo obligatorio.</small>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Edificio</h5>
									<select class="form-select" name="id_edificio"marca required>
										<option disabled selected>Selecciona una opción</option>
										<?php while($dato = $edificios->fetch_object()): ?>
										<option value="<?= $dato->id_edificio ?>"><?= $dato->edificio ?> </option>
										<?php endwhile; ?>
									</select>
                                    <small class="form-text text-muted">Campo obligatorio.</small>
								</div>
							</div>
						</div>
					</div>

					<div class="row my-1">
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Fecha desde</h5>
                                    <input class="form-control" type="date" value="fecha_desde" name="fecha_desde">
                                    <small class="form-text text-muted">Campo obligatorio.</small>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Fecha hasta</h5>
                                    <input class="form-control" type="date" name="fecha_hasta">
                                    <small class="form-text text-muted">Campo obligatorio.</small>
								</div>
							</div>
						</div>
					</div>	

					<div class="row my-1 ">
						<div class="col">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Motivo</h5>
									<textarea type="text" class="form-control" rows="3" placeholder="Agregar descripcion" name="motivo_solicitud" required></textarea>
                                    <small class="form-text text-muted">Campo obligatorio.</small>
                                </div>
							</div>
						</div>
					</div>	

					<div class="row my-1">
						<div class="col">
							<div class="card border-0 px-3">
								<input type="submit" class="btn btn-success btn-block" value="Agregar">
							</div>
						</div>
					</div>

				</form>
			</div> <!-- card card-body-->
		</div> <!-- col-xl-12 col-lg-12 -->
	</div> <!-- row-->