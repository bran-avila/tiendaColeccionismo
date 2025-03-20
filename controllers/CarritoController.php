<?php 

class CarritoController {
    public function agregarAlCarrito() {
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $cantidad_disponible = $_POST['cantidad_disponible'];
            $imagen = $_POST['imagen'];
            
            // Verificar si la cantidad es válida
            if ($cantidad < 1 || $cantidad > $cantidad_disponible) {
                $_SESSION['error'] = "Cantidad no válida.";
                header("Location: /MICHICOLECCION/producto/$id");
                exit();
            }

            // Inicializar carrito si no existe
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            // Verificar si el producto ya está en el carrito
            if (isset($_SESSION['carrito'][$id])) {

                $nuevaCantidad = $_SESSION['carrito'][$id]['cantidad'] + $cantidad;
                
                // Si la nueva cantidad excede la cantidad disponible, redirigir a la vista del carrito
                if ($nuevaCantidad > $cantidad_disponible) {
                    $_SESSION['error'] = "No hay suficiente stock disponible.";
                    header("Location: /MICHICOLECCION/carrito");
                    exit();
                }

                $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
            } else {
                $_SESSION['carrito'][$id] = [
                    'id' => $id,
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'cantidad' => $cantidad,
                    'cantidad_disponible' => $cantidad_disponible,
                    'imagen' => $imagen
                ];
            }
            $_SESSION['totalProductos']=$this->totalProducto();
            header("Location: /MICHICOLECCION/carrito");
            exit();
        }
    }

    public function verCarrito() {
        session_start();
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
        //require_once __DIR__ . '/../views/carrito.php';
        require_once "views/carrito/carrito.php";
    }

    public function eliminarDelCarrito() {
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            
            if (isset($_SESSION['carrito'][$id])) {
                unset($_SESSION['carrito'][$id]);
            }
        }
        
        header("Location: /MICHICOLECCION/carrito");
        exit();
    }

    public function actualizarCantidad() {
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cantidad = $_POST['cantidad'];
     
            if (isset($_SESSION['carrito'][$id])) {
                if ($cantidad > 0 && $cantidad <= $_SESSION['carrito'][$id]['cantidad_disponible']) {
                    $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
                } else {
                    unset($_SESSION['carrito'][$id]);
                }
            }
        }
        $_SESSION['totalProductos']=$this->totalProducto();
        header("Location: /MICHICOLECCION/carrito");
        exit();
    }
    public function totalProducto(){
        $totalProductos = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $producto) {
                $totalProductos += $producto['cantidad'];
            }
        }
        return $totalProductos;
    }

}


?>




