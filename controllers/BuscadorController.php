<?php
require_once 'core/Validator.php';
require_once 'models/Producto.php'; 
class BuscadorController{
    private $productoModel;
    public function __construct() {
        $this->productoModel = new Producto(); 
    }

    public function showBuscador() {
        $productos = $this->productoModel->obtenerProductosConDetalles(null,null,4);
        require_once 'views/buscador/buscador.php';
    }

    public function buscar($dato) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($dato)) {

                    // Validación del input
            $datos = ['query' => trim($dato)];

            $rules = [
                'query' => ['required', 'string']
            ];

            $errors = Validator::validate($datos, $rules);


            if (!empty($errors)) {
                echo json_encode(["success" => false, "errors" => $errors]);
                return;
            }

            $query = str_replace("-", " ", $dato);


           $resultado = $this->productoModel->buscarProductos($query);
           
            header('Content-Type: application/json');
             echo json_encode(["success" => true, "productos" => $resultado,"dato"=>$dato]);
             return;
        } else {
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "errors" => ["Método no permitido o falta el parámetro 'query'"]]);
            return;
        }
    }
}
?>