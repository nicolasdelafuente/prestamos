
    <div class="col-sm-8 bg-white text-center mt-5 pt-2">

        <div class="row my-3">
            <div class="col align-middle">
                <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <i class="fas fa-user-cog fa-2x" style="color:#122562;"></i>
                        <h4 class="mb-0">Administrador</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class = "shadow-sm shadow-hover p-2 mb-5 bg-white rounded">
            <a href="<?= URL ?>hardware/index" class="btn btn-sq-lg btn-success m-3 shadow-sm">
                <i class="fas fa-laptop fa-5x my-3"></i> </br>
                Hardware 
            </a>
        
            <a href="<?= URL ?>solicitud/index" class="btn btn-sq-lg btn-success m-3 shadow-sm">
                <i class="far fa-hand-pointer fa-5x my-3"></i> </br>
                Solicitudes 
            </a>

            <a href="<?= URL ?>prestamo/index" class="btn btn-sq-lg btn-success m-3 shadow-sm">
                <i class="far fa-handshake fa-5x my-3"></i> </br>
                Préstamos
            </a>

            <a href="<?= URL ?>prestamo/enPrestamo" class="btn btn-sq-lg btn-success m-3 shadow-sm">
                <i class="fas fa-undo-alt fa-5x my-3"></i> </br>
                Devoluciones
            </a>
        </div>


        <div class="row my-3">
            <div class="col align-middle">
                <div class="card d-inline-block border-0 shadow-sm shadow-hover w-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <i class="fas fa-user fa-2x" style="color:#122562;"></i>
                        <h4 class="mb-0">Usuario</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class = "shadow-sm shadow-hover p-2 mb-5 bg-white rounded">        
            <a href="<?= URL ?>solicitud/nuevo" class="btn btn-sq-lg btn-light text-info m-3 shadow-sm">
                <i class="far fa-hand-pointer fa-5x my-3"></i> </br>
                Solicitar 
            </a>

            <a href="<?= URL ?>solicitud/usuario"" class="btn btn-sq-lg btn-info text-light m-3 shadow-sm">
                <i class="far fa-hand-pointer fa-5x my-3"></i> </br>
                Mis Solciitudes
            </a>

            <a href="<?= URL ?>prestamo/usuario"" class="btn btn-sq-lg btn-info text-light m-3 shadow-sm">
                <i class="far fa-handshake fa-5x my-3"></i> </br>
                Mis préstamos
            </a>
        </div>

    </div>
