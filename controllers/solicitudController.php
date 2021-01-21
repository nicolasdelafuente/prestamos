<?php

require_once 'models/solicitudModel.php';
require_once 'models/solicitudEstadoSolicitudModel.php';
require_once 'controllers/prestamoController.php';
class SolicitudController{

    public function index(){
        return $this->pendiente();
    }

    // Listado solicitudes aprobadas.
    public function aprobada() {
        $solicitud = new SolicitudModel();
        $solicitudes = $solicitud->getAll();
        $solicitud->setEncabezado('aprobadas');
        $estado = 1;
        require_once 'views/solicitud/listado2.php';
    }

    // Listado solicitudes desaprobadas.
    public function desaprobada() {
        $solicitud = new SolicitudModel();
        $solicitudes = $solicitud->getAll();
        $solicitud->setEncabezado('desaprobadas');
        $estado = 2;
        require_once 'views/solicitud/listado2.php';
    }

    // Listado solicitudes pendientes.
    public function pendiente() {
        $solicitud = new SolicitudModel();
        $solicitudes = $solicitud->getAll();
        $solicitud->setEncabezado('pendientes');
        $estado = 3;
        require_once 'views/solicitud/listado.php';
    }

    // Listado solicitudes pro usuario.
    public function usuario() {
        $idUsuario = 2;
        $solicitud = new SolicitudModel();
        $solicitudes = $solicitud->getAllByUser($idUsuario);
        require_once 'views/solicitud/listadoUsuario.php';
    }

    public function nuevo(){
        require_once 'views/solicitud/nuevo.php';
    }
    
    
    public function guardar(){
        if(isset($_POST)) {
            $idTipoHardware = isset($_POST['id_tipo_hardware']) ? $_POST['id_tipo_hardware']:false;
            $idEdificio = isset($_POST['id_edificio']) ? $_POST['id_edificio']:false;
            $idUsuario = isset($_POST['id_usuario']) ? $_POST['id_usuario']:false;
            $fechaDesde = isset($_POST['fecha_desde']) ? $_POST['fecha_desde']:false;
            $fechaHasta = isset($_POST['fecha_hasta']) ? $_POST['fecha_hasta']:false;
            $motivoSolcitud = isset($_POST['motivo_solicitud']) ? $_POST['motivo_solicitud']:false;

            $fechas = $fechaDesde <= $fechaHasta;


            if($idTipoHardware && $idEdificio && $idUsuario && $fechaDesde && $fechaHasta && $motivoSolcitud && $fechas) {

                $solicitud = new SolicitudModel();
                $solicitud->setIdTipoHardware($idTipoHardware);
                $solicitud->setIdEdificio($idEdificio);
                $solicitud->setIdusuario($idUsuario);
                $solicitud->setFechaDesde($fechaDesde);
                $solicitud->setFechaHasta($fechaHasta);
                $solicitud->setMotivoSolicitud($motivoSolcitud);
            

          
                //Creo una solicitud
                $saveSolicitud = $solicitud->save();

                //Obtengo el ID de la nueva solciitud.
                $maximoId = $solicitud->maximoID();
                $maximoId = $maximoId->id_solicitud;

                //Si existe la nueva solicitud => creo un nuevo estado de la solicitud en tabla intermedia.
                if ($saveSolicitud) {
                    $solicitudEstadoSolicitud = new SolicitudEstadoSolicitudModel();
                    $solicitudEstadoSolicitud->setIdSolicitud($maximoId);
                    $solicitudEstadoSolicitud->setIdEstadoSolicitud(3);

                    
                    $saveEstadoSolicitud = $solicitudEstadoSolicitud->save();
                               
                     //Si existe el estado en tabla intermedia => creo un nuevo estado de la solicitud en tabla intermedia.
                    if($saveEstadoSolicitud) {                        
                        $_SESSION['solicitar'] = "complete";
                    }else{
                        // Si no existe el estado en tabla intermedia => elimino la solicitud creada.
                        $solicitud->delete($maximoId);
                        $_SESSION['solicitar'] = "failed";
                    }
                }else{
                    $_SESSION['solicitar'] = "failed";
                }                
            }else{
                $_SESSION['solicitar'] = "failed";
            }
           header("Location:".URL.'solicitud/nuevo');
        }
    }

    public function editar(){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $solicitud = new SolicitudModel();
            $solicitud->setIdSolicitud($id);
            $soli = $solicitud->getOne();
            require_once 'views/solicitud/editar.php';
        }else{
            header('Location'.URL.'solicitud/pendiente');
        }
    }

    public function ver(){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $solicitud = new SolicitudModel();
            $solicitud->setIdSolicitud($id);
            $soli = $solicitud->getOne();
            require_once 'views/solicitud/ver.php';
        }else{
            header('Location'.URL.'solicitud/pendiente');
        }
    }

    public function confirmarSolicitud() {
        if(isset($_GET['id'])) {
            $id= $_GET['id'];

            $solicitud = new SolicitudModel();
            $solicitud->setIdSolicitud($id);
            $idSolicitud = $solicitud->getIdSolicitud();
            $idEstadoSolicitud = 1; //Solicitud Aprobada        

            $saveEditarEstadoSolicitud = $this->editarEstadoSolicitud($idSolicitud, $idEstadoSolicitud);
            $saveNuevoEstadoIntermedia = $this->nuevoEstadoIntermedia($idSolicitud, $idEstadoSolicitud);

            $prestamo = new PrestamoController();
            $saveNuevoPrestamo = $prestamo->nuevoPrestamo($idSolicitud);

            if($saveEditarEstadoSolicitud && $saveNuevoEstadoIntermedia && $saveNuevoPrestamo ) 
                $_SESSION['confirmarSolicitud'] = "complete";
            }else{
                $_SESSION['confirmarSolicitud'] = "failed";
        }
        header("Location:".URL.'solicitud/pendiente');
    }
    
    
    public function rechazarSolicitud() {
        if(isset($_GET['id'])) {
            $id= $_GET['id'];

            $solicitud = new SolicitudModel();
            $solicitud->setIdSolicitud($id);
            $idSolicitud = $solicitud->getIdSolicitud();
            $idEstadoSolicitud = 2; //Solicitud Aprobada        

            $saveEditarEstadoSolicitud = $this->editarEstadoSolicitud($idSolicitud, $idEstadoSolicitud);
            $saveNuevoEstadoIntermedia = $this->nuevoEstadoIntermedia($idSolicitud, $idEstadoSolicitud);

            
            if($saveEditarEstadoSolicitud && $saveNuevoEstadoIntermedia) 
                $_SESSION['rechazarSolicitud'] = "complete";
            }else{
                $_SESSION['rechazarSolicitud'] = "failed";
        }
        header("Location:".URL.'solicitud/pendiente');
    }
        



    public function editarEstadoSolicitud($idSolicitud, $idEstadoSolicitud) {
        $solicitud = new SolicitudModel();
        $solicitud->setIdSolicitud($idSolicitud);
        $solicitud->setIdEstadoSolicitud($idEstadoSolicitud);
        $resultado = $solicitud->updateEstado();
        return $resultado;
    }

    public function nuevoEstadoIntermedia($idSolicitud, $idEstadoSolicitud) {
        $solicitudEstadoSolicitud = new SolicitudEstadoSolicitudModel();
        $solicitudEstadoSolicitud->setIdSolicitud($idSolicitud);
        $solicitudEstadoSolicitud->setIdEstadoSolicitud($idEstadoSolicitud);
        $resultado = $solicitudEstadoSolicitud->save();
        return $resultado;    
    }


    
    

}