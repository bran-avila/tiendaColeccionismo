<?php
require_once 'models/Producto.php'; 
require_once 'core/Validator.php';
require_once 'models/categoriaAdmin.php'; 
class ProductoAdminController {

    private $categoriaModel;
    private $productoModel;

    function __construct(){
        $this->categoriaModel = new Categoria(); 
        $this->productoModel = new Producto();
    }

    public function listarProductos() {
        $productos = $this->productoModel->obtenerProductos();
        $categorias  = $this->categoriaModel->obtenerTodas();
        require 'views/productos/productos.php';
    }

    
    public function agregarProducto() {

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'idMarca' => $_POST['idMarca'],
                'idEstadoProducto' => $_POST['idEstadoProducto'],
                'idCategoria' => $_POST['idCategoria'],
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'borrador' => isset($_POST['borrador']) ? 1 : 0,
                'largo' => $_POST['largo'],
                'ancho' => $_POST['ancho'],
                'alto' => $_POST['alto'],
                'anio' => $_POST['anio'],
                'precio' => $_POST['precio'],
                'ValorComercial' => $_POST['ValorComercial'],
                'peso' => $_POST['cantidad'],
                'cantidad' => $_POST['cantidad']
            ];



             // Manejo de la imagen
            if (isset($_FILES['urlPortadaImg']) && $_FILES['urlPortadaImg']['error'] === UPLOAD_ERR_OK) {
                $archivo = $_FILES['urlPortadaImg'];
                $nombreArchivo = uniqid() . '_' . $archivo['name']; // Nombre único
                $rutaDestino = 'public/img/productos/' . $nombreArchivo; // Ruta donde guardarás la imagen

                // Validar tipo y tamaño del archivo (puedes agregar más validaciones)
                $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
                $tamanoMaximo = 5 * 1024 * 1024; // 5 MB

                if (in_array($archivo['type'], $tiposPermitidos) && $archivo['size'] <= $tamanoMaximo) {
                    if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
                        $datos['urlPortadaImg'] = 'public/img/productos/' . $nombreArchivo; // URL para la base de datos
                    } else {
                        $errors['errorFile'] = 'Error al guardar la imagen.';
                    }
                } else {
                    $errors['errorFile'] = 'Tipo de archivo no válido o tamaño excedido.';
                }
            } else {
                $errors['errorFile'] = 'No se seleccionó ninguna imagen.';
            }

           
            $rules = [
                'idMarca' => ['required', 'numeric'],
                'idEstadoProducto' => ['required', 'numeric'],
                'idCategoria' => ['required', 'numeric'],
                'nombre' => ['required', 'string'],
                'descripcion' => ['string'],
                'borrador' => ['numeric'],
                'largo' => ['float'],
                'ancho' => ['float'],
                'alto' => ['float'],
                'anio' => ['numeric'],
                'precio' => ['required', 'float'],
                'ValorComercial' => ['float'],
                'urlPortadaImg' => ['string'],
                'peso' => ['float'],
                'cantidad' => ['float']
            ];
 
            $errors = array_merge($errors, Validator::validate($datos, $rules));

            if (!empty($errors)) {
                header('Content-Type: application/json');
                echo json_encode(["success" => false, "errors" => $errors]);
                return;
            }
            $resultado =$this->productoModel->agregarProducto($datos);
            header('Content-Type: application/json');
            echo json_encode($resultado);
        }else{
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "errors" => ["no es post"]]);
        }
    }
    
    public function editarProducto($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $datos = [
                'idMarca' => $_POST['idMarca'],
                'idEstadoProducto' => $_POST['idEstadoProducto'],
                'idCategoria' => $_POST['idCategoria'],
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'borrador' => isset($_POST['borrador']) ? 1 : 0,
                'largo' => $_POST['largo'],
                'ancho' => $_POST['ancho'],
                'alto' => $_POST['alto'],
                'anio' => $_POST['anio'],
                'precio' => $_POST['precio'],
                'ValorComercial' => $_POST['ValorComercial'],
                'urlPortadaImg' => $_POST['urlPortadaImg'],
                'peso' => $_POST['peso'],
                'cantidad' => $_POST['cantidad']
            ];

                // 📌 Verificar si hay una nueva imagen
        if (isset($_FILES['urlPortadaImgNuevo']) && $_FILES['urlPortadaImgNuevo']['error'] === UPLOAD_ERR_OK) {
            $archivo = $_FILES['urlPortadaImgNuevo'];
            $nombreArchivo = uniqid() . '_' . basename($archivo['name']);
            $rutaDestino = 'public/img/productos/' . $nombreArchivo;

            // Validar tipo y tamaño del archivo
            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
            $tamanoMaximo = 5 * 1024 * 1024; // 5 MB

            if (!in_array($archivo['type'], $tiposPermitidos)) {
                $errors['errorFile'] = 'Formato de imagen no permitido.';
            } elseif ($archivo['size'] > $tamanoMaximo) {
                $errors['errorFile'] = 'El archivo es demasiado grande (máximo 5MB).';
            } else {
                if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
                    $datos['urlPortadaImg'] = $rutaDestino; // Guardar la nueva imagen
                } else {
                    $errors['errorFile'] = 'Error al guardar la imagen.';
                }
            }
        }


            $rules = [
                'idMarca' => ['required', 'numeric'],
                'idEstadoProducto' => ['required', 'numeric'],
                'idCategoria' => ['required', 'numeric'],
                'nombre' => ['required', 'string'],
                'descripcion' => ['string'],
                'borrador' => ['numeric'],
                'largo' => ['float'],
                'ancho' => ['float'],
                'alto' => ['float'],
                'anio' => ['numeric'],
                'precio' => ['required', 'float'],
                'ValorComercial' => ['float'],
                'urlPortadaImg' => ['string'],
                'peso' => ['float'],
                'cantidad' => ['numeric']
            ];

            $errors = array_merge($errors, Validator::validate($datos, $rules));

            if (!empty($errors)) {
                header('Content-Type: application/json');
                echo json_encode(["success" => false, "errors" => $errors]);
                return;
            }
            
            $resultado = $this->productoModel->editarProducto($id, $datos);
            header('Content-Type: application/json');
            echo json_encode($resultado);

        } else {
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "errors" => ["no es post"]]);
        }
    }

    public function eliminarProducto($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resultado = $this->productoModel->eliminarProducto($id);
            echo json_encode($resultado);
        } else {
            echo json_encode(["success" => false, "message" => "Método no permitido"]);
        }
    }

}

?>
