<?php

    require_once 'models/hardwareModel.php';

    class HardwareController{

        public function index() {
            $hardware = new HardwareModel();
            $hardwares = $hardware->getAll();
            require_once 'views/contents/tablaHardware.php';
        }

        public function regregistrar() {
            require_once 'views/contents/nuevoHardware.php';
        }

        public function guardar() {
            if(isset($_POST)) {

                $idTipo = isset($_POST['id_tipo']) ? $_POST['id_tipo'] : false;
                $idMarca = isset($_POST['id_marca']) ? $_POST['id_marca'] : false;
                $idEstadoHardware = isset($_POST['id_estado_hardware']) ? $_POST['id_estado_hardware'] : false;
                $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
                $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : false;
                $numeroSerie = isset($_POST['numero_serie']) ? $_POST['numero_serie'] : false;
                $numeroUnahur = isset($_POST['numero_unahur']) ? $_POST['numero_unahur'] : false;

                if($idTipo && $idMarca && $idEstadoHardware && $descripcion && $modelo && $numeroSerie && $numeroUnahur) {
                    $hardware = new HardwareModel();
                    $hardware->setIdTipo((int)$idTipo);
                    $hardware->setIdMarca((int)$idMarca);
                    $hardware->setIdEstadoHardware((int)$idEstadoHardware);
                    $hardware->setDescripcion($descripcion);
                    $hardware->setModelo($modelo);
                    $hardware->setNumeroSerie($numeroSerie);
                    $hardware->setNumeroUnahur($numeroUnahur);
                    
                    $dato = $hardware->guardar();

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
            header("Location:".base_url.'hardware/registro');
        }
    }