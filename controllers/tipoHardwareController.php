<?php

    require_once 'models/tipoHardwareModel.php';

    class TipoHardwareController{

        public function index() {
            $tipoHardware = new TipoHardwareModel();
            $tiposHardware = $tipoHardware->getAll();
            require_once 'views/contents/tablaTipoHardware.php';
        }

        public function registro() {
            require_once 'views/contents/nuevoTipoHardware.php';
        }

        public function guardar() {
            if(isset($_POST)) {

                $tipoHardwareNombre = isset($_POST['tipo_hardware']) ? $_POST['tipo_hardware'] : false;

                if($tipoHardwareNombre) {
                    $tipoHardware = new TipoHardwareModel();
                    $tipoHardware->setTipoHardware($tipoHardwareNombre);

                    
                    $dato = $tipoHardware->guardar();
                    if($dato){
                        $_SESSION['register'] = "complete";
                    }else{
                        $_SESSION['register'] = "failed";
                    }
                }else{
                    $_SESSION['register'] = "failed";
                }
            }else{
                $_SESSION['register'] = "failed";
            }
            header("Location:".base_url.'tipoUsuario/registro');
        }
}