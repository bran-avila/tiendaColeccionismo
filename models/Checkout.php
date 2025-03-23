<?php
require_once 'config/database.php';

class CheckoutModel {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function obtenerCarrito($idUsuario) {
        /*tengo el carrito en las variables seccion
        try {
            $stmt = $this->db->prepare("SELECT * FROM detalleCarritos WHERE idCarrito = (SELECT idCarrito FROM carritos WHERE idEstadoCarrito = 1 AND idUsuario = ?)");
            $stmt->execute([$idUsuario]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }*/
    }

    public function obtenerDirecciones($idUsuario) {
        try {
            $stmt = $this->db->prepare("
                SELECT d.idDireccion, d.nombre, d.apellidoP, d.apellidoM, d.numExterior, d.numInterior, 
                       d.calle, d.colonia, d.cp, d.telefono, d.ciudad, d.estado
                FROM direccionesUsuarios du
                INNER JOIN direcciones d ON du.idDireccion = d.idDireccion
                WHERE du.idUsuario = ?
            ");
            $stmt->execute([$idUsuario]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function obtenerMetodosEnvio() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM metodoEnvio");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }


    public function obtenerMetodoEnvioPorId($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM metodoEnvio WHERE idMetodoEnvio = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }
    public function obtenerTiposPago() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM tiposPago");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

}
?>
