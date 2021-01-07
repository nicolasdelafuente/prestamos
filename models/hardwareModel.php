<?php 

class HardwareModel{
    
    private $idHardware;
    private $idTipoHardware;
    private $idMarca;
    private $descripcion;
    private $modelo;
    private $numeroSerie;
    private $codigoInterno;
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
                hardwares.descripcion_hardware,
                hardwares.created_at as created_at_hardware
            FROM
                hardwares
            INNER JOIN
                tipos_hardware on hardwares.id_tipo_hardware = tipos_hardware.id_tipo_hardware
            INNER JOIN
                marcas on hardwares.id_marca = marcas.id_marca
            
            GROUP BY hardwares.id_hardware
            ORDER BY tipos_hardware.tipo_hardware;           
            ");
            return $hardwares;
    }
    
    public function getOne() {
        $hardware = $this->db->query("SELECT * FROM hardwares
            INNER JOIN tipos_hardware ON hardwares.id_tipo_hardware = tipos_hardware.id_tipo_hardware
            INNER JOIN marcas ON hardwares.id_marca  = marcas.id_marca
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


    public function edit($id){
        $sql = "UPDATE hardwares SET    id_tipo_hardware='{$this->getIdTipoHardware()}',
                                        id_marca='{$this->getIdMarca()}',
                                        descripcion_hardware='{$this->getDescripcion()}',
                                        modelo='{$this->getModelo()}', 
                                        numero_serie='{$this->getNumeroSerie()}',
                                        codigo_interno='{$this->getCodigoInterno()}'
                WHERE id_hardware=$id;";
        
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

}


