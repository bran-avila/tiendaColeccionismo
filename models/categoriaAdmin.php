<?php
require_once 'config/database.php';

class Categoria {
    private $db;

    public function __construct(){
         $this->db = Database::connect();
    }

    // Obtiene todas las categorías
    public function obtenerTodas(){
         $stmt = $this->db->query("SELECT * FROM categorias");
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene una categoría por su ID
    public function obtenerPorId($id){
         $stmt = $this->db->prepare("SELECT * FROM categorias WHERE idCategoria = ?");
         $stmt->execute([$id]);
         return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Inserta una nueva categoría
    public function insertar($nombre){
         $stmt = $this->db->prepare("INSERT INTO categorias (nombre) VALUES (?)");
         return $stmt->execute([$nombre]);
    }

    // Actualiza una categoría existente
    public function actualizar($id, $nombre){
         $stmt = $this->db->prepare("UPDATE categorias SET nombre = ? WHERE idCategoria = ?");
         return $stmt->execute([$nombre, $id]);
    }

    // Elimina una categoría
    public function eliminar($id){
         $stmt = $this->db->prepare("DELETE FROM categorias WHERE idCategoria = ?");
         return $stmt->execute([$id]);
    }
}
?>