<?php

require_once 'models/prestamoModel.php';
require_once 'models/prestamoEstadoPrestamoModel.php';
require_once 'controllers/hardwareController.php';
class PrestamoController{

    public function index(){
        return $this->pendiente();
    }


    // Listado prestamos pendientes de entrega.
    public function pendiente() {
        $prestamo = new PrestamoModel();
        $prestamos = $prestamo->getAllPendiente();
        $prestamo->setEncabezado('pendientes de entrega');
        $estado = 1;
        require_once 'views/prestamo/listadoPendiente.php';
    }

    // Listado prestamos en curso.
    public function enPrestamo() {
        $prestamo = new PrestamoModel();
        $prestamos = $prestamo->getAllEnPrestamo();
        $prestamo->setEncabezado('en curso');
        $estado = 2;
        require_once 'views/prestamo/listadoEnPrestamo.php';
    }

    // Listado prestamos en finalizados.
    public function finalizado() {
        $prestamo = new PrestamoModel();
        $prestamos = $prestamo->getAllEnPrestamo();
        $prestamo->setEncabezado('finalizado');
        $estado = 3;
        require_once 'views/prestamo/listadoFinalizado.php';
    }

    // Listado prestamos recibidos con probmlemas.
    public function conProblemas() {
        $prestamo = new PrestamoModel();
        $prestamos = $prestamo->getAllEnPrestamo();
        $prestamo->setEncabezado('recibidos con problemas');
        $estado = 4;
        require_once 'views/prestamo/listadoConProblemas.php';
    }

    // Listado prestamos pro usuario.
    public function usuario() {
        $idUsuario = 2;
        $prestamos = new PrestamoModel();
        $solicitudes = $prestamo->getAllByUser($idUsuario);
        require_once 'views/solicitud/listadoPrestamo.php';
    }

    public function nuevo(){
        require_once 'views/solicitud/nuevo.php';
    }

    public function editarPendiente(){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $prestamo = new PrestamoModel();
            $prestamo->setIdPrestamo($id);
            $prest = $prestamo->getOne();
            require_once 'views/prestamo/editarPendiente.php';
        }else{
            header('Location'.URL.'prestamo/pendiente');
        }
    }

    public function editarEnPrestamo(){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $prestamo = new PrestamoModel();
            $prestamo->setIdPrestamo($id);
            $prest = $prestamo->getOne();
            require_once 'views/prestamo/editarEnPrestamo.php';
        }else{
            header('Location'.URL.'prestamo/enPrestamo');
        }
    }

    public function editarFinalizado(){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $prestamo = new PrestamoModel();
            $prestamo->setIdPrestamo($id);
            $prest = $prestamo->getOne();
            require_once 'views/prestamo/editarFinalizado.php';
        }else{
            header('Location'.URL.'prestamo/finalizado');
        }
    }

    public function editarConProblema(){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $prestamo = new PrestamoModel();
            $prestamo->setIdPrestamo($id);
            $prest = $prestamo->getOne();
            require_once 'views/prestamo/editarconProblema.php';
        }else{
            header('Location'.URL.'prestamo/conProblema');
        }
    }

    public function nuevoPrestamo($idSolicitud) {
        //Creo un prestamo en prestamos
        $saveGuardar = $this->guardar($idSolicitud);
        
        //Obtengo el id del nuevo prestamo.
        $idPrestamo = $this->idMaximo();
        $idPrestamo = $idPrestamo->id_prestamo;
        
        $idEstadoPrestamo = 1;

        //Update id_estado_prestamo en prestamos
        $saveInsertarEstadoPrestam = $this->insertarEstadoPrestamo($idPrestamo, $idEstadoPrestamo);

        //Creo un estado prestamo en prestamos_estados_prestamo.
        $saveNuevoEstadoIntermedia = $this->nuevoEstadoIntermedia($idPrestamo, $idEstadoPrestamo);


    
        $resultado = false;

        if($saveGuardar && $saveInsertarEstadoPrestam & $saveNuevoEstadoIntermedia) {
            $resultado = true;
        }

        return $resultado;

    }      

    public function guardar($idSolicitud) {
        $prestamo = new PrestamoModel();
        $prestamo->setIdSolicitud($idSolicitud);
        $resultado = $prestamo->save();
        return $resultado;    
    }

    public function insertarEstadoPrestamo($idPrestamo, $idEstadoPrestamo) {
        $prestamo = new PrestamoModel();
        $prestamo->setIdPrestamo($idPrestamo);
        $prestamo->setIdEstadoPrestamo($idEstadoPrestamo);
        $resultado = $prestamo->updateEstado();
        return $resultado;        
    }

    public function idMaximo(){
        $prestamo = new PrestamoModel();
        return $prestamo->maximoID();
    }

    public function nuevoEstadoIntermedia($idPrestamo, $idEstadoPrestamo) {
        $prestamoEstadoPrestamo = new PrestamoEstadoPrestamoModel();
        $prestamoEstadoPrestamo->setIdPrestamo($idPrestamo);
        $prestamoEstadoPrestamo->setIdEstadoPrestamo($idEstadoPrestamo);
        $resultado = $prestamoEstadoPrestamo->save();
        return $resultado;    
    }

    public function eliminarPrestamo($idPrestamo) {
        $prestamoEstadoPrestamo = new PrestamoEstadoPrestamoModel();
        $prestamoEstadoPrestamo->setIdPrestamo($idPrestamo);
        $resultado = $prestamoEstadoPrestamo->delete();
    }


    public function confirmarEntrega() {
        if(isset($_POST)) {
            $idPrestamo = isset($_POST['id_prestamo']) ? $_POST['id_prestamo']:false;
            $observacionPrestamo = isset($_POST['observacion_prestamo']) ? $_POST['observacion_prestamo']:false;
            $idHardware = isset($_POST['id_hardware']) ? $_POST['id_hardware']:false;
           

            if($idPrestamo && $observacionPrestamo && $idHardware) {
                $idEstadoPrestamo = 2;

                $prestamo = new PrestamoModel();
                $prestamo->setIdPrestamo($idPrestamo);
                $prestamo->setObservacionPrestamo($observacionPrestamo);
                $prestamo->setIdHardware($idHardware);

                $idPrestamo = $prestamo->getIdPrestamo();
                $observacionPrestamo = $prestamo->getObservacionPrestamo();
                $idHardware = $prestamo->getIdHardware();


                
                // Agrego id_hardware al prestamo
                $saveAgregarHardware = $prestamo->updateHardware();

                // Agrego observacion_prestamo al prestamo
                $saveAgregarObservacion = $prestamo->updateObservacion();

                // Cambio id_estado_prestamo en prestamos
                $saveInsertarEstadoPrestamo = $this->insertarEstadoPrestamo($idPrestamo, $idEstadoPrestamo);

                // Creo nuevo registro en prestamos_estados_prestamo
                $saveNuevoEstadoIntermedia = $this->nuevoEstadoIntermedia($idPrestamo, $idEstadoPrestamo);

                // Cambio id_estado_prestamo en hardwares
                $hardware = new HardwareController();
                $saveNuevoEstadoHardware = $hardware->setEstadoPrestamo($idHardware, $idEstadoPrestamo);     

                if ($saveAgregarHardware && $saveAgregarObservacion && $saveInsertarEstadoPrestamo && $saveNuevoEstadoIntermedia &&$saveNuevoEstadoHardware) {
                    $_SESSION['confirmarEntrega'] = "complete";               
                }else{
                    $_SESSION['confirmarEntrega'] = "failed";
                }                
            }else{
                $_SESSION['confirmarEntrega'] = "failed";
            }
        }   
        header("Location:".URL.'prestamo/pendiente');
    }

    function devolucion() {
        if(isset($_POST)) {
            $correcto = isset($_POST['correcto']) ? $_POST['correcto']:false;
            //$inconveniente = isset($_POST['inconveniente']) ? $_POST['inconveniente']:false;
            $idPrestamo = isset($_POST['id_prestamo']) ? $_POST['id_prestamo']:false;
            $idHardware = isset($_POST['id_hardware']) ? $_POST['id_hardware']:false;
            $observacionDevolucion = isset($_POST['observacion_devolucion']) ? $_POST['observacion_devolucion']:false;

            if($idPrestamo && $idHardware && $observacionDevolucion) {
                $idEstadoPrestamo = 4; //"Recibido con onconveniente"
                if($correcto){                    
                $idEstadoPrestamo = 3;

                $prestamo = new PrestamoModel();
                $prestamo->setIdPrestamo($idPrestamo);
                $prestamo->setObservacionDevolucion($observacionDevolucion);
                $prestamo->setIdHardware($idHardware);
                $prestamo->setIdEstadoPrestamo($idEstadoPrestamo);

                $idPrestamo = $prestamo->getIdPrestamo();
                $observacionDevolucion = $prestamo->getObservacionDevolucion();
                $idHardware = $prestamo->getIdHardware();

                // Cambiar id_estado_prestamo en prestamos.
                $saveInsertarEstadoPrestamo = $this->insertarEstadoPrestamo($idPrestamo, $idEstadoPrestamo);

                // Agregar observacion_devolucionen prestamos.
                $saveAgregarObservacion = $prestamo->updateObservacionDevolucion();


                // Crear registro en prestamos_estados_prestamo.
                $saveNuevoEstadoIntermedia = $this->nuevoEstadoIntermedia($idPrestamo, $idEstadoPrestamo);

                //Cambiar id_estado_prestamo en hardwares. 
                $hardware = new HardwareController();
                $saveNuevoEstadoHardware = $hardware->setEstadoPrestamo($idHardware, $idEstadoPrestamo);

            }else{

                $prestamo = new PrestamoModel();
                $prestamo->setIdPrestamo($idPrestamo);
                $prestamo->setObservacionDevolucion($observacionDevolucion);
                $prestamo->setIdHardware($idHardware);
                $prestamo->setIdEstadoPrestamo($idEstadoPrestamo);

                $idPrestamo = $prestamo->getIdPrestamo();
                $observacionDevolucion = $prestamo->getObservacionDevolucion();
                $idHardware = $prestamo->getIdHardware();

                $saveInsertarEstadoPrestamo = $this->insertarEstadoPrestamo($idPrestamo, $idEstadoPrestamo);

                // Agregar observacion_devolucion en prestamos.
                $saveAgregarObservacion = $prestamo->updateObservacionDevolucion();

                // Crear registro en prestamos_estados_prestamo.
                $saveNuevoEstadoIntermedia = $this->nuevoEstadoIntermedia($idPrestamo, $idEstadoPrestamo);

                //Cambiar id_estado_prestamo en hardwares. 
                $hardware = new HardwareController();
                $saveNuevoEstadoHardware = $hardware->setEstadoPrestamo($idHardware, $idEstadoPrestamo);

                }

                if ($saveInsertarEstadoPrestamo && $saveAgregarObservacion && $saveNuevoEstadoIntermedia && $saveNuevoEstadoHardware) {
                    $_SESSION['confirmarDevolucion'] = "complete";               
                }else{
                    $_SESSION['confirmarDevolucion'] = "failed";
                }                
            }else{
                $_SESSION['confirmarDevolucion'] = "failed";
            }
        }   
        header("Location:".URL.'prestamo/pendiente');
    }

    function devolucionCambiaEstado() {
        if(isset($_POST)) {
            $correcto = isset($_POST['correcto']) ? $_POST['correcto']:false;
            //$inconveniente = isset($_POST['inconveniente']) ? $_POST['inconveniente']:false;
            $idPrestamo = isset($_POST['id_prestamo']) ? $_POST['id_prestamo']:false;
            $idHardware = isset($_POST['id_hardware']) ? $_POST['id_hardware']:false;
            $observacionDevolucion = isset($_POST['observacion_devolucion']) ? $_POST['observacion_devolucion']:false;


                $idEstadoPrestamo = 3; //"Recibido con onconveniente"
                  
                $idEstadoPrestamo = 3;

                $prestamo = new PrestamoModel();
                $prestamo->setIdPrestamo($idPrestamo);
                $prestamo->setObservacionDevolucion($observacionDevolucion);
                $prestamo->setIdHardware($idHardware);
                $prestamo->setIdEstadoPrestamo($idEstadoPrestamo);

                $idPrestamo = $prestamo->getIdPrestamo();
                $observacionDevolucion = $prestamo->getObservacionDevolucion();
                $idHardware = $prestamo->getIdHardware();

                // Cambiar id_estado_prestamo en prestamos.
                $saveInsertarEstadoPrestamo = $this->insertarEstadoPrestamo($idPrestamo, $idEstadoPrestamo);

                // Agregar observacion_devolucionen prestamos.
                $saveAgregarObservacion = $prestamo->updateObservacionDevolucion();


                // Crear registro en prestamos_estados_prestamo.
                $saveNuevoEstadoIntermedia = $this->nuevoEstadoIntermedia($idPrestamo, $idEstadoPrestamo);

                //Cambiar id_estado_prestamo en hardwares. 
                $hardware = new HardwareController();
                $saveNuevoEstadoHardware = $hardware->setEstadoPrestamo($idHardware, $idEstadoPrestamo);

   

                if ($saveInsertarEstadoPrestamo && $saveAgregarObservacion && $saveNuevoEstadoIntermedia && $saveNuevoEstadoHardware) {
                    $_SESSION['confirmarDevolucion'] = "complete";               
            
            }else{
                $_SESSION['confirmarDevolucion'] = "failed";
            }
        }   
        header("Location:".URL.'prestamo/finalizado');
    }
}