<?php
class EdificioModel{
    private $idEdificio;
    private $edificio;
    private $createdAt;
    private $updatedAt;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    function getIdEdificio() {
        return $this->idEdificio;
    }

    function getEdificio() {
        return $this->edificio;
    }

    function getCreatedAt() {
        return $this->createdAt;
    }

    function getUpdatedAt() {
        return $this->updatedAt;
    }

    function setEdificio($edificio){
        $this->edificio = $edificio;
    }


    public function getAll() {
        $edificios = $this->db->query("SELECT * FROM edificios;");
        return $edificios;
    } 

    public function getAllButOne($idEdificioNo) {
        $edificios = $this->db->query("SELECT * FROM edificios WHERE id_edificio != $idEdificioNo ORDER BY edificio");
        return $edificios;
    }      

}