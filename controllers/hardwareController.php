<?php

require_once 'models/hardwareModel.php';
require_once 'models/hardwareEstadoHardwareModel.php';
class HardwareController{

    public function index(){
        return $this->activo();
    }

    public function activo() {
        $hardware = new HardwareModel();
        $hardwares = $hardware->getAll();
        $hardware->setEncabezado('activo');
        $estado = 1;
        require_once 'views/hardware/listado.php';
    }

    public function inactivo() {
        $hardware = new HardwareModel();
        $hardwares = $hardware->getAll();
        $hardware->setEncabezado('inactivo');
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
            $idEstadoPrestamo = 1;  //No entregado

            if($idTipo && $idMarca && $numeroSerie && $idEstadoHardware) {

                $hardware = new HardwareModel();
                $hardware->setIdTipoHardware($idTipo);
                $hardware->setIdMarca($idMarca);
                $hardware->setDescripcion($descripcion);
                $hardware->setModelo($modelo);
                $hardware->setNumeroSerie($numeroSerie);
                $hardware->setCodigoInterno($codigoInterno);
                $hardware->setIdEstadoHardware($idEstadoHardware);
                $hardware->setIdEstadoPrestamo($idEstadoPrestamo);

                $saveHardware = $hardware->save();

                var_dump($saveHardware);

                if($saveHardware) {
                    $id = $hardware->maximoID();
                    $id = $id->id_hardware;

                    // Set estado hardware                         
                    $hardwareEstadoHardware = new HardwareEstadoHardwareModel();
                    $hardwareEstadoHardware->setIdHardware('no');
                    $hardwareEstadoHardware->setIdEstadoHardware($idEstadoHardware);

                    $saveEstadoHardware = $hardwareEstadoHardware->save();

                    if($saveEstadoHardware) {
                        $_SESSION['register'] = "complete";
                    } else {
                        $id = $hardware->maximoID();
                        $id = $id->id_hardware;
                        $hardware->delete($id);
                        $_SESSION['register'] = "failed";
                    }   
                }else{
                    $_SESSION['register'] = "failed";
                }
            }else{
                $_SESSION['register'] = "failed";
            }                
        }else{
            $_SESSION['register'] = "failed";
        }
        header("Location:".URL.'hardware/index');
        
    }

    public function editar(){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $hardware = new HardwareModel();
            $hardware->setIdHardware($id);
            $hard = $hardware->getOne();
            require_once 'views/hardware/editar.php';
        }else{
            header('Location'.URL.'hardware/index');
        }
    }


    public function edicion(){
        
        if(isset($_POST)) {
            $idHardware = isset($_POST['id_hardware']) ? $_POST['id_hardware']:false;
            $idTipoHardware = isset($_POST['id_tipo_hardware']) ? $_POST['id_tipo_hardware']:false;
            $idMarca = isset($_POST['id_marca']) ? $_POST['id_marca']:false;
            $descripcion = isset($_POST['descripcion_hardware']) ? $_POST['descripcion_hardware']:false;
            $modelo = isset($_POST['modelo']) ? $_POST['modelo']:false;
            $numeroSerie = isset($_POST['numero_serie']) ? $_POST['numero_serie']:false;
            $codigoInterno = isset($_POST['codigo_interno']) ? $_POST['codigo_interno']:false;
            $idEstadoHardware = isset($_POST['id_estado_hardware']) ? $_POST['id_estado_hardware']:false;

            if($idTipoHardware && $idMarca && $modelo && $numeroSerie && $idEstadoHardware) {

                $hardware = new HardwareModel();
                $hardware->setIdHardware($idHardware);
                $hardware->setIdTipoHardware($idTipoHardware);
                $hardware->setIdMarca($idMarca);
                $hardware->setDescripcion($descripcion);
                $hardware->setModelo($modelo);
                $hardware->setNumeroSerie($numeroSerie);
                $hardware->setCodigoInterno($codigoInterno);
                $hardware->setIdEstadoHardware($idEstadoHardware);

                $idHardware = $hardware->getIdHardware();  

                // Estado hardware en BD.
                $idEstadoHardwareActual = $hardware->estadoHardwareActual($idHardware);
                $idEstadoHardwareActual = $idEstadoHardwareActual->id_estado_hardware;
                  
                // Estado hardware recibido por POST.
                $idNuevoEstadoHardware = ($hardware->getIdEstadoHardware());
                
                // Comparo estados hardware.
                $comparaEstadoHardware = ($idEstadoHardwareActual == $idNuevoEstadoHardware);

                // Edito el hardware
                $saveHardware = $hardware->edit($idHardware);
                var_dump($saveHardware);
                
                if ($saveHardware) {
                    // Ver si el estado hardware no se modificó
                    if($comparaEstadoHardware == FALSE) {
                        $hardwareEstadoHardware = new HardwareEstadoHardwareModel();
                        $hardwareEstadoHardware->setIdHardware($idHardware);
                        $hardwareEstadoHardware->setIdEstadoHardware($idNuevoEstadoHardware);
                        $hardwareEstadoHardware->save();
                    }
                    $_SESSION['edit'] = "complete";
                }else{
                    $_SESSION['edit'] = "failed";
                }                
            }else{
                $_SESSION['edit'] = "failed";
            }
        }   
        /*header("Location:".URL.'hardware/activo');*/
    }

}