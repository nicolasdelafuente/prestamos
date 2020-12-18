<?php

    class MarcaModel{
        private $idHardware;
        private $idTipo;
        private $idMarca;
        private $idEstadoHardware;
        private $descripcion;
        private $modelo;
        private $numeroSerie;
        private $numeroUnahur;
        private $createdAt;
        private $updatedAt;
        private $db;

        public function __construct() {
            $this->db = Database::connect();
        }

        function getIdMarca() {
            return $this->idMarca;
        }

        function getMarca() {
            return $this->marca;
        }

        function getCreatedAt() {
            return $this->createdAt;
        }

        function getUpdatedAt() {
            return $this->updatedAt;
        }

        function setMarca($marca){
            $this->marca = $marca;
        }

        public function getAll() {
            $marcas = $this->db->query("SELECT * FROM marcas;");
            return $marcas;
        }

        public function guardar() {
            $sql = "INSERT INTO marcas VALUES(NULL, '{$this->getMarca()}', NULL, NULL)";
            $guardar = $this->db->query($sql);

            $resultado = false;

            if($guardar) {
                $resultado = true;
            }

            return $resultado;
        }

    }