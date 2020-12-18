<?php

// FIXME: Estoy forzando la URL localhost/prestamos/  para llegar a localhost/prestamos/main/Index/
    
    class Main {
        public function index() {
            require_once 'views/contents/main.php';
        }
    }

    $main = new Main();
    $main->index();