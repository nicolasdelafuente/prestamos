<?php

    class TipoHardwareModel{
        private $idTipoHardware;
        private $tipoHardware;
        private $createdAt;
        private $updatedAt;
        private $db;

        public function __construct() {
            $this->db = Database::connect();
        }

        function getIdTipoHardware() {
            return $this->idTipoUsuario;
        }

        function getTipoHardware() {
            return $this->tipoHardware;
        }

        function getCreatedAt() {
            return $this->createdAt;
        }

        function getUpdatedAt() {
            return $this->updatedAt;
        }

        function setTipoHardware($tipoHardware){
            $this->tipoHardware = $tipoHardware;
        }


        public function getAll() {
            $tiposHardware = $this->db->query("SELECT * FROM tipos_hardware;");
            return $tiposHardware;
        }

        public function getAllButOne($idTipoNo) {
            $tiposHardware = $this->db->query("SELECT * FROM tipos_hardware WHERE id_tipo_hardware != $idTipoNo ORDER BY tipo_Hardware");
            return $tiposHardware;
        }
    }