<?php
require_once 'core/Validator.php';
require_once 'models/Producto.php'; 
class ProductoController{
    private $productoModel;
    public function __construct() {
        $this->productoModel = new Producto();
    }

    public function showProducto($NombreProducto) {
        // Decodificar la URL para manejar caracteres especiales
        $NombreProducto = urldecode($NombreProducto);
        // Sanitizar el nombre del producto reemplazando "-" por espacios
        $NombreProducto = str_replace("-", " ", filter_var($NombreProducto, FILTER_SANITIZE_STRING));
        // Llamar al método que busca el producto
        $busqueda = $this->productoModel->buscarProductos($NombreProducto);
        $producto = null;
        if (!empty($busqueda)) {
            // $resultados[0] contiene la primera fila como un array asociativo
            $producto = $busqueda[0];
            require_once 'views/producto/producto.php';
          } else {
            echo "No se encontraron resultados.".$NombreProducto;
          }
          

    }


   
}
?>