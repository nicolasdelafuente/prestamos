<?php
class SolicitudModel{
        private $idSolicitud;
        private $idTipoHardware;
        private $idUsuario;
        private $idEdificio;
        private $idEstadoSolicitud;
        private $fechaDesde;
        private $fechaHasta;
        private $motivoSolicitud;
        private $motivoAprobacion;
        private $createdAt;
        private $updatedAt;
        
        private $db;

        private $encabezado;    


    public function __construct() {
        $this->db = Database::connect();
    }
    

    // GETTERS
        
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

    public function getEncabezado() {
        return $this->encabezado;
    }


    // SETTERS

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

    public function setEncabezado($encabezado) {
        $this->encabezado = $encabezado;
    }



    public function getAll() {
        $query =    "SELECT
                        solicitudes.id_solicitud,
                        tipos_hardware.tipo_hardware,
                        usuarios.nombre,
                        usuarios.apellido,
                        usuarios.email,
                        edificios.edificio,
                        solicitudes.fecha_desde,
                        solicitudes.fecha_hasta,
                        estados_solicitud.id_estado_solicitud
                    FROM
                        solicitudes
                    INNER JOIN
                        tipos_hardware ON solicitudes.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                    INNER JOIN
                        usuarios ON solicitudes.id_usuario  = usuarios.id_usuario
                    INNER JOIN
                        edificios ON solicitudes.id_edificio = edificios.id_edificio
                    INNER JOIN
                        estados_solicitud ON solicitudes.id_estado_solicitud =  estados_solicitud.id_estado_solicitud      
                    GROUP BY solicitudes.id_solicitud
                    ORDER BY solicitudes.fecha_desde;";       

        $solicitudes = $this->db->query($query);
        return $solicitudes;
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

    public function save() {
        $sql = "INSERT INTO solicitudes VALUES( NULL,
                                                '{$this->getIdTipoHardware()}',
                                                '{$this->getIdUsuario()}',
                                                '{$this->getIdEdificio()}',
                                                '{$this->getFechaDesde()}',
                                                '{$this->getFechaHasta()}',
                                                '{$this->getMotivoSolicitud()}',
                                                3,NULL, NULL)";
        $guardar = $this->db->query($sql);

        $resultado = false; 

        if($guardar) {
            $resultado = true;
        }

        return $resultado;
    }

    public function delete($idSolicitud) {
        $sql = "DELETE FROM solicitudes WHERE id_solicitud = $idSolicitud;";

        $save = $this->db->query($sql);
        
        $resultado = false;
        if($save){
            $resultado = true;
        }
        return $resultado;

    }

    public function maximoID() {
        $dato = $this->db->query("SELECT MAX( id_solicitud ) as id_solicitud FROM solicitudes;");

        $maximoId = $dato->fetch_object();
        return $maximoId;
    }

    public function editEstado() {
        $sql = "UPDATE solicitudes SET id_estado_solicitud = '{$this->getIdEstadoSolicitud()}'
                WHERE id_solicitud = '{$this->getIdSolicitud()}'";
        
        $save = $this->db->query($sql);

        $resultado = false;
        if($save){
            $resultado = true;
        }
        return $resultado;
    }
}