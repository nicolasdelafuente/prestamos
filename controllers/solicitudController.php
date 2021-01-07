<?php

require_once 'models/solicitudModel.php';
/*require_once 'controllers/prestamoController.php';*/

class SolicitudController{

    public function index(){
        echo "desde SolicitudController/index";
    }



    public function solicitar(){
        require_once 'views/solicitud/solicitud.php';
    }

    public function save(){
        if(isset($_POST)) {
            $idTipoHardware = isset($_POST['id_tipo']) ? $_POST['id_tipo']:false;
            $idEdificio = isset($_POST['id_edificio']) ? $_POST['id_edificio']:false;
            $idUsuario = isset($_POST['id_usuario']) ? $_POST['id_usuario']:false;
            $fechaDesde = isset($_POST['fecha_desde']) ? $_POST['fecha_desde']:false;
            $fechaHasta = isset($_POST['fecha_hasta']) ? $_POST['fecha_hasta']:false;
            $motivo_solciitud = isset($_POST['motivo_solicitud']) ? $_POST['motivo_solicitud']:false;

            if($idTipoHardware && $idEdificio && $idUsuario && $fechaDesde && $fechaHasta && $motivo_solciitud) {

                $solicitud = new SolicitudModel();
                $solicitud->setIdTipoHardware($idTipoHardware);
                $solicitud->setIdEdificio($idEdificio);
                $solicitud->setIdusuario($idUsuario);
                $solicitud->setFechaDesde($fechaDesde);
                $solicitud->setFechaHasta($fechaHasta);
                $solicitud->setMotivoSolicitud($motivo_solciitud);     
            
                
                
                $save = $solicitud->save(); 

                if($save) {
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
        header("Location:".URL.'solicitud/solicitar');

        


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

            if($motivoAprobacion && $idSolicitud) {

            
            $solicitud = new SolicitudModel();
            $solicitud->setMotivoAprobacion($motivoAprobacion); 
            
            $prestamo = new PrestamoController();
            $prestamo->save();
            
            $id = (int)$idSolicitud; 
            if(isset($idHardware)) {                
                $save = $solicitud->estadoAprobado($id);
            }else{
                Echo "Desaprobado";
                $save = $solicitud->estadoDesAprobado($id);
            }




                if($save) {
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