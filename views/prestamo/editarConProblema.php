<?php 
	require_once 'models/hardwareModel.php';
?>  




<div class="row my-3">
	<div class="col align-middle">
		<div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
			<div class="card-body d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Préstamo finalizado con nconveniente: #<?= $prest->id_prestamo?> </h5>
				<h6 class="mb-0">
				<span>
					<i class="far fa-handshake"
						<?php
							switch ($prest->id_estado_prestamo) {
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
				<?php echo $prest->estado_prestamo?>
			</h6>	
			</div>
		</div>
	</div>
</div>

<div class="row my-3">
	<div class="col-xl-12 col-lg-12">			

		<div class="card card-body shadow-sm p-3 mb-5 bg-white rounded border-0">
			<form action="<?= URL ?>prestamo/devolucion" method="POST">

				<input type="hidden" name="id_prestamo" value="<?= $prest->id_prestamo ?>">
				<input type="hidden" name="id_hardware" value="<?= $prest->id_hardware ?>">

				<div class="row my-1">
					<div class="col-sm-6">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Solcitante</h5>
								<input type="text" class="form-control"
									value="<?= $prest->apellido ?>, <?= $prest->nombre ?>" name="nombre" required readonly>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Mail</h5>
								<input type="text" class="form-control"
									value="<?= $prest->email?>" name="email" required readonly>
							</div>
						</div>
					</div>
				</div>

				<div class="row my-1">
					<div class="col-sm-6">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Edificio</h5>
								<input type="text" class="form-control"
									value="<?= $prest->edificio ?>" name="edificio" required readonly>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Fecha Solicitud</h5>
								<input type="text" class="form-control"
									value="<?= $prest->created_at?>" name="fecha_solicitud" required readonly>
							</div>
						</div>
					</div>
				</div>

				<div class="row my-1">
					<div class="col-sm-6">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Desde</h5>
								<input type="text" class="form-control"
									value="<?= $prest->fecha_desde ?>" name="fecha_desde" required readonly>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Hasta</h5>
								<input type="text" class="form-control"
									value="<?= $prest->fecha_hasta ?>" name="fecha_hasta" required readonly>
							</div>
						</div>
					</div>
				</div>

				<div class="row my-1">
					<div class="col-sm-6">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Tipo / Marca</h5>
								<input type="text" class="form-control"
									value="<?= $prest->tipo_hardware ?> / <?= $prest->marca?> " name="tipo_hardware" readonly>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Numero de serie</h5>
								<input type="text" class="form-control"
									value="<?= $prest->numero_serie ?>" name="numero_serie" readonly>
							</div>
						</div>
					</div>
				</div>

				<div class="row my-1 ">
					<div class="col">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Motivo Solicitud</h5>
								<textarea type="text" class="form-control text-left" rows="3" name="motivo_solicitud" readonly><?= $prest->motivo_solicitud; ?></textarea>
							</div>
						</div>
					</div>
				</div>	

				<div class="row my-1 ">
					<div class="col">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Observaciones del prestamo</h5>
								<textarea type="text" class="form-control text-left" rows="3" name="observacion_prestamo" readonly><?= $prest->observacion_prestamo; ?></textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="row my-1 ">
					<div class="col">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Observaciones de la devolucion</h5>
								<textarea type="text" class="form-control text-left" rows="3" name="observacion_devolucion" readonly><?= $prest->observacion_devolucion; ?></textarea>
							</div>
						</div>
					</div>
				</div>	

				<div class="row my-1">
					<div class="col">
						<div class="card border-0 px-3">
							<input type="submit" class="btn btn-success btn-block" value="Finalizar correctamente">
						</div>
					</div>
				</div>

			</form>
		</div> <!-- card card-body-->
	</div> <!-- col-xl-12 col-lg-12 -->
</div> <!-- row-->