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

        $sql = $bd->prepare("SELECT * FROM hardwares
        INNER JOIN tipos_hardware ON hardwares.id_tipo = tipos_hardware.id_tipo_hardware
        INNER JOIN marcas ON hardwares.id_marca  = marcas.id_marca
        INNER JOIN estados_hardware on hardwares.id_estado_hardware = estados_hardware.id_estado_hardware
        WHERE id_hardware = ?;");

        $sql->execute([$id]);
        $hardware = $sql->fetch(PDO::FETCH_OBJ);
    }

		$idTipoNo = (int) $hardware->id_tipo_hardware;
		$idEstadoHardwareNo = (int) $hardware->id_estado_hardware;
		$idMarcaNo = (int) $hardware->id_marca;


        $sql = $bd->query("SELECT * FROM tipos_hardware WHERE id_tipo_hardware != $idTipoNo ORDER BY tipo_Hardware");
		$tiposHardware = $sql->fetchAll(PDO::FETCH_OBJ);
		
		$sql = $bd->query("SELECT * FROM estados_hardware WHERE id_estado_hardware != $idEstadoHardwareNo ORDER BY estado_Hardware");
		$estadosHardware = $sql->fetchAll(PDO::FETCH_OBJ);
		
		$sql = $bd->query("SELECT * FROM marcas WHERE id_marca!= $idMarcaNo ORDER BY marca");
		$marcas = $sql->fetchAll(PDO::FETCH_OBJ);
	?>



<div class="container-fluid">
    <div class="row my-3 mx-5">
        <div class="col align-middle">
            <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Nuevo hardware</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3 mx-5">
		<div class="col-xl-12 col-lg-12">

			<div class="card card-body">
				<form action="../functions/editarHardware.php" method="POST">

                    <input type="hidden" name="id_hardware" value="<?php echo $hardware->id_hardware ?>">

					<div class="row my-1">
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Tipo</h5>
                                    <select class="form-select" name="id_tipo_hardware" required>
										<option 
											value="<?php echo $hardware->id_tipo_hardware?>">
											<?php echo $hardware->tipo_hardware ?>
										</option>
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
									<h5 class="card-title">Marca</h5>
									<select class="form-select" name="id_marca" required>
										<option 
											value="<?php echo $hardware->id_marca?>">
											<?php echo $hardware->marca ?>
										</option>
                                        <?php foreach($marcas as $marca) { ?>
                                        <option 
                                        	value="<?= $marca->id_marca ?>"><?= $marca->marca ?>
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
									<h5 class="card-title">Modelo</h5>
                                    <input type="text" class="form-control" placeholder="Modelo" name="modelo"value="<?php echo $hardware->modelo ?>" required>								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Estado Hardware</h5>
									<select class="form-select" name="id_estado_hardware" required>
										<option 
											value="<?php echo $hardware->id_estado_hardware?>">
											<?php echo $hardware->estado_hardware ?>
										</option>
                                        <?php foreach($estadosHardware as $estadoHardware) { ?>
                                        <option
                                            value="<?= $estadoHardware->id_estado_hardware ?>"><?= $estadoHardware->estado_hardware ?>
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
									<h5 class="card-title">Numero de Serie</h5>
									<input type="text" class="form-control" placeholder="Numero de serie" name="numero_serie" value="<?php echo $hardware->numero_serie ?>" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Codigo Unahur</h5>
									<input type="text" class="form-control" placeholder="Codigo Unahur" name="codigo_unahur"value="<?php echo $hardware->numero_unahur ?>" required>
								</div>
							</div>
						</div>
					</div>	

					<div class="row my-1 ">
						<div class="col">
							<div class="card border-0">
								<div class="card-body">
									<h5 class="card-title">Descripción</h5>
									<textarea type="text" class="form-control" rows="3" placeholder="Agregar descripcion" name="descripcion"><?php echo $hardware->descripcion ?></textarea>
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


</div>    

<?php include_once "../views/footer.php"; ?>




