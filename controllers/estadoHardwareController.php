<?php

    require_once 'models/estadoHardwareModel.php';

    class estadoHardwareController{

        public function index() {
            $estadoHardware = new EstadoHardwareModel();
            $estadosHardware = $estadoHardware->getAll();
            require_once 'views/contents/tablaEstadoHardware.php';
        }

        public function registro() {
            require_once 'views/contents/nuevoEstadoHardware.php';
        }

        public function guardar() {
            if(isset($_POST)) {

                $estadoHardwareNombre = isset($_POST['estado_hardware']) ? $_POST['estado_hardware'] : false;
                $color = isset($_POST['color']) ? $_POST['color'] : false;

                if($estadoHardwareNombre && $color) {
                    $estadoHardware = new EstadoHardwareModel();
                    $estadoHardware->setEstadoHardware($estadoHardwareNombre);
                    $estadoHardware->setColor($color);
                    
                    $dato = $estadoHardware->guardar();
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
            header("Location:".base_url.'estadoHardware/registro');
        }
}