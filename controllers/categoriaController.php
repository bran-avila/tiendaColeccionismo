<?php
require_once 'core/Validator.php';
require_once 'models/Producto.php'; 
require_once 'models/Categoria.php'; 
class categoriaController{
    private $productoModel;
    private $categoriaModel;
    public function __construct() {
        $this->productoModel = new Producto();
        $this->categoriaModel = new Categoria(); 
    }

    public function showCategoria($categoria,$paginas=1, $orderBy=null) {
        // Validar el número de página
        if (!is_numeric($paginas) || $paginas <= 0) {
            $paginas = 1; // Asignar un valor por defecto si la página no es válida
        }

        // Verificar y limpiar el parámetro de orden
        $ordenSQL = null;
        if (!is_null($orderBy)) {
            switch ($orderBy) {
                case 'mayor-precio':
                    $ordenSQL = 'p.precio DESC';
                    break;
                case 'menor-precio':
                    $ordenSQL = 'p.precio ASC';
                    break;
                case 'nombre-abc':
                    $ordenSQL = 'p.nombre ASC';
                    break;
                case 'nombre-zyx':
                    $ordenSQL = 'p.nombre DESC';
                    break;
                default:
                    // Parámetro no válido, redirigir o manejar error
                    header("Location: /");
                    exit();
            }
        }

        // Sanitizar la categoría para evitar inyecciones SQL
        $categoria = htmlspecialchars(trim($categoria));

        // Verificar si la categoría es "todos" o buscar el ID de la categoría
        $idCategoria = ($categoria === "todos") ? null : $this->categoriaModel->obtenerIdPorNombre($categoria);

        // Validar si la categoría existe o si es "todos"
        if ($idCategoria !== null || $categoria === "todos") {
            try {
                // Obtener el total de productos y los productos de la página actual
                $productos_por_pagina = 2;
                $paginacion = $this->productoModel->obtenerTotalProductos($idCategoria);
                $paginacion = ceil($paginacion / $productos_por_pagina);
                $productos = $this->productoModel->obtenerProductosConDetalles($idCategoria, $ordenSQL, $productos_por_pagina, $paginas);
                require_once 'views/categoria/categoria.php';
            } catch (Exception $e) {
                // Manejar cualquier error en la consulta
                echo "Error al obtener productos: " . $e->getMessage();
            }
        } else {
            // Redirigir al índice si la categoría no es válida
            header("Location: /");
            exit();
        }
    }


   
}
?>