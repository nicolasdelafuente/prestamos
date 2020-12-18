<?php
        function mostrarError() {
            $error = new ErrorController();
            $error->index();
        }


        // Compruebo si llega el controlador por la url. 
        if(isset($_GET['controller'])){
            $nombre_controlador = $_GET['controller'].'controller';   // Genero Variable.
        }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
            $nombre_controlador = controller_default;
        }else{
            mostrarError();
            exit();
        }

        // Compruebo si existe controlador y creo Objeto
        if(class_exists($nombre_controlador)){
            $controlador = new $nombre_controlador();

            //Compruebo si lelga la acción y si el método existe dentro del controlador..
            if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
                $action = $_GET['action'];
                $controlador->$action(); // Llamo al método
            }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
                $actionDefault = action_default;
                $controlador->$actionDefault();          
            }else{
                mostrarError();
            }
        }else{
            mostrarError();
        }
?>