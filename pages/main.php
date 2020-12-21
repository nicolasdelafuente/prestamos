<?php
    include_once "views/header.php";
?>


<div class="container-fluid">

    <?php include_once "views/navbar.php"; ?>

    <section>
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-sm-8 bg-white text-center">
                <div class="container">
                    <div class="row">
                        <div class="m-1">
                            <a href="pages/solicitarPrestamo.php" class="btn btn-sq-lg btn-success">
                                <i class="fas fa-laptop fa-5x"></i> </br>
                                Solicitar préstamo
                            </a>
                        </div>
                        <div class="m-1">
                            <a href="pages/listadoSolicitud.php" class="btn btn-sq-lg btn-success">
                            <i class="fas fa-check-circle fa-5x"></i> </br>
                                Confirmar solicitudes 
                            </a>
                        </div>
                        <div class="m-1">
                            <a href="pages/listadoHardware.php" class="btn btn-sq-lg btn-success">
                            <i class="fas fa-list fa-5x"></i> </br>
                                Listar hardware 
                            </a>
                        </div>
                        <div class="m-1">
                            <a href="pages/listadoPrestamo.php" class="btn btn-sq-lg btn-success">
                            <i class="fas fa-undo-alt fa-5x"></i> </br>
                                Devolver préstamo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php include_once "views/footer.php"; ?>





