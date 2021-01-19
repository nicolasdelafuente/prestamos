<?php 
class HardwareEstadoHardwareModel{
    
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