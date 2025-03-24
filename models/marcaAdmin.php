<?php
require_once 'config/database.php';

class Marca {
    private $db;

    public function __construct(){
         $this->db = Database::connect();
    }

    public function obtenerTodas(){
         $stmt = $this->db->query("SELECT * FROM marcas");
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id){
         $stmt = $this->db->prepare("SELECT * FROM marcas WHERE idMarca = ?");
         $stmt->execute([$id]);
         return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertar($nombre){
         $stmt = $this->db->prepare("INSERT INTO marcas (marca) VALUES (?)");
         return $stmt->execute([$nombre]);
    }

    public function actualizar($id, $nombre){
         $stmt = $this->db->prepare("UPDATE marcas SET marca = ? WHERE idMarca = ?");
         return $stmt->execute([$nombre, $id]);
    }

    public function eliminar($id){
         $stmt = $this->db->prepare("DELETE FROM marcas WHERE idMarca = ?");
         return $stmt->execute([$id]);
    }
}