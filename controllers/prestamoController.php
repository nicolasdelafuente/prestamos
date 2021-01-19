<?php

require_once 'models/prestamoModel.php';
require_once 'modelsprestamoEstadoPrestamo.php';
require_once 'controllers/hardwareController.php';
class PrestamoController{

    public function index(){
        return $this->pendiente();
    }


    // Listado prestamos pendientes de entrega.
    public function pendiente() {
        $prestamo = new PrestamoModel();
        $prestamos = $prestamo->getAll();
        $prestamo->setEncabezado('pendientes de entrega');
        $estado = 1;
        require_once 'views/prestamo/listado.php';
    }

    // Listado prestamos en curso.
    public function enPrestamo() {
        $prestamo = new PrestamoModel();
        $prestamos = $prestamo->getAll();
        $prestamo->setEncabezado('en curso');
        $estado = 2;
        require_once 'views/prestamo/listado.php';
    }

    // Listado prestamos en finalizados.
    public function finalizado() {
        $prestamo = new PrestamoModel();
        $prestamos = $prestamo->getAll();
        $prestamo->setEncabezado('finalizados');
        $estado = 3;
        require_once 'views/prestamo/listado.php';
    }

    // Listado prestamos recibidos con probmlemas.
    public function conProblemas() {
        $prestamo = new PrestamoModel();
        $prestamos = $prestamo->getAll();
        $prestamo->setEncabezado('recibidos con problemas');
        $estado = 4;
        require_once 'views/prestamo/listado.php';
    }


    public function nuevo($idSolicitud, $idHardware, $idEstadoHardware) {
        $prestamo = new PrestamoModel();
        $prestamo->setIdSolicitud($idSolicitud);
        $prestamo->setIdHardware($idHardware);
        $prestamo->save();


        $this->setEstadoHardware($idHardware, $idEstadoHardware);
        $this->setHardwareEstadoHardware($idHardware, $idEstadoHardware);
    }

    public function setEstadoHardware($idHardware, $idEstadoHardware) {
        $hardware = new HardwareControler();
        $resultado = $hardware->setEstadoHardware($idHardware, $idEstadoHardware);
        return $resultado;                      
    }


    public function setHardwareEstadoHardware($idHardware, $idEstadoHardware){
        $hardwareEstadoHardware = new HardwareEstadoHardwareModel();
        $hardwareEstadoHardware->setEstadoHardware($idEstadoHardware);
        $hardwareEstadoHardware->setIdHardware($idHardware);
        $hardwareEstadoHardware->save();
    }

}