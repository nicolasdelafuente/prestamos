<?php

require_once 'models/solicitudModel.php';
require_once 'models/solicitudEstadoSolicitudModel.php';
require_once 'models/hardwareModel.php';
require_once 'models/prestamoEstadoPrestamoModel.php';
require_once 'models/prestamoModel.php';


class SolicitudController{

    public function index(){
        return $this->pendientes();
    }

    public function pendientes() {
        $solicitud = new SolicitudModel();
        $solicitudes = $solicitud->getAll();
        $solicitud->setEncabezado('pendientes');
        $estado = 3;
        require_once 'views/solicitud/listado.php';
    }

    public function aprobadas() {
        $solicitud = new SolicitudModel();
        $solicitudes = $solicitud->getAll();
        $solicitud->setEncabezado('aprobadas');
        $estado = 1;
        require_once 'views/solicitud/listado.php';
    }

    public function desaprobadas() {
        $solicitud = new SolicitudModel();
        $solicitudes = $solicitud->getAll();
        $solicitud->setEncabezado('desaprobadas');
        $estado = 2;
        require_once 'views/solicitud/listado.php';
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


            if($idTipoHardware && $idEdificio && $idUsuario && $fechaDesde && $fechaHasta && $motivoSolcitud) {

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
           /*header("Location:".URL.'solicitud/nuevo');*/
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
            header('Location'.URL.'solicitud/pendientes');
        }
    }

    public function confirmar(){
        
        if(isset($_POST)) {
            $motivoAprobacion = isset($_POST['motivo_aprobacion']) ? $_POST['motivo_aprobacion']:false;
            $idSolicitud = isset($_POST['id_solicitud']) ? $_POST['id_solicitud']:false;
            $idHardware = isset($_POST['id_hardware']) ? $_POST['id_hardware']:false;

            if($motivoAprobacion && $idSolicitud && $idHardware) {
                
                $solicitudEstadoSolicitud = new SolicitudEstadoSolicitudModel();
                $hardware = new HardwareModel();
                $prestamoEstadoPrestamo = new PrestamoEstadoPrestamoModel();
                $prestamoModel = new PrestamoModel();
                $solicitudModel = new SolicitudModel();
                
                $idEstadoSolicitud = 1; // Aprobado.
                $idEstadoPrestamo = 1; // Asignado / no entregado.


                //EDITAR: solicitudes.id_estado_solicitud
                $solicitudModel->setMotivoAprobacion($motivoAprobacion);
                $solicitudModel->setIdEstadoSolicitud($idEstadoSolicitud);
                $solicitudModel->setIdSolicitud($idSolicitud);
                $saveEstadoSolicitud = $solicitudModel->aprobarSolicitud();

                //CREAR: solicitudes_estados_solicitud.idestado_solicitud OK               
                $solicitudEstadoSolicitud->setIdSolicitud($idSolicitud);
                $solicitudEstadoSolicitud->setIdEstadoSolicitud($idEstadoSolicitud);    
                $saveSolicitudEstadoSolicitud = $solicitudEstadoSolicitud->save();  

                //EDITAR: hardwares.id_estado_prestamo                
                $saveEstadoHardware = $hardware->actualizarEstadoPrestamo($idHardware, $idEstadoPrestamo);

                //CREAR: prestamos.id_estados_prestamos
                $idSolicitud = (int)$idSolicitud;
                $idHardware = (int)$idHardware;
                $idEstadoPrestamo = (int)$idEstadoPrestamo;
                $savePrestamo = $prestamoModel->save($idSolicitud, $idHardware, $idEstadoPrestamo);

                //CREAR: prestamos_estados_prestamo.id_estado_prestamo
                $idPrestamo = $prestamoModel->maximoID();
                $idPrestamo = $idPrestamo->id_prestamo; 
                $prestamoEstadoPrestamo->setIdPrestamo($idPrestamo);
                $prestamoEstadoPrestamo->setIdEstadoPrestamo($idEstadoPrestamo);
                $savePrestamoEstadoPrestamo = $prestamoEstadoPrestamo->save();                           
            
        

                if($saveEstadoSolicitud && $saveSolicitudEstadoSolicitud && $saveEstadoHardware && $savePrestamo && $savePrestamoEstadoPrestamo) {
                    $_SESSION['confirmarSolicitud'] = "complete";
                }else{
                    $_SESSION['confirmarSolicitud'] = "failed";
                }

            }else{
                $_SESSION['confirmarSolicitud'] = "failed";
            }                
        }else{
            $_SESSION['confirmarSolicitud'] = "failed";
        }

       header("Location:".URL.'solicitud/index');
    }
}