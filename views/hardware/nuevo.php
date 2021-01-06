<?php 
	require_once 'models/marcaModel.php';
	require_once 'models/tipoHardwareModel.php';
	require_once 'models/estadoHardwareModel.php';
?>

<?php 
	$tipoHardware = new TipoHardwareModel();
	$tiposHardware = $tipoHardware->getAll();

	$marca = new MarcaModel();
	$marcas = $marca->getAll();

	$estadoHardware = new EstadoHardwareModel();
	$estadosHardware = $estadoHardware->getAll();
?>

<!-- ------- -->
<?php
if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-info" role="alert">
			<i class="far fa-smile fa-2x"></i> Tu hardware se ha agregado correctamente. 
		</div>
	</div>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
	<div class="col-lg-6 mt-3">
		<div class="alert alert-danger" role="alert">
			<i class="far fa-angry fa-2x"></i> <strong> Registro fallido</strong>, introduce los datos correctamente. 
		</div>
	</div>
<?php endif;?>
<?php Utils::deleteSession('register');?>

<!-- ------- -->
<?php 
// Id del Usuario logueado.
$usuarioSolicitante = 2; ?>

    <div class="row my-3">
        <div class="col align-middle">
            <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Nuevo hardware</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3">
		<div class="col-xl-12 col-lg-12">			

			<div class="card card-body shadow-sm p-3 mb-5 bg-white rounded border-0">
				<form action="<?= URL?>hardware/guardar" method="POST">
				
					<input type="hidden" name="id_usuario" value="<?php echo $usuarioSolicitante ?>">

					<div class="row my-1">
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Tipo</h5>
									<select class="form-select" name="id_tipo" required>
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
									<h5 class="card-title">Marca</h5>
									<select class="form-select" name="id_marca" required>
										<option disabled selected>Selecciona una opción</option>
										<?php while($dato = $marcas->fetch_object()): ?>
										<option value="<?= $dato->id_marca ?>"><?= $dato->marca ?> </option>
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
									<h5 class="card-title">Modelo</h5>
									<input type="text" class="form-control" placeholder="Modelo" name="modelo" required>
                                    <small class="form-text text-muted">Campo obligatorio.</small>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Estado hardware</h5>
									<select class="form-select" name="id_estado_hardware" required>
										<option disabled selected>Selecciona una opción</option>
										<?php while($dato = $estadosHardware->fetch_object()): ?>
										<option value="<?= $dato->id_estado_hardware ?>"><?= $dato->estado_hardware ?> </option>
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
									<h5 class="card-title">Número de serie</h5>
									<input type="text" class="form-control" placeholder="Numero de serie" name="numero_serie" required>
                                    <small class="form-text text-muted">Campo obligatorio.</small>
                                </div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Código interno</h5>
									<input type="text" class="form-control" placeholder="Código interno" name="codigo_interno">
								</div>
							</div>
						</div>
					</div>	

					<div class="row my-1 ">
						<div class="col">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Descripción</h5>
									<textarea type="text" class="form-control" rows="3" placeholder="Agregar descripcion" name="descripcion"></textarea>
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