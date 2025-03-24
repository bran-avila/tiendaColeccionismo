<?php
require_once 'models/pedido.php'; 
class PedidoController{
    private $pedidoModel;
    public function __construct() {
        $this->pedidoModel = new Pedido(); 
    }

    public function showPedido($id) {
        //iniciar la session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        try{
            $pedido = $this->pedidoModel->obtenerPedidoPorId($id);
            $detalles = $this->pedidoModel->obtenerDetallesPedido($id);

            if(!($pedido['idUsuario']==$_SESSION['usuario_id'])){
                header("Location: /MICHICOLECCION/");
            }
            $usuario = $this->pedidoModel->obtenerUsuarioPorId($pedido['idUsuario']);
            $direccion = $this->pedidoModel->obtenerDireccionPorUsuario($pedido['idDireccionesUsuario']);
            require_once 'views/pedido/pedido.php';
        }catch(Exception $e){
            header("Location: /MICHICOLECCION/");
        }

    }

   
}
?>