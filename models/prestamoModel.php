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


    public function getAllPendiente() {
        $query =    "SELECT
                        prestamos.id_prestamo,
                        prestamos.id_solicitud,
                        tipos_hardware.tipo_hardware,
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
                        solicitudes ON prestamos.id_solicitud = solicitudes.id_solicitud
                    INNER JOIN
                        tipos_hardware ON solicitudes.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                    INNER JOIN
                        usuarios ON solicitudes.id_usuario  = usuarios.id_usuario
                    INNER JOIN
                        edificios ON solicitudes.id_edificio = edificios.id_edificio            
                    ORDER BY solicitudes.fecha_desde
                    ;";          

        $prestamos = $this->db->query($query);
        return $prestamos;
    }

    public function getAllByUser($idUsuario) {
        $query =    "SELECT
                        prestamos.id_prestamo,
                        prestamos.id_solicitud,
                        tipos_hardware.tipo_hardware,
                        usuarios.nombre,
                        usuarios.apellido,
                        usuarios.email,
                        edificios.edificio,
                        solicitudes.fecha_desde,
                        solicitudes.fecha_hasta,
                        prestamos.id_estado_prestamo,
                        estados_prestamo.estado_prestamo

                    FROM
                        prestamos
                    INNER JOIN
                        solicitudes ON prestamos.id_solicitud = solicitudes.id_solicitud
                    INNER JOIN
                        tipos_hardware ON solicitudes.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                    INNER JOIN
                        usuarios ON solicitudes.id_usuario  = usuarios.id_usuario
                    INNER JOIN
                        edificios ON solicitudes.id_edificio = edificios.id_edificio   
                    INNER JOIN
                        estados_prestamo ON prestamos.id_estado_prestamo = estados_prestamo.id_estado_prestamo
                    WHERE usuarios.id_usuario = 2       
                    ORDER BY solicitudes.fecha_hasta DESC
                    ;";          

        $prestamos = $this->db->query($query);
        return $prestamos;
    }

    public function getAllEnPrestamo() {
        $query =    "SELECT
                        prestamos.id_prestamo,
                        prestamos.id_solicitud,
                        tipos_hardware.tipo_hardware,
                        usuarios.nombre,
                        usuarios.apellido,
                        usuarios.email,
                        edificios.edificio,
                        solicitudes.fecha_desde,
                        solicitudes.fecha_hasta,
                        prestamos.id_estado_prestamo,
                        hardwares.numero_serie,
                        marcas.marca
                    FROM
                        prestamos
                    INNER JOIN
                        solicitudes ON prestamos.id_solicitud = solicitudes.id_solicitud
                    INNER JOIN
                        tipos_hardware ON solicitudes.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                    INNER JOIN
                        usuarios ON solicitudes.id_usuario  = usuarios.id_usuario
                    INNER JOIN
                        edificios ON solicitudes.id_edificio = edificios.id_edificio 
                    INNER JOIN 
                        hardwares ON prestamos.id_hardware = hardwares.id_hardware      
                    INNER JOIN 
                        marcas ON hardwares.id_marca = marcas.id_marca  
                    ORDER BY solicitudes.fecha_hasta DESC
                    ;";          

        $prestamos = $this->db->query($query);
        return $prestamos;
    }

    public function save() {
         $sql = "INSERT INTO prestamos VALUES(   NULL,
                                                '{$this->getIdSolicitud()}',
                                                NULL, 
                                                NULL,
                                                NULL,
                                                1,
                                                NULL,
                                                NULL
                                            )";
        $save = $this->db->query($sql);

        $result = false;

        if($save) {
            $result = true;
        }

        return $result;
    }

    

    public function delete() {
        $sql =  "DELETE FROM prestamos WHERE id_prestamo = '{$this->getIdHardware()}'";
        $save = $this->db->query($sql);

        $result = false;

        if($save) {
            $result = true;
        }

        return $result;
    }
  

    public function updateHardware() {
        $sql = "UPDATE prestamos SET id_hardware = '{$this->getIdHardware()}' WHERE id_prestamo = '{$this->getIdPrestamo()}'";
        $save = $this->db->query($sql);

        $result = false;

        if($save) {
            $result = true;
        }

        return $result;
    }

    public function updateObservacion() {
        $sql = "UPDATE prestamos SET observacion_prestamo = '{$this->getObservacionPrestamo()}' WHERE id_prestamo = '{$this->getIdPrestamo()}'";
        $save = $this->db->query($sql);

        $result = false;

        if($save) {
            $result = true;
        }

        return $result;
    }

    public function updateObservacionDevolucion() {
        $sql = "UPDATE prestamos SET observacion_devolucion = '{$this->getObservacionDevolucion()}' WHERE id_prestamo = '{$this->getIdPrestamo()}'";
        $save = $this->db->query($sql);

        $result = false;

        if($save) {
            $result = true;
        }

        return $result;
    }

    public function updateEstado() {
        $sql = "UPDATE prestamos SET id_estado_prestamo = '{$this->getIdEstadoPrestamo()}' WHERE id_prestamo = '{$this->getIdPrestamo()}'";
        $save = $this->db->query($sql);

        $result = false;

        if($save) {
            $result = true;
        }

        return $result;
    }


    public function maximoID() {
        $dato = $this->db->query("SELECT MAX( id_prestamo) as id_prestamo FROM prestamos;");

        $maximoId = $dato->fetch_object();
        return $maximoId;
    }


    public function getOne() {
        $prestamo = $this->db->query("SELECT *, solicitudes.created_at as solicitud_creada, 
                                        prestamos.id_estado_prestamo as idEstadoPrestamo,
                                        tipos_hardware.id_tipo_hardware as idTipoHardware
                                        FROM prestamos
                                        INNER JOIN estados_prestamo ON prestamos.id_estado_prestamo = estados_prestamo.id_estado_prestamo
                                        INNER JOIN solicitudes ON prestamos.id_solicitud = solicitudes.id_solicitud
                                        INNER JOIN tipos_hardware ON solicitudes.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                                        INNER JOIN usuarios ON solicitudes.id_usuario  = usuarios.id_usuario
                                        INNER JOIN edificios ON solicitudes.id_edificio = edificios.id_edificio
                                        LEFT JOIN hardwares ON prestamos.id_hardware = hardwares.id_hardware
                                        LEFT JOIN marcas ON hardwares.id_Marca = marcas.id_marca
                                        WHERE id_prestamo = {$this->getIdPrestamo()};");
        
        $prest = $prestamo->fetch_object();
        return $prest;
    }

}