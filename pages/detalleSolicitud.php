<?php   
	require_once '../config/conexion.php';
	include_once '../views/header.php';
    include_once '../views/navbar.php';
?>

<?php 
    if (!isset($_GET['id'])) {
        echo 'No existe ID';
    }else{

        $id = $_GET['id'];

        $sql = $bd->prepare("SELECT * FROM solicitudes
        INNER JOIN usuarios ON solicitudes.id_usuario = usuarios.id_usuario
        INNER JOIN tipos_hardware ON solicitudes.id_tipo_hardware  = tipos_hardware.id_tipo_hardware
        INNER JOIN edificios on solicitudes.id_edificio = edificios.id_edificio
		INNER JOIN estados_solicitud on solicitudes.id_estado_solicitud = estados_solicitud.id_estado_solicitud
        WHERE id_solicitud = ?;");

        $sql->execute([$id]);
		$solicitud = $sql->fetch(PDO::FETCH_OBJ);
		
		
	}

		$idTipoHardware = $solicitud->id_tipo_hardware;

		$sql = $bd->query("SELECT * FROM hardwares
							WHERE id_tipo = $idTipoHardware and id_estado_hardware = 1
						 	ORDER BY numero_serie");
		$hardwares = $sql->fetchAll(PDO::FETCH_OBJ);
	?>

<div class="container-fluid">
    <div class="row my-3 mx-5">
        <div class="col align-middle">
            <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Solicitud nº: <span><?php echo $solicitud->id_solicitud ?></span></h5>
					<h3 class="mb-0">Estado:  <?php echo $solicitud->estado_solicitud ?> </h3>

                </div>
            </div>
        </div>
    </div>

    <div class="row my-3 mx-5">
		<div class="col-xl-12 col-lg-12">

			<div class="card card-body">
				<form action="../functions/confirmarPrestamo.php" method="POST">

                    <input type="hidden" name="id_solicitud" value="<?php echo $solicitud->id_solicitud ?>" readonly>

					<div class="row my-1">
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Solicitante</h5>
									<input type="text" class="form-control" name="id_usuario"value="<?php echo $solicitud->nombre ?>  <?php echo $solicitud->apellido ?>" readonly>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Edificio</h5>
									<input type="text" class="form-control" name="id_edificio"value="<?php echo $solicitud->edificio ?>" readonly>
								</div>
							</div>
						</div>
					</div>

					<div class="row my-1">
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Hardware</h5>
                                    <input type="text" class="form-control" name="id_tipo_hardware"value="<?php echo $solicitud->tipo_hardware ?>" readonly>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card border-0">
							<div class="card-body">
									<h5 class="card-title">Tipo</h5>
                                    <select class="form-select" name="numero_serie" required>
                                        <?php foreach($hardwares as $hardware) { ?>
                                        <option
                                            value="<?= $hardware->numero_serie ?>"><?= $hardware->numero_serie ?>
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
									<input type="text" class="form-control"  name="fecha_desde" value="<?php echo $solicitud->fecha_desde ?>" readonly>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Fecha Hasta</h5>
									<input type="text" class="form-control" name="fecha_hasta"value="<?php echo $solicitud->fecha_hasta ?>" readonly>
								</div>
							</div>
						</div>
					</div>	

					<div class="row my-1 ">
						<div class="col">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Motivo</h5>
									<textarea type="text" class="form-control" rows="3" placeholder="Sin descripcion" name="motivo" readonly><?php echo $solicitud->motivo ?> </textarea>
								</div>
							</div>
						</div>
					</div>	

					<div class="row my-1">
						<div class="col">
							<div class="card border-0 px-3">
								<input type="submit" class="btn btn-success btn-block" value="Confirmar">
							</div>
						</div>
					</div>

				</form>
			</div> <!-- card card-body-->
		</div> <!-- col-xl-12 col-lg-12 -->
	</div> <!-- row-->


</div>    

<?php include_once "../views/footer.php"; ?>




