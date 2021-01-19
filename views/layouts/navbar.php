<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo URL ?>"><i class="fas fa-cubes mx-2"></i>Préstamos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

        
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Hardwares
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo URL ?>hardware/activo">Activo</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>hardware/inactivo">Inactivo</a></li>
                    <div class="dropdown-divider"></div>
                    <li><a class="dropdown-item" href="<?php echo URL ?>hardware/nuevo">Nuevo</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Solicitudes
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo URL ?>solicitud/pendiente">Pendientes</a> </li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>solicitud/aprobada">Aprobadas</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>solicitud/desaprobada">Desaprobadas</a></li>
                    <div class="dropdown-divider"></div>
                    <li><a class="dropdown-item" href="<?php echo URL ?>solicitud/nuevo">Nueva</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Préstamos
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo URL ?>prestamo/pendiente">Pendientes de aprobación</a> </li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>prestamo/enPrestamo">En curso</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>prestamo/finalizado">Recibido / Finalizado</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>prestamo/conProblemas">Recibidos con problemas</a></li>
                </ul>
            </li>






            
        </ul>
            <span class="d-flex ">
                <a class="btn p-0" type="submit">Cerrar sesión</a>
            </span>
        </div>
    </div>
</nav>
