<?php
require_once 'config/database.php';

class Pedido {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Método para crear una dirección y retornar su ID
    public function crearDireccion($datos) {
        $stmt = $this->db->prepare("INSERT INTO direcciones (nombre, apellidoP, apellidoM, numExterior, numInterior, calle, colonia, cp, telefono, ciudad, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $datos['nombre'], $datos['apellidoP'], $datos['apellidoM'], $datos['numExterior'],
            $datos['numInterior'], $datos['calle'], $datos['colonia'], $datos['cp'],
            $datos['telefono'], $datos['ciudad'], $datos['estado']
        ]);
        return $this->db->lastInsertId();
    }

    // Método para insertar una dirección de usuario y retornar su ID
    public function insertarDireccionUsuario($idUsuario, $idDireccion) {
        $stmt = $this->db->prepare("INSERT INTO direccionesusuarios (idUsuario, idDireccion) VALUES (?, ?)");
        $stmt->execute([$idUsuario, $idDireccion]);
        return $this->db->lastInsertId();
    }

    // Método para insertar un tipo de pago y retornar su ID
    public function insertarTipoPago($datos) {
        $stmt = $this->db->prepare("INSERT INTO tipopagos (idTransaccion, paypal_order_id, payer_id, payer_email, cantidad, currency, status, payment_method, fechaPago) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([
            $datos['idTransaccion'], $datos['paypal_order_id'], $datos['payer_id'],
            $datos['payer_email'], $datos['cantidad'], $datos['currency'],
            $datos['status'], $datos['payment_method']
        ]);
        return $this->db->lastInsertId();
    }

    // Método para insertar un pedido y retornar su ID
    public function insertarPedido($datos) {
        $stmt = $this->db->prepare("INSERT INTO pedidos (idUsuario, idDireccionesUsuario, idMetodoEnvio, idEstatusVenta, idTipoPago, totalBruto, totalNeto, fecha, pesoTotal) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
        $stmt->execute([
            $datos['idUsuario'], $datos['idDireccionesUsuario'], $datos['idMetodoEnvio'],
            $datos['idEstatusVenta'], $datos['idTipoPago'], $datos['totalBruto'],
            $datos['totalNeto'], $datos['pesoTotal']
        ]);
        return $this->db->lastInsertId();
    }

    // Método para insertar un detalle de pedido y retornar su ID
    public function insertarDetallePedido($datos) {
        $stmt = $this->db->prepare("INSERT INTO detallepedido (idPedido, idProducto, cantidad, precioUnitario, subtotal) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $datos['idPedido'], $datos['idProducto'], $datos['cantidad'],
            $datos['precioUnitario'], $datos['subtotal']
        ]);
        return $this->db->lastInsertId();
    }

    public function registrarPedido($datos) {
        try {
            $this->db->beginTransaction();

            // 1. Verificar si se necesita crear una nueva dirección
            if ($datos['idDireccionNueva'] === 'true' || $datos['idDireccionExistente'] === "0" ) {
                $idDireccion = $this->crearDireccion([
                    'nombre' => $datos['nombre'],
                    'apellidoP' => $datos['apellidos'],
                    'apellidoM' => '',
                    'numExterior' => '',
                    'numInterior' => '',
                    'calle' => $datos['calle'],
                    'colonia' => $datos['colonia'],
                    'cp' => $datos['cp'],
                    'telefono' => $datos['telefono'],
                    'ciudad' => $datos['ciudad'],
                    'estado' => $datos['estado']
                ]);

                $idDireccionesUsuario = $this->insertarDireccionUsuario($_SESSION['usuario_id'], $idDireccion);
            } else {
                $idDireccionesUsuario = $this->insertarDireccionUsuario($_SESSION['usuario_id'], $datos['idDireccionExistente']);
            }

            // 2. Insertar el método de pago y obtener su ID
            $idTipoPago = $this->insertarTipoPago([
                'idTransaccion' => $datos['paypal_transaction_id'],
                'paypal_order_id' => $datos['paypal_order_id'],
                'payer_id' => $datos['payer_id'],
                'payer_email' => $datos['payer_email'],
                'cantidad' => $datos['amount'],
                'currency' => $datos['currency'],
                'status' => $datos['status'],
                'payment_method' => $datos['method']
            ]);

            // 3. Registrar el pedido
            $idPedido = $this->insertarPedido([
                'idUsuario' => $_SESSION['usuario_id'],
                'idDireccionesUsuario' => $idDireccionesUsuario,
                'idMetodoEnvio' => $datos['envio'],
                'idEstatusVenta' => 1, // Estado inicial: Preparación
                'idTipoPago' => $idTipoPago,
                'totalBruto' => $datos['amount'],
                'totalNeto' => $datos['amount'],
                'pesoTotal' => 1
            ]);

            // 4. Registrar detalles del pedido
            foreach ($_SESSION['carrito'] as $producto) {
                $detalleInsertado = $this->insertarDetallePedido([
                    'idPedido' => $idPedido,
                    'idProducto' => $producto['id'],
                    'cantidad' => $producto['cantidad'],
                    'precioUnitario' => $producto['precio'],
                    'subtotal' => $producto['precio'] * $producto['cantidad']
                ]);

                // 5. Actualizar el stock del producto
                $stmt = $this->db->prepare("UPDATE productos SET cantidad = cantidad - ? WHERE idProducto = ?");
                $stmt->execute([$producto['cantidad'], $producto['id']]);
            }

            $this->db->commit();
            
            return ['success' => true, 'message' => 'Pedido registrado exitosamente.','idPedido'=>$idPedido];

        } catch (PDOException $e) {
            $this->db->rollBack();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }


    public function obtenerPedidoPorId($idPedido) {
        $stmt = $this->db->prepare("
            SELECT p.idPedido, p.fecha, p.totalBruto, p.totalNeto, e.estado, m.tipoEnvio, t.payment_method, t.status, p.idUsuario,p.idDireccionesUsuario
            FROM pedidos p
            JOIN estatusventa e ON p.idEstatusVenta = e.idEstatusventa
            JOIN metodoenvio m ON p.idMetodoEnvio = m.idMetodoEnvio
            JOIN tipopagos t ON p.idTipoPago = t.idTipoPago
            WHERE p.idPedido = ?
        ");
        $stmt->execute([$idPedido]);

        if (!$stmt) {
            throw new Exception("Pedido no encontrado con el ID: $idPedido");
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function obtenerDetallesPedido($idPedido) {
        $stmt = $this->db->prepare("
            SELECT dp.idProducto, pr.nombre, dp.cantidad, dp.precioUnitario, dp.subtotal
            FROM detallepedido dp
            JOIN productos pr ON dp.idProducto = pr.idProducto
            WHERE dp.idPedido = ?
        ");
        $stmt->execute([$idPedido]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarioPorId($idUsuario) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE idUsuario = ?");
        $stmt->execute([$idUsuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerDireccionPorUsuario($idDireccionesUsuario) {
        $stmt = $this->db->prepare("SELECT idDireccion FROM direccionesusuarios WHERE idDireccionesUsuario = ?");
        $stmt->execute([$idDireccionesUsuario]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $this->obtenerDireccionPorId($resultado['idDireccion']);
        }
        return null;
    }

    public function obtenerDireccionPorId($idDireccion) {
        $stmt = $this->db->prepare("SELECT * FROM direcciones WHERE idDireccion = ?");
        $stmt->execute([$idDireccion]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

        // En Pedido.php (o el modelo que administre usuarios y pedidos)
    public function obtenerPedidosPorUsuario($idUsuario) {
        $stmt = $this->db->prepare("SELECT p.idPedido, p.fecha, p.totalNeto, e.estado 
                                    FROM pedidos p 
                                    JOIN estatusventa e ON p.idEstatusVenta = e.idEstatusventa 
                                    WHERE p.idUsuario = ?");
        $stmt->execute([$idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerDireccionesPorUsuario($idUsuario) {
        // Se obtienen las direcciones asociadas al usuario mediante la tabla direccionesusuarios
        $stmt = $this->db->prepare("SELECT d.* 
                                    FROM direcciones d 
                                    JOIN direccionesusuarios du ON d.idDireccion = du.idDireccion 
                                    WHERE du.idUsuario = ?");
        $stmt->execute([$idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerTodos(){
        $stmt = $this->db->query("SELECT p.*, u.nombre as nombreUsuario, u.correo, e.estado as estadoVenta FROM pedidos p 
                                  JOIN usuarios u ON p.idUsuario = u.idUsuario 
                                  JOIN estatusventa e ON p.idEstatusVenta = e.idEstatusventa");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

}
?>