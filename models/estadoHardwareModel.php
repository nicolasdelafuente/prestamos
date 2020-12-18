<?php

    class EstadoHardwareModel{
        private $idEstadoHardware;
        private $estadoHardware;
        private $color;
        private $createdAt;
        private $updatedAt;
        private $db;

        public function __construct() {
            $this->db = Database::connect();
        }

        function getEstadoHardware() {
            return $this->estadoHardware;
        }

        function getColor() {
            return $this->color;
        }

        function getIdTipoUsuario() {
            return $this->idTipoUsuario;
        }

        function getCreatedAt() {
            return $this->createdAt;
        }

        function getUpdatedAt() {
            return $this->updatedAt;
        }

        function setEstadoHardware($estadoHardware){
            $this->estadoHardware = $estadoHardware;
        }

        function setColor($color){
            $this->color = $color;
        }


        public function getAll() {
            $estadosHardware = $this->db->query("SELECT * FROM estados_hardware;");
            return $estadosHardware;
        }

        public function guardar() {
            $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getEstadoHardware()}', '{$this->getColor()}', NULL, NULL)";
            $guardar = $this->db->query($sql);

            $resultado = false;

            if($guardar) {
                $resultado = true;
            }

            return $resultado;
        }

        


    }