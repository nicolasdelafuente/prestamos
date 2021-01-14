<?php 

class HardwareModel{
    
    private $idHardware;
    private $idTipoHardware;
    private $idMarca;
    private $descripcion;
    private $modelo;
    private $numeroSerie;
    private $codigoInterno;
    private $idEstadoHardware;
    private $idEstadoPrestamo;
    private $createdAt;
    private $updatedAt;
    
    private $db;

    private $encabezado;


    public function __construct() {
        $this->db = Database::connect();
    }


    // GETTERS

    public function getIdHardware() {
        return $this->idHardware;
    }

    public function getIdTipoHardware() {
        return $this->idTipoHardware;
    }

    public function getIdMarca() {
        return $this->idMarca;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function getNumeroSerie() {
        return $this->numeroSerie;
    }

    public function getCodigoInterno() {
        return $this->codigoInterno;
    }

    public function getIdEstadoHardware() {
        return $this->idEstadoHardware;
    }

    public function getIdEstadoPrestamo() {
        return $this->idEstadoPrestamo;
    }

    public function getEncabezado() {
        return $this->encabezado;
    }


    // SETTERS

    public function setIdHardware($idHardware) {
        $this->idHardware = $idHardware;
    }
        
    public function setIdTipoHardware($idTipoHardware) {
        $this->idTipoHardware = $idTipoHardware;
    }

    public function setIdMarca($idMarca) {
        $this->idMarca = $idMarca;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    public function setNumeroSerie($numeroSerie) {
        $this->numeroSerie = $numeroSerie;
    }

    public function setCodigoInterno($codigoInterno) {
        $this->codigoInterno = $codigoInterno;
    }

    public function setIdEstadoHardware($idEstadoHardware) {
        $this->idEstadoHardware = $idEstadoHardware;
    }

    public function setIdEstadoPrestamo($idEstadoPrestamo) {
        $this->idEstadoPrestamo = $idEstadoPrestamo;
    }

    public function setEncabezado($encabezado) {
        $this->encabezado = $encabezado;
    }



    public function getAll() {
            $hardwares = $this->db->query(
                "SELECT
                    hardwares.id_hardware,
                    tipos_hardware.tipo_hardware,
                    marcas.marca,
                    hardwares.modelo,
                    hardwares.numero_serie,
                    hardwares.codigo_interno,
                    hardwares.id_estado_hardware,
                    estados_hardware.estado_hardware,
                    hardwares.id_estado_prestamo,
                    estados_prestamo.estado_prestamo,
                    hardwares.descripcion_hardware,
                    hardwares.created_at AS created_at_hardware
                FROM
                    hardwares
                INNER JOIN
                    tipos_hardware ON hardwares.id_tipo_hardware = tipos_hardware.id_tipo_hardware
                INNER JOIN
                    marcas ON hardwares.id_marca = marcas.id_marca
                INNER JOIN
                    estados_hardware ON hardwares.id_estado_hardware = estados_hardware.id_estado_hardware
                INNER JOIN
                    estados_prestamo ON hardwares.id_estado_prestamo = estados_prestamo.id_estado_prestamo
                ORDER BY tipos_hardware.tipo_hardware, hardwares.numero_serie;          
            ");
            return $hardwares;
    }
    
    public function getOne() {
        $hardware = $this->db->query("SELECT * FROM hardwares
            INNER JOIN tipos_hardware ON hardwares.id_tipo_hardware = tipos_hardware.id_tipo_hardware
            INNER JOIN marcas ON hardwares.id_marca  = marcas.id_marca
            INNER JOIN estados_hardware ON hardwares.id_estado_hardware = estados_hardware.id_estado_hardware
            WHERE id_hardware = {$this->getIdHardware()};");

            $hard = $hardware->fetch_object();
            return $hard;
    }

    public function save() {
        $sql = "INSERT INTO hardwares VALUES(   NULL,
                                                '{$this->getIdTipoHardware()}',
                                                '{$this->getIdMarca()}',
                                                '{$this->getDescripcion()}',
                                                '{$this->getModelo()}',
                                                '{$this->getNumeroSerie()}',
                                                '{$this->getCodigoInterno()}',
                                                '{$this->getIdEstadoHardware()}',
                                                '{$this->getIdEstadoPrestamo()}',
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


    public function edit($idHardware){
        $sql = "UPDATE hardwares SET    id_tipo_hardware='{$this->getIdTipoHardware()}',
                                        id_marca='{$this->getIdMarca()}',
                                        descripcion_hardware='{$this->getDescripcion()}',
                                        modelo='{$this->getModelo()}', 
                                        numero_serie='{$this->getNumeroSerie()}',
                                        codigo_interno='{$this->getCodigoInterno()}',
                                        id_estado_hardware='{$this->getIdEstadoHardware()}'
                WHERE id_hardware=$idHardware;";
        
        $save = $this->db->query($sql);
        
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function delete($idHardware) {
        $sql = "DELETE FROM hardwares WHERE id_hardware = $idHardware;";

        $save = $this->db->query($sql);
        
        $result = false;
        if($save){
            $result = true;
        }
        return $result;

    }

    public function maximoID() {
        $dato = $this->db->query(
        "SELECT MAX( id_hardware ) as id_hardware FROM hardwares;");

        $maximoId = $dato->fetch_object();
        return $maximoId;
    }
    
    public function hardwareDisponible($estado, $idTipo) {
        $hardwares = $this->db->query(
            "SELECT
                hardwares.id_hardware, hardwares.numero_serie
            FROM hardwares
            LEFT JOIN hardwares_estados_hardware ON hardwares.id_hardware = hardwares_estados_hardware.id_hardware
            INNER JOIN estados_hardware on hardwares_estados_hardware.id_estado_hardware = estados_hardware.id_estado_hardware
            WHERE hardwares_estados_hardware.created_at IS NULL
                OR hardwares_estados_hardware.created_at = (
                    SELECT MAX(hardwares_estados_hardware.created_at)
                    FROM hardwares_estados_hardware
                    WHERE hardwares_estados_hardware.id_hardware = hardwares.id_hardware)
            AND estados_hardware.id_estado_hardware = $estado
            AND hardwares.id_tipo_hardware = $idTipo
            ORDER BY hardwares.numero_serie;
            ");
        return $hardwares;
    }

    public function actualizarEstadoHardware($idHardware, $idEstadoHardware) {
        $sql = "UPDATE hardwares SET    id_estado_hardware= $idEstadoHardware,
        WHERE id_hardware=$idHardware;";

        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function actualizarEstadoPrestamo($idHardware, $idEstadoPrestamo) {
        $sql = "UPDATE hardwares SET    id_estado_hardware= $idEstadoPrestamo,
        WHERE id_hardware=$idHardware;";

        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function estadoHardwareActual($idHardware) {
        $estadoHardware = $this->db->query("SELECT id_estado_hardware FROM hardwares WHERE id_hardware = $idHardware;");

        $result = $estadoHardware->fetch_object();
        return $result;

    }



}