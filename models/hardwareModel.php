<?php

    class HardwareModel{
            private $idHardware;
            private $idTipo;
            private $idMarca;
            private $idEstadoHardware;
            private $descripcion;
            private $modelo;
            private $numeroUnahur;
            private $numeroSerie;
            private $createdAt;
            private $updatedAt;
            private $db;


        public function __construct() {
            $this->db = Database::connect();
        }    
            
        function getIdHardware() {
            return $this->idHardware;
        }

        function getIdTipo() {
            return $this->idTipo;
        }

        function getIdMarca() {
            return $this->idMarca;
        }

        function getIdEstadoHardware() {
            return $this->idEstadoHardware;
        }

        function getDescripcion() {
            return $this->descripcion;
        }

        function getModelo() {
            return $this->modelo;
        }

        function getNumeroUnahur() {
            return $this->numeroUnahur;
        }

        function getNumeroSerie() {
            return $this->numeroSerie;
        }

        function getCreatedAt() {
            return $this->createdAt;
        }

        function getUpdatedAt() {
            return $this->updatedAt;
        }




        function setIdTipo($idTipo) {
            $this->idTipo = $idTipo;
        }

        function setIdMarca($idMarca) {
            $this->idMarca = $idMarca;
        }

        function setIdEstadoHardware($idEstadoHardware) {
            $this->idEstadoHardware = $idEstadoHardware;
        }

        function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }

        function setModelo($modelo) {
            $this->modelo = $modelo;
        }

        function setNumeroUnahur($numeroUnahur) {
            $this->numeroUnahur = $numeroUnahur;
        }

        function setNumeroSerie($numeroSerie) {
            $this->numeroSerie = $numeroSerie;
        }



        public function getAll() {
            $hardwares = $this->db->query("SELECT * FROM hardwares
                INNER JOIN tipos_hardware ON hardwares.id_tipo = tipos_hardware.id_tipo_hardware
                INNER JOIN marcas ON hardwares.id_marca  = marcas.id_marca
                INNER JOIN estados_hardware on hardwares.id_estado_hardware = estados_hardware.id_estado_hardware;");
            return $hardwares;
        }

        public function guardar() {
            $sql = "INSERT INTO hardwares VALUES(NULL, '{$this->getIdTipo()}', '{$this->getIdMarca()}', '{$this->getIdEstadoHardware()}',
                                                    '{$this->getDescripcion()}', '{$this->getModelo()}', '{$this->getNumeroUnahur()}',
                                                    '{$this->getNumeroSerie()}', NULL, NULL)";
            $guardar = $this->db->query($sql);

            $resultado = false;

            if($guardar) {
                $resultado = true;
            }

            return $resultado;
        }

    }