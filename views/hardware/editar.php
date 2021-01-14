<?php 
	require_once 'models/estadoHardwareModel.php';
	require_once 'models/marcaModel.php';
	require_once 'models/tipoHardwareModel.php';
?>  

<?php 
	$idHardware = (int)$hard->id_hardware;

	$idEstadoHardwareNo = (int) $hard->id_estado_hardware;
	$estadoHardware = new EstadoHardwareModel();
	$estadosHardwareNo = $estadoHardware->getAllButOne($idEstadoHardwareNo);

	
	$idTipoNo = (int) $hard->id_tipo_hardware;
	$tipoHardware = new TipoHardwareModel();
	$tiposHardware = $tipoHardware->getAllButOne($idTipoNo);
	

	$idMarcaNo = (int) $hard->id_marca;
	$marca = new MarcaModel();
	$marcas = $marca->getAllButOne($idMarcaNo);	
?>






    <div class="row my-3">
        <div class="col align-middle">
            <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Editar hardware </h5>
					<h6 class="mb-0">ID hardware: <?php echo $hard->id_hardware?></h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3">
		<div class="col-xl-12 col-lg-12">			

			<div class="card card-body shadow-sm p-3 mb-5 bg-white rounded border-0">
				<form action="<?= URL ?>hardware/edicion" method="POST">

					<input type="hidden" name="id_hardware" value="<?php echo $hard->id_hardware ?>">

					<div class="row my-1">
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Tipo</h5>
									<select class="form-select" name="id_tipo_hardware" required>
										<option 
											value="<?php echo $hard->id_tipo_hardware?>">
											<?php echo $hard->tipo_hardware ?>
										</option>
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
										<option 
											value="<?php echo $hard->id_marca?>">
											<?php echo $hard->marca ?>
										</option>
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
									<input type="text" class="form-control" placeholder="Modelo" 
										value="<?= $hard->modelo ?>" name="modelo" required>
                                    <small class="form-text text-muted">Campo obligatorio.</small>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Estado hardware</h5>
									<select class="form-select" name="id_estado_hardware" required>
										<option 
											value="<?php echo $hard->id_estado_hardware?>">
											<?php echo $hard->estado_hardware ?>
										</option>
										</option>
										<?php while($dato = $estadosHardwareNo->fetch_object()): ?>
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
									<input type="text" class="form-control"
										value="<?= $hard->numero_serie ?>" name="numero_serie" required>
                                    <small class="form-text text-muted">Campo obligatorio.</small>
                                </div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Código interno</h5>
									<input type="text" class="form-control"
										value="<?= $hard->codigo_interno ?>" name="codigo_interno">
								</div>
							</div>
						</div>
					</div>	

					<div class="row my-1">
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Registro</h5>
									<input type="text" class="form-control" readonly
										value="<?= $hard->created_at ?>" required>
                                </div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Última modificación</h5>
									<input type="text" class="form-control" readonly
									value="<?= $hard->updated_at ?>" required>
								</div>
							</div>
						</div>
					</div>	


					<div class="row my-1 ">
						<div class="col">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Descripción</h5>
									<textarea type="text" class="form-control text-left" rows="3" name="descripcion_hardware"><?= trim($hard->descripcion_hardware); ?> </textarea>
								</div>
							</div>
						</div>
					</div>	

					<div class="row my-1">
						<div class="col">
							<div class="card border-0 px-3">
								<input type="submit" class="btn btn-success btn-block" value="Editar">
							</div>
						</div>
					</div>

				</form>
			</div> <!-- card card-body-->
		</div> <!-- col-xl-12 col-lg-12 -->
	</div> <!-- row-->