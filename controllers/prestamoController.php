<?php
require_once 'models/prestamoModel.php';
require_once 'models/prestamoEstadoPrestamoModel.php';
require_once 'models/hardwareModel.php';

class PrestamoController{

    public function index(){
        return $this->noEntregado();
    }

    public function noEntregado() {
        $prestamo = new PrestamoModel();
        $prestamos = $prestamo->getAll();
        $prestamo->setEncabezado('no entregados');
        $estado = 1;
        require_once 'views/prestamo/listado.php';
    }

    public function entregado() {
        $prestamo = new PrestamoModel();
        $prestamos = $prestamo->getAll();
        $prestamo->setEncabezado('entregados');
        $estado = 2;
        require_once 'views/prestamo/listado.php';
    }

    public function recibido() {
        $prestamo = new PrestamoModel();
        $prestamos = $prestamo->getAll();
        $prestamo->setEncabezado('recibidos');
        $estado = 3;
        require_once 'views/prestamo/listado.php';
    }

    public function noRecibido() {
        $prestamo = new PrestamoModel();
        $prestamos = $prestamo->getAll();
        $prestamo->setEncabezado('no recibidos');
        $estado = 4;
        require_once 'views/prestamo/listado.php';
    }

    public function recibidoConProblema() {
        $prestamo = new PrestamoModel();
        $prestamos = $prestamo->getAll();
        $prestamo->setEncabezado('recibido con problema');
        $estado = 4;
        require_once 'views/prestamo/listado.php';
    }


    public function confirmarPrestamo() {
        $id_prestamo =  isset($_GET['id']) ? $_GET['id']:false;

        if($id_prestamo) {
                
            $idEstadoPrestamo = 2;
            $prestamo = new PrestamoModel();
            $prestamo->setIdPrestamo($id_prestamo);
            $prestamo->setIdEstadoPrestamo($idEstadoPrestamo);

            $save = $prestamo->cambiarEstado();

            $hardware = new HardwareModel();
            

        }

        /*header("Location:".URL.'prestamo/noEntregado');*/
    }

/*
    public function actualizarEstado($idHardware, $idPrestamo, $idEstadoPrestamo){
        
        $hardware = new HardwareModel();
        $saveHardware = $hardware->actualizarEstadoPrestamo($idHardware, $idEstadoPrestamo);


        $prestamoEstadoPrestamo = new PrestamoEstadoPrestamoModel();
        $prestamoEstadoPrestamo->setIdPrestamo($idPrestamo);
        $prestamoEstadoPrestamo->setIdEstadoPrestamo($idEstadoPrestamo);
        $savePrestamoEstadoPrestamo  = $prestamoEstadoPrestamo->save();
        var_dump($savePrestamoEstadoPrestamo);
    }
*/
}