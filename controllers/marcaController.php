<?php

    require_once 'models/marcaModel.php';

    class MarcaController{

        public function index() {
            $marca = new MarcaModel();
            $marcas = $marca->getAll();
            require_once 'views/contents/tablaMarca.php';
        }
    
        public function registro() {
            require_once 'views/contents/nuevoMarca.php';
        }

        public function guardar() {
            if(isset($_POST)) {

                $marcaNombre = isset($_POST['marca']) ? $_POST['marca'] : false;

                if($marcaNombre) {
                    $marca = new MarcaModel();
                    $marca->setMarca($marcaNombre);

                    
                    $dato = $marca->guardar();
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
            header("Location:".base_url.'marca/registro');
        }

}