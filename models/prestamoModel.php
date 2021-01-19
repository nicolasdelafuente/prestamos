<?php
class PrestamoModel{
        private $idPrestamo;
        private $idSolicitud;
        private $idHardware;
        private $observacionPrestamo;
        private $observacionDevolucion;
        private $idEstadoPrestamo;
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

    function getObservacionPrestamo() {
        return $this->observacionPrestamo;
    }

    function getObservacionDevolucion() {
        return $this->observacionDevolucion;
    }

    function getIdEstadoPrestamo() {
        return $this->idEstadoPrestamo;
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

    function setObservacionPrestamo($observacionPrestamo) {
        $this->observacionPrestamo = $observacionPrestamo;
    }

    function setObservacionDevolucion($observacionDevolucion) {
        $this->observacionDevolucion = $observacionDevolucion;
    }

    function setIdEstadoPrestamo($idEstadoPrestamo) {
        $this->idEstadoPrestamo = $idEstadoPrestamo;
    }

    public function setEncabezado($encabezado) {
        $this->encabezado = $encabezado;
    }


    public function getAll() {
        $query =    "SELECT
                        prestamos.id_prestamo,
                        tipos_hardware.tipo_hardware,
                        marcas.marca,
                        hardwares.numero_serie,
                        hardwares.codigo_interno,
                        usuarios.nombre,
                        usuarios.apellido,
                        usuarios.email,
                        edificios.edificio,
                        solicitudes.fecha_desde,
                        solicitudes.fecha_hasta,
                        prestamos.id_estado_prestamo
                    FROM
                        prestamos
                    INNER JOIN
                        hardwares ON prestamos.id_Hardware = hardwares.id_hardware
                    INNER JOIN
                        tipos_hardware ON hardwares.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                    INNER JOIN
                        marcas ON hardwares.id_marca = marcas.id_marca
                    INNER JOIN
                        solicitudes ON prestamos.id_solicitud = solicitudes.id_solicitud
                    INNER JOIN
                        usuarios ON solicitudes.id_usuario  = usuarios.id_usuario
                    INNER JOIN
                        edificios ON solicitudes.id_edificio = edificios.id_edificio            
                    GROUP BY prestamos.id_prestamo
                    ORDER BY solicitudes.fecha_desde;";          

        $prestamos = $this->db->query($query);
        return $prestamos;
    }


    public function save() {
        $sql = "INSERT INTO prestamos VALUES(   NULL,
                                                '{$this->getIdsolicitud()}',
                                                '{$this->getIdHardware()}',
                                                NULL,
                                                1,
                                                NULL,
                                                NULL
                                            )";
        $guardar = $this->db->query($sql);

        $resultado = false;

        if($guardar) {
            $resultado = true;
        }

        return $resultado;
    }

}