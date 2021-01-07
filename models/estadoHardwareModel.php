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

        public function getAllButOne($id) {
            $estadosHardware = $this->db->query("SELECT * FROM estados_Hardware WHERE id_estado_Hardware != $id ORDER BY estado_Hardware");
            return $estadosHardware;
        }
        
        public function getOne($id) {
            $estadoHardware = $this->db->query("SELECT * FROM estados_hardware WHERE id_estado_Hardware = $id;");
            return $estadoHardware;
        }

        


    }