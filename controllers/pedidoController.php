<?php
require_once 'models/pedido.php'; 
class PedidoController{
    private $pedidoModel;
    public function __construct() {
        $this->pedidoModel = new Pedido(); 
    }

    public function showPedido($id) {
        $pedido = $this->pedidoModel->obtenerPedidoPorId($id);
        $detalles = $this->pedidoModel->obtenerDetallesPedido($id);
        $usuario = $this->pedidoModel->obtenerUsuarioPorId($pedido['idUsuario']);
        $direccion = $this->pedidoModel->obtenerDireccionPorUsuario($pedido['idDireccionesUsuario']);
        require_once 'views/pedido/pedido.php';
    }

   
}
?>