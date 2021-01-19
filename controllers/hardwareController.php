<?php

require_once 'models/hardwareModel.php';
require_once 'models/hardwareEstadoHardwareModel.php';
class HardwareController{

    public function index(){
        return $this->activo();
    }

    // Listado hardwares activos.
    public function activo() {
        $hardware = new HardwareModel();
        $hardwares = $hardware->getAll();
        $hardware->setEncabezado('activo');
        $estado = 1;
        require_once 'views/hardware/listado.php';
    }

    // Listado hardwares inactivos.
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
            $idEstadoPrestamo = 3;  // Finalizado

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

                

                if($saveHardware) {
                    //Obtengo el máximo hardwares.id_hardware
                    $maximoIdHardware = $hardware->maximoID();
                    $maximoIdHardware = $maximoIdHardware->id_hardware;

                    // Seteo, hardware_estados_hardware el estado del nuevo hardware
                    $hardwareEstadoHardware = new HardwareEstadoHardwareModel();
                    $hardwareEstadoHardware->setIdHardware($maximoIdHardware);
                    $hardwareEstadoHardware->setIdEstadoHardware($hardware->getIdEstadoHardware());
                    $saveHardwareEstadoHardware = $hardwareEstadoHardware->save();
                    
                    if($saveHardwareEstadoHardware) {
                        $_SESSION['hardwareRegistrado'] = "complete";
                    }else {
                        //Elimino el hardware recien creado
                        $hardware->delete($maximoIdHardware);
                    $_SESSION['hardwareRegistrado'] = "failed";
                    }
                }
            }else{
                $_SESSION['hardwareRegistrado'] = "failed";
            }                
        }else{
            $_SESSION['hardwareRegistrado'] = "failed";
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
                $idEstadoHardwareActual = $hardware->estadoHardwareActual($hardware->getIdHardware());
                $idEstadoHardwareActual = $idEstadoHardwareActual->id_estado_hardware;
                  
                // Estado hardware recibido por POST.
                $idNuevoEstadoHardware = ($hardware->getIdEstadoHardware());
                
                // Comparo estados hardware.
                $comparaEstadoHardware = ($idEstadoHardwareActual == $idNuevoEstadoHardware);

                // Edito el hardware
                $saveHardware = $hardware->edit($hardware->getIdHardware());
                
                if ($saveHardware) {
                    // Ver si el estado hardware no se modificó
                    if($comparaEstadoHardware == FALSE) {
                        $hardwareEstadoHardware = new HardwareEstadoHardwareModel();
                        $hardwareEstadoHardware->setIdHardware($idHardware);
                        $hardwareEstadoHardware->setIdEstadoHardware($idNuevoEstadoHardware);
                        $hardwareEstadoHardware->save();
                    }
                    $_SESSION['editHardware'] = "complete";
                }else{
                    $_SESSION['editHardware'] = "failed";
                }                
            }else{
                $_SESSION['editHardware'] = "failed";
            }
        }   
        header("Location:".URL.'hardware/index');
    }

    function setEstado($idHardware, $idEstadoHardware) {
        $hardware = new HardwareModel();
        $hardware->setIdHardware($idHardware);
        $hardware->getIdEstadoHardware($idEstadoHardware);
        $resultado = $hardware->editEstado();
        return $resultado;
    }

}