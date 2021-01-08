<?php 

class PrestamoEstadoPrestamoModel{
    
    private $idPrestamoEstadoPrestamo;
    private $idPrestamo;
    private $idEstadoPrestamo;
    private $createdAt;
    
    private $db;




    public function __construct() {
        $this->db = Database::connect();
    }


    // GETTERS

    public function getIdPrestamoEstadoPrestamo() {
        return $this->idprestamoEstadoPrestamo;
    }

    public function getIdPrestamo() {
        return $this->idPrestamo;
    }

    public function getIdEstadoPrestamo() {
        return $this->idEstadoPrestamo;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
    

    // SETTERS

    public function setIdPrestamo($idPrestamo) {
        $this->idPrestamo = $idPrestamo;
    }

    public function setIdEstadoPrestamo($idEstadoPrestamo) {
        $this->idEstadoPrestamo = $idEstadoPrestamo;
    }



    public function getUltimoEstado($id) {
        $ultimoEstado = $this->db->query(
        "SELECT
            prestamos_estados_prestamo.id_prestamo_estado_prestamo,
            prestamos_estados_prestamo.id_prestamo,
            prestamos_estados_prestamo.created_at,
            prestamos_estados_prestamo.id_estado_prestamo
        FROM
            prestamos_estados_prestamo
        INNER JOIN
            ( SELECT id_prestamo, MAX(created_at) fecha_max
                FROM prestamos_estados_prestamo
                GROUP BY id_prestamo ) resultado
            ON prestamos_estados_prestamo.id_prestamo = resultado.id_prestamo
                AND prestamos_estados_prestamo.created_at = resultado.fecha_max
                WHERE prestamos_estados_prestamo.id_prestamo = $id
        GROUP BY prestamos_estados_prestamo.id_prestamo
        ORDER BY prestamos_estados_prestamo.id_prestamo
            ");
        
        $dato1 = $ultimoEstado->fetch_object();
        return $dato1;
    }


    public function save() {
        $sql = "INSERT INTO prestamos_estados_prestamo VALUES(   NULL,
                                                '{$this->getIdPrestamo()}',
                                                '{$this->getIdEstadoPrestamo()}',
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