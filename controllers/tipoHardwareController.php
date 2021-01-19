<?php

    require_once 'models/tipoHardwareModel.php';

    class TipoHardwareController{

        public function listar() {
            $tipoHardwareModel = new TipoHardwareModel();
            return $tipoHardwareModel->getAllTipoHardware();        
        }

        public function listarMenosUno() {
            $tipoHardwareModel = new TipoHardwareModel();
            return $tipoHardwareModel->getAllButOneTipoHardware();        
        }
    }          
               