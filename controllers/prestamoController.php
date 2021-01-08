<?php
require_once 'models/pestamoModel.php';
require_once 'models/prestamoEstadoPrestamoModel.php';

class PrestamoController{

    public function index(){
        return $this->noEntregado();
    }

    public function noEntregado() {
        $prestamo = new PrestamoModel();
        /*$prestamos = $prestamo->getAll();*/
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



    public function nuevo(){
        require_once 'views/prestamo/nuevo.php';
    }
    

    public function guardar($idSolicitud, $idHardware){
        $prestamo = new PrestamoModel();
        $prestamo->save($idSolicitud, $idHardware);
    }
    
    public function editar(){
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $prestamo = new prestamoModel();
            $prestamo->setIdprestamo($id);
            $soli = $prestamo->getOne();
            require_once 'views/prestamo/editar.php';
        }else{
            header('Location'.URL.'prestamo/pendientes');
        }
    }

    public function confirmar(){
        
        var_dump($_POST);
        if(isset($_POST)) {
            $motivoAprobacion = isset($_POST['motivo_aprobacion']) ? $_POST['motivo_aprobacion']:false;
            $idprestamo = isset($_POST['id_prestamo']) ? $_POST['id_prestamo']:false;
            $idHardware = isset($_POST['id_hardware']) ? $_POST['id_hardware']:false;

            if($motivoAprobacion && $idprestamo && $idHardware) {

            
            $prestamo = new prestamoModel();
            $prestamo->setMotivoAprobacion($motivoAprobacion); 
            $saveprestamo = $prestamostadoprestamo->editar();
            
            $prestamo = new PrestamoController();
            $prestamo->setId_prestamo($idprestamo);
            $prestamo->setId_Hardware($idHardware);
            $savePrestamo = $prestamo->save();

            $prestamostadoprestamo = new prestamoEstadoprestamoModel();
            $prestamostadoprestamo->setIdprestamo();
            $prestamostadoprestamo->setIdEstadoprestamo();
            $saveprestamoEstadoprestamo = $prestamostadoprestamo->save();
            
            $prestamostadoPrestamo = new PrestamoEstadoPrestamoModel();
            $prestamostadoPrestamo->setIDPrestamo();
            $estadoPrestamo = 1; //Estado No entregado
            $prestamostadoPrestamo->setIdEstadoPrestamo($estadoPrestamo);
            $savePrestamoEstadoPrestamo = $prestamostadoPrestamo->save();




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


    function obtenerMáximoId() {
        $prestamo = new PrestamoModel();
        return $prestamo->maximoID(); 
    }
}