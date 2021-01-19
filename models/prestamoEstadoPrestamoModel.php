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



}