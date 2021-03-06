<div class="row my-3">
	<div class="col align-middle">
		<div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
			<div class="card-body d-flex justify-content-between align-items-center">
				<h5 class="mb-0">Confirmar solicitud: #<?= $soli->id_solicitud?></h5>
				<h6 class="mb-0">
					<span>
						<i class="far fa-hand-pointer"
							<?php
								switch ($soli->id_estado_solicitud) {
									case 1:
										echo  'style="color:rgba(0, 244, 0, 0.5)"';
										break;
									case 2:
										echo 'style="color:rgba(244, 0, 0, 0.5)"';
										break;
									case 3:
										echo 'style="color:rgba(244, 244, 0, 0.5)"';
										break;
								}
							?>                                
						> </i>                                
					</span>
					<?php echo $soli->estado_solicitud?>
				</h6>			
			</div>
		</div>
	</div>
</div>

<div class="row my-3">
	<div class="col-xl-12 col-lg-12">			

		<div class="card card-body shadow-sm p-3 mb-5 bg-white rounded border-0">
			<form >

				<input type="hidden" name="id_solicitud" value="<?= $soli->id_solicitud ?>">
				<input type="hidden" name="id_usuario" value="<?= $soli->id_usuario ?>">
				<input type="hidden" name="id_edificio" value="<?= $soli->id_edificio?>">

				<div class="row my-1">
					<div class="col-sm-6">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Solcitante</h5>
								<input type="text" class="form-control"
									value="<?= $soli->apellido ?>, <?= $soli->nombre ?>" name="nombre" required readonly>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Mail</h5>
								<input type="text" class="form-control"
									value="<?= $soli->email?>" name="email" required readonly>
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
									value="<?= $soli->edificio ?>" name="edificio" required readonly>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Fecha Solicitud</h5>
								<input type="text" class="form-control"
									value="<?= $soli->created_at?>" name="fecha_solicitud" required readonly>
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
									value="<?= $soli->fecha_desde ?>" name="fecha_desde" required readonly>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Hasta</h5>
								<input type="text" class="form-control"
									value="<?= $soli->fecha_hasta ?>" name="fecha_hasta" required readonly>
							</div>
						</div>
					</div>
				</div>

				<div class="row my-1">
					<div class="col-sm-6">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Tipo</h5>
								<input type="text" class="form-control"
									value="<?= $soli->tipo_hardware ?>" name="tipo_hardware" required readonly>
							</div>
						</div>
					</div>
				</div>

				<div class="row my-1 ">
					<div class="col">
						<div class="card border-0">
							<div class="card-body">
								<h5 class="card-title">Motivo Solicitud</h5>
								<textarea type="text" class="form-control text-left" rows="3" name="motivo_solicitud" readonly><?= $soli->motivo_solicitud; ?></textarea>
							</div>
						</div>
					</div>
				</div>	
			</form>

			<a href = "<?= URL ?>solicitud/confirmarSolicitud&id=<?=$soli->id_solicitud?>" style= "text-decoration: none">
				<div class="row my-1">
					<div class="col">
						<div class="card border-0 px-3">
							<input type="submit" class="btn btn-success btn-block" value="Confirmar">
						</div>
					</div>
				</div>
            </a>
			
			<a href = "<?= URL ?>solicitud/rechazarSolicitud&id=<?=$soli->id_solicitud?>" style= "text-decoration: none" >
            	<div class="row mt-3 mb-1">
					<div class="col">
						<div class="card border-0 px-3">
							<input type="submit" class="btn btn-outline-danger" value="Rechazar">
						</div>
					</div>
				</div>
            </a>
				

		</div> <!-- card card-body-->
	</div> <!-- col-xl-12 col-lg-12 -->
</div> <!-- row-->