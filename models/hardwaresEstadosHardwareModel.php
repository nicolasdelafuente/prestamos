<?php 

class HardwareEstadoHardwaresModel{
    
    private $idHardwareEstadoHardware;
    private $idHardware;
    private $idEstadoHardware;
    private $createdAt;
    
    private $db;




    public function __construct() {
        $this->db = Database::connect();
    }


    // GETTERS

    public function getIdHardwareEstadoHardware() {
        return $this->idHardwareEstadoHardware;
    }

    public function getIdHardware() {
        return $this->idHardware;
    }

    public function getIdEstadoHardware() {
        return $this->idEstadoHardware;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
    

    // SETTERS

    public function setIdHardware($idHardware) {
        $this->idHardware = $idHardware;
    }

    public function setIdEstadoHardware($idEstadoHardware) {
        $this->idEstadoHardware = $idEstadoHardware;
    }



    public function getUltimoEstado($id) {
        $ultimoEstado = $this->db->query(
        "SELECT
            hardwares_estados_hardware.id_hardware_estado_hardware,
            hardwares_estados_hardware.id_hardware,
            hardwares_estados_hardware.created_at,
            hardwares_estados_hardware.id_estado_hardware
        FROM
            hardwares_estados_hardware
        INNER JOIN
            ( SELECT id_hardware, MAX(created_at) fecha_max
                FROM hardwares_estados_hardware
                GROUP BY id_hardware ) resultado
            ON hardwares_estados_hardware.id_hardware = resultado.id_hardware
                AND hardwares_estados_hardware.created_at = resultado.fecha_max
                WHERE hardwares_estados_hardware.id_hardware = $id
        GROUP BY hardwares_estados_hardware.id_hardware
        ORDER BY hardwares_estados_hardware.id_hardware
            ");
        
        $dato1 = $ultimoEstado->fetch_object();
        return $dato1;
    }


    public function save() {
        $sql = "INSERT INTO hardwares_estados_hardware VALUES(   NULL,
                                                '{$this->getIdHardware()}',
                                                '{$this->getIdEstadoHardware()}',
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