<div class="row">
    <div class="col align-middle">
        <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="mb-0"> Mis préstamos </h5>
                <a href="<?= URL ?>solicitud/usuario"class="btn btn-outline-success">Mis Solicitudes</a>
			</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col"><small class="font-weight-bold"><small></th>
                        <th scope="col"><small class="font-weight-bold">Id<small></th>
                        <th scope="col"><small class="font-weight-bold">Tipo<small></th>
                        <th scope="col"><small class="font-weight-bold">Edificio<small></th>
                        <th scope="col"><small class="font-weight-bold">Desde<small></th>
                        <th scope="col"><small class="font-weight-bold">Hasta<small></th>
                        <th scope="col"><small class="font-weight-bold">Estado<small></th>


                    </tr>
                </thead>
                <tbody>
                    <?php while($dato = $prestamos->fetch_object()): ?>
                    <?php  $estadoPrestamo = $dato->id_estado_prestamo ?>                    
                        <tr class="shadow-sm">
                            <td class="align-middle">
                                <i class="far fa-handshake"
                                    <?php
                                        switch ($estadoPrestamo) {
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
                            </td>  
                            <td class="align-middle"><span><?= $dato->id_solicitud; ?></span></td>
                            <td class="align-middle"><span><?= $dato->tipo_hardware; ?></span></td>
                            <td class="align-middle"><span><?= $dato->edificio; ?></span></td>
                            <td class="align-middle"><span><?= $dato->fecha_desde; ?></span></td>
                            <td class="align-middle"><span><?= $dato->fecha_hasta; ?></span></td>
                            <td class="align-middle"><span><?= $dato->estado_prestamo; ?></span></td>                            
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>