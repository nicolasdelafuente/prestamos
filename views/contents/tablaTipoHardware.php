<div class="row mt-3">
    <div class="col align-middle">
        <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tipos de hardware</h5>
                <a href="<?=base_url?>tipoHardware/registro"class="btn btn-success text-light">Nuevo</a>
			</div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col"><small class="font-weight-bold">Id<small></th>
                        <th scope="col"><small class="font-weight-bold">Tipo<small></th>
                        <th scope="col"><small class="font-weight-bold">Fecha Registro<small></th>
                        <th scope="col"><small class="font-weight-bold">Editar<small></th>
                        <th scope="col"><small class="font-weight-bold">Eliminar<small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($dato = $tiposHardware->fetch_object()): ?>
                    <tr class="shadow-sm">
                        <td class="align-middle"><span class="badge badge-primary text-primary"><?= $dato->id_tipo_hardware; ?></span></td>
                        <td class="align-middle"><span class="d-block"><?= $dato->tipo_hardware; ?></span>
                        <td class="align-middle"><span><?= $dato->created_at; ?></span> </td>
                        <td class="align-middle"><span class="badge badge-secondary">
                            <i class="fas fa-pencil-alt"></i></span>
                        </td>
                        <td class="align-middle"><span class="badge bg-danger text-white">
                            <i class="fas fa-times"></i></span>
                        </td>
                    <?php endwhile; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>