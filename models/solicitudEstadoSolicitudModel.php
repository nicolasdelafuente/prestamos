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



    public function getUltimoEstado($id) {
        $ultimoEstado = $this->db->query(
        "SELECT
            solicitudes_estados_solicitud.id_solicitud_estado_solicitud,
            solicitudes_estados_solicitud.id_solicitud,
            solicitudes_estados_solicitud.created_at,
            solicitudes_estados_solicitud.id_estado_solicitud
        FROM
            solicitudes_estados_solicitud
        INNER JOIN
            ( SELECT id_solicitud, MAX(created_at) fecha_max
                FROM solicitudes_estados_solicitud
                GROUP BY id_solicitud ) resultado
            ON solicitudes_estados_solicitud.id_solicitud = resultado.id_solicitud
                AND solicitudes_estados_solicitud.created_at = resultado.fecha_max
                WHERE solicitudes_estados_solicitud.id_solicitud = $id
        GROUP BY solicitudes_estados_solicitud.id_solicitud
        ORDER BY solicitudes_estados_solicitud.id_solicitud
        ");
        
        $dato1 = $ultimoEstado->fetch_object();
        return $dato1;
    }


    public function save() {
        $sql = "INSERT INTO solicitudes_estados_solicitud VALUES(   NULL,
                                                '{$this->getIdsolicitud()}',
                                                '{$this->getIdEstadosolicitud()}',
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