<?php
    require_once '../config/conexion.php';
?>

<?php    
	$sql = $bd->query("SELECT * FROM tipos_hardware ORDER BY tipo_Hardware");
	$tiposHardware = $sql->fetchAll(PDO::FETCH_OBJ);
	
	$sql = $bd->query("SELECT * FROM edificios ORDER BY edificio");
	$edificios = $sql->fetchAll(PDO::FETCH_OBJ);
?>


<?php 
// Id del Usuario logueado.
$usuarioSolicitante = 2; ?>

<?php include_once "../views/header.php"; ?>
<div class="container-fluid">
    <?php include_once "../views/navbar.php"; ?>

    <section>
		<div class="row my-3 mx-5">
			<div class="col align-middle">
				<div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
					<div class="card-body d-flex justify-content-between align-items-center">
						<h5 class="mb-0">Solicitud de préstamo</h5>
					</div>
				</div>
			</div>
		</div>

		<div class="row my-3 mx-5">
			<div class="col-xl-12 col-lg-12">

				<div class="card card-body">
					<form action="../functions/solicitarPrestamo.php" method="POST">

					<input type="hidden" name="id_usuario" value="<?php echo $usuarioSolicitante ?>">

						<div class="row my-1">
							<div class="col-sm-6">
								<div class="card border-0">
									<div class="card-body">
										<h5 class="card-title">Tipo</h5>
										<select class="form-select" name="id_tipo_hardware" required>
											<option disabled selected>Selecciona una opción</option>
											<?php foreach($tiposHardware as $tipoHardware) { ?>
											<option
												value="<?= $tipoHardware->id_tipo_hardware ?>"><?= $tipoHardware->tipo_hardware ?>
											</option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card border-0">
									<div class="card-body">
										<h5 class="card-title">Edificio</h5>
										<select class="form-select" name="id_edificio" required>
											<option disabled selected>Selecciona una opción</option>	
											<?php foreach($edificios as $edificio) { ?>
											<option 
												value="<?= $edificio->id_edificio ?>"><?= $edificio->edificio ?>
											</option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
						</div>


						<div class="row my-1">
							<div class="col-sm-6">
								<div class="card border-0">
									<div class="card-body">
										<h5 class="card-title">Fecha desde</h5>
										<input class="form-control" type="date" value="Fecha desde" name="fecha_desde">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card border-0">
									<div class="card-body">
										<h5 class="card-title">Fecha hasta</h5>
										<input class="form-control" type="date" name="fecha_hasta">
									</div>
								</div>
							</div>
						</div>	

						<div class="row my-1 ">
							<div class="col">
								<div class="card border-0">
									<div class="card-body">
										<h5 class="card-title">Motivo</h5>
										<textarea type="text" class="form-control" rows="3" placeholder="Ingrese motivo del préstamo" name="motivo"></textarea>
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
    </section>
</div>

<?php include_once "../views/footer.php"; ?>