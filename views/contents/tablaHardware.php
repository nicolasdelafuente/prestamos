<div class="row my-3 mx-5">
    <div class="col align-middle">
        <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Hardware</h5>
                <a href="<?=base_url?>hardware/registrar"class="btn btn-success text-light">Nuevo</a>
			</div>
        </div>
    </div>
</div>


<div class="row my-3 mx-5">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col"><small class="font-weight-bold">Id<small></th>
                        <th scope="col"><small class="font-weight-bold">Hardware<small></th>
                        <th scope="col"><small class="font-weight-bold">Estado hardware<small></th>
                        <th scope="col"><small class="font-weight-bold">Modelo<small></th>
                        <th scope="col"><small class="font-weight-bold">Numero de Serie<small></th>
                        <th scope="col"><small class="font-weight-bold">Código Unahur<small></th>
                        <th scope="col"><small class="font-weight-bold">Fecha Registro<small></th>
                        <th scope="col"><small class="font-weight-bold">Editar<small></th>
                        <th scope="col"><small class="font-weight-bold">Eliminar<small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($dato = $hardwares->fetch_object()): ?>
                        <tr class="shadow-sm">
                            <td class="align-middle"><span class="badge badge-primary text-primary"><?= $dato->id_hardware; ?></span></td>
                            <td><span class="d-block"><?= $dato->tipo_hardware; ?></span><small class="text-muted"><?= $dato->marca; ?></small>
                            </td>
                            <td class="align-middle"><span><?= $dato->estado_hardware; ?></span></td>
                            <td class="align-middle"><span><?= $dato->modelo; ?></span></td>
                            <td class="align-middle"><span><?= $dato->numero_serie; ?></span></td>
                            <td class="align-middle"><span><?= $dato->numero_unahur; ?></span></td>
                            <td class="align-middle"><span><?= $dato->created_at; ?></span></td>
                            <td class="align-middle">
                                <a href = "<?=base_url?>hardware/editar&id=<?=$dato->id_hardware?>">
                                    <span class="badge badge-secondary"><i class="fas fa-pencil-alt"></i></span> 
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href = "<?=base_url?>hardware/eliminar&id=<?=$dato->id_hardware?>">
                                    <span class="badge bg-danger text-white"><i class="fas fa-times"></i></span>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>