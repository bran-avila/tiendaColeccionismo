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

    public function crearPedido($idUsuario, $idDireccion, $idMetodoEnvio, $idTipoPago) {
        try {
            $this->db->beginTransaction();
            /*
            $stmt = $this->db->prepare("SELECT SUM(precio * cantidad) AS total FROM detalleCarritos WHERE idCarrito = (SELECT idCarrito FROM carritos WHERE idEstadoCarrito = 1 AND idUsuario = ?)");
            $stmt->execute([$idUsuario]);
            $totalBruto = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

            if ($totalBruto == 0) {
                return ["success" => false, "message" => "El carrito está vacío."];
            }*/

            $stmt = $this->db->prepare("INSERT INTO pedidos (idUsuario, idDireccionesUsuario, idMetodoEnvio, idEstatusVenta, idTipoPago, totalBruto, totalNeto, fecha) VALUES (?, ?, ?, 1, ?, ?, ?, NOW())");
            $totalNeto = $totalBruto; 
            $stmt->execute([$idUsuario, $idDireccion, $idMetodoEnvio, $idTipoPago, $totalBruto, $totalNeto]);

            $idPedido = $this->db->lastInsertId();
            
            $stmt = $this->db->prepare("INSERT INTO detalleEnvio (idPedido, precioGuia, numeroGuia, paqueteria) VALUES (?, 0, '', '')");
            $stmt->execute([$idPedido]);

            $stmt = $this->db->prepare("DELETE FROM detalleCarritos WHERE idCarrito = (SELECT idCarrito FROM carritos WHERE idEstadoCarrito = 1 AND idUsuario = ?)");
            $stmt->execute([$idUsuario]);

            $this->db->commit();

            return ["success" => true, "message" => "Pedido realizado con éxito", "idPedido" => $idPedido];
        } catch (PDOException $e) {
            $this->db->rollBack();
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
?>
