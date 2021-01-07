<?php

    class SolicitudModel{
            private $idSolicitud;
            private $idTipoHardware;
            private $idUsuario;
            private $idEdificio;
            private $fechaDesde;
            private $fechaHasta;
            private $motivoSolcitud;
            private $motivoAprobacion;
            private $createdAt;
            private $updatedAt;
            
            private $db;

            private $encabezado;    


        public function __construct() {
            $this->db = Database::connect();
        }
        
    
        function getEstadoPendiente() {
            return $this->estadoPendiente;
        }

        function getEstadoAprobado() {
            return $this->estadoAprobado;
        }

        function getEstadoDesaprobado() {
            return $this->estadoDesaprobado;
        }
            
        function getIdSolicitud() {
            return $this->idSolicitud;
        }

        function getIdTipoHardware() {
            return $this->idTipoHardware;
        }

        function getIdUsuario() {
            return $this->idUsuario;
        }

        function getIdEdificio() {
            return $this->idEdificio;
        }

        function getFechaDesde() {
            return $this->fechaDesde;
        }

        function getFechaHasta() {
            return $this->fechaHasta;
        }

        function getIdEstadoSolicitud() {
            return $this->idEstadoSolicitud;
        }

        function getMotivoSolicitud() {
            return $this->motivoSolicitud;
        }

        function getMotivoAprobacion() {
            return $this->motivoAprobacion;
        }

        function getCreatedAt() {
            return $this->createdAt;
        }

        function getUpdatedAt() {
            return $this->updatedAt;
        }


        function setIdSolicitud($idSolicitud) {
            $this->idSolicitud= $idSolicitud;
        }

        function setIdTipoHardware($idTipoHardware) {
            $this->idTipoHardware = $idTipoHardware;
        }

        function setIdUsuario($idUsuario) {
            $this->idUsuario = $idUsuario;
        }

        function setIdEdificio($idEdificio) {
            $this->idEdificio = $idEdificio;
        }

        function setFechaDesde($fechaDesde) {
            $this->fechaDesde = $fechaDesde;
        }

        function setFechaHasta($fechaHasta) {
            $this->fechaHasta = $fechaHasta;
        }

        function setIdEstadoSolicitud($idEstadoSolicitud) {
            $this->idEstadoSolicitud = $idEstadoSolicitud;
        }

        function setMotivoSolicitud($motivoSolicitud) {
            $this->motivoSolicitud = $motivoSolicitud;
        }

        function setMotivoAprobacion($motivoAprobacion) {
            $this->motivoAprobacion = $motivoAprobacion;
        }



        public function getOne() {
            $solicitud = $this->db->query("SELECT * FROM solicitudes
                INNER JOIN tipos_hardware ON solicitudes.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                INNER JOIN usuarios ON solicitudes.id_usuario  = usuarios.id_usuario
                INNER JOIN edificios ON solicitudes.id_edificio = edificios.id_edificio
                INNER JOIN estados_solicitud ON solicitudes.id_estado_solicitud = estados_solicitud.id_estado_solicitud
                WHERE id_solicitud = {$this->getIdSolicitud()};");
            
            $soli = $solicitud->fetch_object();
            return $soli;
        }

        public function getAll() {
            $solicitudes = $this->db->query("SELECT * FROM solicitudes
                INNER JOIN tipos_hardware ON solicitudes.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                INNER JOIN usuarios ON solicitudes.id_usuario  = usuarios.id_usuario
                INNER JOIN edificios ON solicitudes.id_edificio = edificios.id_edificio
                INNER JOIN estados_solicitud ON solicitudes.id_estado_solicitud = estados_solicitud.id_estado_solicitud;");
            return $solicitudes;
        }

        public function getAllAprobado() {
            $solicitudes = $this->db->query("SELECT * FROM solicitudes
                INNER JOIN tipos_hardware ON solicitudes.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                INNER JOIN usuarios ON solicitudes.id_usuario  = usuarios.id_usuario
                INNER JOIN edificios ON solicitudes.id_edificio = edificios.id_edificio
                INNER JOIN estados_solicitud ON solicitudes.id_estado_solicitud = estados_solicitud.id_estado_solicitud
                WHERE estados_solicitud.id_estado_solicitud = 1
                ORDER BY solicitudes.fecha_desde");
            return $solicitudes;
        }
        
        public function getAllDesaprobado() {
            $solicitudes = $this->db->query("SELECT * FROM solicitudes
                INNER JOIN tipos_hardware ON solicitudes.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                INNER JOIN usuarios ON solicitudes.id_usuario  = usuarios.id_usuario
                INNER JOIN edificios ON solicitudes.id_edificio = edificios.id_edificio
                INNER JOIN estados_solicitud ON solicitudes.id_estado_solicitud = estados_solicitud.id_estado_solicitud
                WHERE estados_solicitud.id_estado_solicitud = 2
                ORDER BY solicitudes.fecha_desde DESC");
            return $solicitudes;
        }


        public function getAllPendiente() {
                $solicitudes = $this->db->query("SELECT * FROM solicitudes
                INNER JOIN tipos_hardware ON solicitudes.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                INNER JOIN usuarios ON solicitudes.id_usuario  = usuarios.id_usuario
                INNER JOIN edificios ON solicitudes.id_edificio = edificios.id_edificio
                INNER JOIN estados_solicitud ON solicitudes.id_estado_solicitud = estados_solicitud.id_estado_solicitud
                WHERE estados_solicitud.id_estado_solicitud = 3
                ORDER BY solicitudes.fecha_desde");
            return $solicitudes;
        }


        public function save() {
            $sql = "INSERT INTO solicitudes VALUES(NULL, '{$this->getIdTipoHardware()}', '{$this->getIdUsuario()}', '{$this->getIdEdificio()}',
                                                    '{$this->getFechaDesde()}', '{$this->getFechaHasta()}', 3,
                                                    '{$this->getMotivoSolicitud()}', NULL, NULL, NULL)";
            $guardar = $this->db->query($sql);

            $resultado = false;
 

            if($guardar) {
                $resultado = true;
            }

            return $resultado;
        }


        public function edit($id){
            $sql = "UPDATE INTO solicitudes SET id_tipo_hardware='{$this->getIdTipoHardware()}', id_usuario='{$this->getIdUsuario()}', id_edificio='{$this->getIdEdificio()}',
                                        fecha_desde='{$this->getFechaDesde()}', fecha_hasta='{$this->getFechaHasta()}', 
                                        id_estado_solicitud='{$this->getidEstadoSolicitud()}', motivo_solicitud='{$this->getMotivoSolciitud()}'
                    WHERE id_hardware=$id;";
            
            $save = $this->db->query($sql);
            
            $result = false;
            if($save){
                $result = true;
            }
            return $result;
        }

        public function estadoAprobado($id){
            $sql = "UPDATE solicitudes SET id_estado_solicitud = 1 , motivo_aprobacion='{$this->getMotivoAprobacion()}'
                    WHERE id_solicitud=$id;";

            $save = $this->db->query($sql);
            
            $result = false;
            if($save){
                $result = true;
            }
            return $result;
        }

        public function estadoDesAprobado($id){
            $sql = "UPDATE solicitudes SET id_estado_solicitud = 2 , motivo_aprobacion='{$this->getMotivoAprobacion()}'
                    WHERE id_solicitud=$id;";
            
            $save = $this->db->query($sql);
            
            $result = false;
            if($save){
                $result = true;
            }
            return $result;
        }

    }