<?php

    class PrestamoModel{
            private $idPrestamo;
            private $idSolicitud;
            private $idHardware;
            private $observacionDevolucion;
            private $createdAt;
            private $updatedAt;
            
            private $db;

            private $encabezado;    


        public function __construct() {
            $this->db = Database::connect();
        }
        

        // GETTERS
            
        function getIdPrestamo() {
            return $this->idPrestamo;
        }

        function getIdSolicitud() {
            return $this->idSolicitud;
        }

        function getIdHardware() {
            return $this->idHardware;
        }

        function getObservacionDevolucion() {
            return $this->observacionDevolucion;
        }

        function getCreatedAt() {
            return $this->createdAt;
        }

        function getUpdatedAt() {
            return $this->updatedAt;
        }

        public function getEncabezado() {
            return $this->encabezado;
        }


        // SETTERS

        function setIdPrestamo($idPrestamo) {
            $this->idPrestamo= $idPrestamo;
        }

        
        function setIdSolicitud($idSolicitud) {
            $this->idSolicitud = $idSolicitud;
        }

        function setIdHardware($idHardware) {
            $this->idHardware = $idHardware;
        }

        function setObservacionDevolucion($observacionDevolucion) {
            $this->observacionDevolucion = $observacionDevolucion;
        }

        public function setEncabezado($encabezado) {
            $this->encabezado = $encabezado;
        }



        public function getAll() {
            $prestamos = $this->db->query(
            "SELECT
                prestamos.id_prestamo,
                tipos_hardware.tipo_hardware,
                hardwares.marca
                hardwares.numero_serie
                hardwares.codigo_interno
                usuarios.nombre,
                usuarios.apellido,
                usuarios.email,
                edificios.edificio,
                solicitudes.fecha_desde,
                solicitudes.fecha_hasta
                FROM
                    prestamos
                INNER JOIN hardwares ON prestamos.idHardwares = hardwares.id_hardware
                INNER JOIN tipos_hardware ON hardwares.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                INNER JOIN solicitudes ON prestamos.id_solicitud = solicitudes.id_solicitud
                INNER JOIN usuarios ON solicitudes.id_usuario  = usuarios.id_usuario
                INNER JOIN edificios ON solicitudes.id_edificio = edificios.id_edificio            
                GROUP BY prestamos.id_prestamo
                ORDER BY prestamos.fecha_desde;        
            ");
            return $prestamos;
    }



        public function getOne() {
            $prestamo = $this->db->query("SELECT * FROM prestamos
                INNER JOIN tipos_hardware ON prestamos.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                INNER JOIN usuarios ON prestamos.id_usuario  = usuarios.id_usuario
                INNER JOIN edificios ON prestamos.id_edificio = edificios.id_edificio
                WHERE id_prestamo = {$this->getIdprestamo()};");
            
            $soli = $prestamo->fetch_object();
            return $soli;
        }


        public function save($idSolicitud, $idHardware) {
            $sql = "INSERT INTO prestamos VALUES( NULL,
                                                    $idSolicitud,
                                                    $idHardware,
                                                    NULL, NULL, NULL
                                                )";
            $guardar = $this->db->query($sql);

            $resultado = false; 

            if($guardar) {
                $resultado = true;
            }

            return $resultado;
        }


        public function maximoID() {
            $dato = $this->db->query(
            "SELECT MAX( id_prestamo ) as id_prestamo FROM prestamos;");
    
            $maximoId = $dato->fetch_object();
            return $maximoId;
        }


        public function edit($id){
            $sql = "UPDATE INTO prestamos SET id_tipo_hardware='{$this->getidHardware()}', id_usuario='{$this->getidSolicitud()}', id_edificio='{$this->getIdEdificio()}',
                                        fecha_desde='{$this->getFechaDesde()}', fecha_hasta='{$this->getFechaHasta()}', 
                                        id_estado_prestamo='{$this->getidEstadoprestamo()}', motivo_prestamo='{$this->getMotivoSolciitud()}'
                    WHERE id_hardware=$id;";
            
            $save = $this->db->query($sql);
            
            $result = false;
            if($save){
                $result = true;
            }
            return $result;
        }

        public function estadoAprobado($id){
            $sql = "UPDATE prestamos SET id_estado_prestamo = 1 , motivo_aprobacion='{$this->getMotivoAprobacion()}'
                    WHERE id_prestamo=$id;";

            $save = $this->db->query($sql);
            
            $result = false;
            if($save){
                $result = true;
            }
            return $result;
        }

        public function estadoDesAprobado($id){
            $sql = "UPDATE prestamos SET id_estado_prestamo = 2 , motivo_aprobacion='{$this->getMotivoAprobacion()}'
                    WHERE id_prestamo=$id;";
            
            $save = $this->db->query($sql);
            
            $result = false;
            if($save){
                $result = true;
            }
            return $result;
        }

    }