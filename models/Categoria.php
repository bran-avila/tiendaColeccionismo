<?php
require_once 'config/database.php';

class Categoria {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Obtener todas las categorías
    public function obtenerTodasLasCategorias() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM categorias");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    // Obtener el ID de la categoría por nombre
    public function obtenerIdPorNombre($nombreCategoria) {
        try {
            $stmt = $this->db->prepare("SELECT idCategoria FROM categorias WHERE nombre = ?");
            $stmt->execute([$nombreCategoria]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ? (int)$resultado['idCategoria'] : null;
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    // Registrar una nueva categoría
    public function registrarCategoria($nombreCategoria) {
        try {
            $stmt = $this->db->prepare("INSERT INTO categorias (nombre) VALUES (?)");
            $stmt->execute([$nombreCategoria]);
            return ["success" => true, "idCategoria" => $this->db->lastInsertId()];
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    // Editar una categoría existente
    public function editarCategoria($idCategoria, $nuevoNombre) {
        try {
            $stmt = $this->db->prepare("UPDATE categorias SET nombre = ? WHERE idCategoria = ?");
            $stmt->execute([$nuevoNombre, $idCategoria]);
            return ["success" => true, "message" => "Categoría actualizada correctamente."];
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    // Eliminar una categoría
    public function eliminarCategoria($idCategoria) {
        try {
            $stmt = $this->db->prepare("DELETE FROM categorias WHERE idCategoria = ?");
            $stmt->execute([$idCategoria]);
            return ["success" => true, "message" => "Categoría eliminada correctamente."];
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}

?>