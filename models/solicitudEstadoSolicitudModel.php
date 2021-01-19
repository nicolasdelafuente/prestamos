<?php 
class SolicitudEstadoSolicitudModel{
    
    private $idsolicitudEstadoSolicitud;
    private $idSolicitud;
    private $idEstadoSolicitud;
    private $createdAt;
    
    private $db;




    public function __construct() {
        $this->db = Database::connect();
    }


    // GETTERS

    public function getIdSolicitudEstadoSolicitud() {
        return $this->idSolicitudEstadoSolicitud;
    }

    public function getIdSolicitud() {
        return $this->idSolicitud;
    }

    public function getIdEstadoSolicitud() {
        return $this->idEstadoSolicitud;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
    

    // SETTERS

    public function setIdSolicitud($idSolicitud) {
        $this->idSolicitud = $idSolicitud;
    }

    public function setIdEstadoSolicitud($idEstadoSolicitud) {
        $this->idEstadoSolicitud = $idEstadoSolicitud;
    }



    public function save() {
        $sql = "INSERT INTO solicitudes_estados_solicitud VALUES(   NULL,
                                                '{$this->getIdsolicitud()}',
                                                '{$this->getIdEstadoSolicitud()}',
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