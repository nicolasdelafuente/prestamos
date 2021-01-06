<?php

require_once 'models/hardwaresModel.php';
require_once 'models/hardwaresEstadosHardwareModel.php';

class HardwareController{

    public function index(){
        return $this->activo();
    }

    public function activo() {
        $hardware = new HardwareModel();
        $hardwares = $hardware->getAll();
        $titulo = $hardware->getEncabezado('activo');
        $estado = 1;
        require_once 'views/hardware/listado.php';
    }

    public function inactivo() {
        $hardware = new HardwareModel();
        $hardwares = $hardware->getAll();
        $titulo = $hardware->getEncabezado('inactivo');
        $estado = 2;
        require_once 'views/hardware/listado.php';
    }

    public function nuevo(){
        require_once 'views/hardware/nuevo.php';
    }

    public function guardar(){
        
        if(isset($_POST)) {
            $idTipo = isset($_POST['id_tipo']) ? $_POST['id_tipo']:false;
            $idMarca = isset($_POST['id_marca']) ? $_POST['id_marca']:false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion']:false;
            $modelo = isset($_POST['modelo']) ? $_POST['modelo']:false;
            $numeroSerie = isset($_POST['numero_serie']) ? $_POST['numero_serie']:false;
            $codigoInterno = isset($_POST['codigo_interno']) ? $_POST['codigo_interno']:false;

            $idEstadoHardware = isset($_POST['id_estado_hardware']) ? $_POST['id_estado_hardware']:false;


            if($idTipo && $idMarca && $numeroSerie && $idEstadoHardware) {

                $hardware = new HardwareModel();
                $hardware->setIdTipoHardware($idTipo);
                $hardware->setIdMarca($idMarca);
                $hardware->setDescripcion($descripcion);
                $hardware->setModelo($modelo);
                $hardware->setNumeroSerie($numeroSerie);
                $hardware->setCodigoInterno($codigoInterno);

                $maximoId = $hardware->maximoID();
                $maximo = $maximoId->id_hardware;
                $maximoMasUno = $maximo + 1;


                if ($maximo > 0) {
                
                    $hardwareEstadoHardware = new HardwareEstadoHardwaresModel();
                    $hardwareEstadoHardware->setIdHardware($maximoMasUno);
                    $hardwareEstadoHardware->setIdEstadoHardware($idEstadoHardware);
                    

                    $save1 = $hardware->save();
                    $save2 = $hardwareEstadoHardware->save();
                }else{
                    $_SESSION['register'] = "failed";
                }
                if($save1 && $save2) {
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
        header("Location:".URL.'hardware/nuevo');
    }

}