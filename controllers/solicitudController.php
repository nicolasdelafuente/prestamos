<?php

require_once 'models/solicitudModel.php';
require_once 'models/solicitudEstadoSolicitudModel.php';
require_once 'controllers/prestamoController.php';

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
                
                
                $maximoId = $solicitud->maximoID();
                $maximo = $maximoId->id_solicitud;
                $maximoMasUno = $maximo + 1;

                if (isset($maximo)) {

                    $solicitudEstadoSolicitud = new SolicitudEstadoSolicitudModel();
                    $solicitudEstadoSolicitud->setIdSolicitud($maximoMasUno);
                    $solicitudEstadoSolicitud->setIdEstadoSolicitud(3);
                
                    $save1 = $solicitud->save(); 

                    if ($save1) {
                        $save2 = $solicitudEstadoSolicitud->save();

                    }else{
                        $_SESSION['register'] = "failed";
                    }
                    if($save1) {
                        $_SESSION['solicitar'] = "complete";
                    }else{
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
            header('Location'.URL.'solicitud/pendientes');
        }
    }

    public function confirmar(){
        
        var_dump($_POST);
        if(isset($_POST)) {
            $motivoAprobacion = isset($_POST['motivo_aprobacion']) ? $_POST['motivo_aprobacion']:false;
            $idSolicitud = isset($_POST['id_solicitud']) ? $_POST['id_solicitud']:false;
            $idHardware = isset($_POST['id_hardware']) ? $_POST['id_hardware']:false;

            if($motivoAprobacion && $idSolicitud && $idHardware) {

            
            // Creo estado APROBADO a la solciitud (En solicitudes_estados_solicitud).
            $solicitudEstadoSolicitud = new SolicitudEstadoSolicitudModel();
            $solicitudEstadoSolicitud->setIdSolicitud($idSolicitud);
            $estadoSolicitud = 1; //Solicitud aprobada
            $solicitudEstadoSolicitud->setIdEstadoSolicitud($estadoSolicitud);
            $saveSolicitudEstadoSolicitud = $solicitudEstadoSolicitud->save();
            var_dump($saveSolicitudEstadoSolicitud);


            // Cargo el motivo a la solicitud.
            $solicitud = new SolicitudModel();
            $solicitud->setMotivoAprobacion($motivoAprobacion);
            $solicitud->setIdSolicitud($idSolicitud);

            echo $solicitud->getIdSolicitud();
            echo $solicitud->getMotivoAprobacion();


            $saveSolicitud = $solicitud->editMotivo();
            var_dump($saveSolicitud);



            // Creo un nuevo prestamo.
            $prestamo = new PrestamoController();
            $savePrestamo = $prestamo->guardar($idSolicitud, $idHardware);
            var_dump($savePrestamo);


            // Creo un nuevo estado del préstamo.
            $prestamoEstadoPrestamo = new PrestamoEstadoPrestamoModel();
            //Obtengo el id para el nuevo prestamo
            $prestamoEstadoPrestamo->setIdPrestamo(1);
            $estadoPrestamo = 1; //Prestamo No entregado
            $prestamoEstadoPrestamo->setIdEstadoPrestamo($estadoPrestamo);
            $savePrestamoEstadoPrestamo = $prestamoEstadoPrestamo->save();
            var_dump($prestamoEstadoPrestamo);




                if($save1) {
                    $_SESSION['confirmar'] = "complete";
                }else{
                    $_SESSION['confirmar'] = "failed";
                }
            }else{
                $_SESSION['confirmar'] = "failed";
            }                
        }else{
            $_SESSION['confirmar'] = "failed";
        }

        /*header("Location:".URL.'hardware/index');*/
    }
}