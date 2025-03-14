<?php
require_once 'models/Producto.php'; 
class inicioController{
    private $productoModel;
    public function __construct() {
        $this->productoModel = new Producto(); 
    }

    public function showInicio() {
        $productos = $this->productoModel->obtenerProductosConDetalles(null,null,4);
        require_once 'views/inicio/inicio.php';
    }
}
?>