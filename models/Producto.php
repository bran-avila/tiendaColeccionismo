<?php
require_once 'config/database.php';
class Producto {

    private $db;
    

    public function __construct() {
        $this->db = Database::connect();
    }

    public function obtenerProductos() {
        $sql = "SELECT * FROM productos";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function agregarProducto($datos) {

        try{
        $sql = "INSERT INTO productos (idMarca, idEstadoProducto, idCategoria, nombre, descripcion, borrador, largo, ancho, alto, anio, precio, ValorComercial, urlPortadaImg, peso, cantidad ) 
                VALUES (:idMarca, :idEstadoProducto, :idCategoria, :nombre, :descripcion, :borrador, :largo, :ancho, :alto, :anio, :precio, :ValorComercial, :urlPortadaImg, :peso, :cantidad)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':idMarca', $datos['idMarca'], PDO::PARAM_INT);
        $stmt->bindParam(':idEstadoProducto', $datos['idEstadoProducto'], PDO::PARAM_INT);
        $stmt->bindParam(':idCategoria', $datos['idCategoria'], PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
        $stmt->bindParam(':borrador', $datos['borrador'], PDO::PARAM_BOOL);
        $stmt->bindParam(':largo', $datos['largo'], PDO::PARAM_STR);
        $stmt->bindParam(':ancho', $datos['ancho'], PDO::PARAM_STR);
        $stmt->bindParam(':alto', $datos['alto'], PDO::PARAM_STR);
        $stmt->bindParam(':anio', $datos['anio'], PDO::PARAM_INT);
        $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
        $stmt->bindParam(':ValorComercial', $datos['ValorComercial'], PDO::PARAM_STR);
        $stmt->bindParam(':urlPortadaImg', $datos['urlPortadaImg'], PDO::PARAM_STR);
        $stmt->bindParam(':peso', $datos['peso'], PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $datos['cantidad'], PDO::PARAM_STR);
        $stmt->execute($datos);
        return ["success" => true, "id" => $this->db->lastInsertId()];
    } catch (PDOException $e) {
        return ["success" => false, "message" => $e->getMessage()];
    }

    }

    public function editarProducto($id, $datos) {
        try {
            $query = "UPDATE productos SET idMarca = :idMarca, idEstadoProducto = :idEstadoProducto, idCategoria = :idCategoria, nombre = :nombre, descripcion = :descripcion, borrador = :borrador, largo = :largo, ancho = :ancho, alto = :alto, anio = :anio, precio = :precio, ValorComercial = :ValorComercial, urlPortadaImg = :urlPortadaImg, peso = :peso, cantidad= :cantidad WHERE idProducto = :id";
    
            $stmt = $this->db->prepare($query);
    
            // Vincular parámetros de forma segura
            $stmt->bindValue(':idMarca', $datos['idMarca'], PDO::PARAM_INT); // Asumo que idMarca es un entero
            $stmt->bindValue(':idEstadoProducto', $datos['idEstadoProducto'], PDO::PARAM_INT); // Asumo que idEstadoProducto es un entero
            $stmt->bindValue(':idCategoria', $datos['idCategoria'], PDO::PARAM_INT); // Asumo que idCategoria es un entero
            $stmt->bindValue(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindValue(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
            $stmt->bindValue(':borrador', $datos['borrador'], PDO::PARAM_INT); // Asumo que borrador es un entero (0 o 1)
            $stmt->bindValue(':largo', $datos['largo'], PDO::PARAM_STR); // O PARAM_INT si es un número
            $stmt->bindValue(':ancho', $datos['ancho'], PDO::PARAM_STR); // O PARAM_INT si es un número
            $stmt->bindValue(':alto', $datos['alto'], PDO::PARAM_STR); // O PARAM_INT si es un número
            $stmt->bindValue(':anio', $datos['anio'], PDO::PARAM_INT); // Asumo que anio es un entero
            $stmt->bindValue(':precio', $datos['precio'], PDO::PARAM_STR); // O PARAM_INT/PARAM_FLOAT si es un número
            $stmt->bindValue(':ValorComercial', $datos['ValorComercial'], PDO::PARAM_STR); // O PARAM_INT/PARAM_FLOAT si es un número
            $stmt->bindValue(':urlPortadaImg', $datos['urlPortadaImg'], PDO::PARAM_STR);
            $stmt->bindValue(':peso', $datos['peso'], PDO::PARAM_STR);  // O PARAM_INT/PARAM_FLOAT si es un número
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':cantidad', $datos['cantidad'], PDO::PARAM_INT);
            $stmt->execute();
            $success = $stmt->rowCount() > 0; // Devuelve true si se actualizó al menos una fila
            return ["success" => $success, "message" => "se edito el producto"];
    
        } catch (PDOException $e) {
            error_log("Error al editar producto: " . $e->getMessage());
            return ["success" => false, "message" => $e->getMessage()];
            // Opcional: Re-lanzar la excepción: throw $e;
        }
    }

    public function eliminarProducto($id) {
        try {
            $query = "DELETE FROM productos WHERE idProducto = :id";
            $stmt = $this->db->prepare($query);  // Preparar la consulta
            $stmt->bindValue(':id', $id, PDO::PARAM_INT); // Vincular el parámetro con seguridad
            $stmt->execute(); // Ejecutar la consulta
    
            // Opcional: Verificar si se eliminó alguna fila (útil para manejar errores)
            $success = $stmt->rowCount() > 0; // Devuelve true si se eliminó al menos una fila, false si no.
            return ["success" => $success, "message" => "se edito el producto"];
        } catch (PDOException $e) {
            // Manejo de errores (log, mostrar mensaje, etc.)
            error_log("Error al eliminar producto: " . $e->getMessage()); // Log del error
            return ["success" => false, "message" => $e->getMessage()];
        }
    }


    public function obtenerProductosConDetalles($idCategoria = null, $orden = null, $limite = null) {
        try {
            $sql = "SELECT p.*, 
                           c.nombre AS categoria_nombre, 
                           e.estado AS estado_nombre, 
                           m.marca AS marca_nombre
                    FROM productos p
                    LEFT JOIN categorias c ON p.idCategoria = c.idCategoria
                    LEFT JOIN estadoproducto e ON p.idEstadoProducto = e.idEstadoProducto
                    LEFT JOIN marcas m ON p.idMarca = m.idMarca";
    
            // Si se proporciona un idCategoria, agregamos el filtro
            if ($idCategoria !== null) {
                $sql .= " WHERE p.idCategoria = :idCategoria";
            }
    
            // Validar ORDER BY para evitar inyecciones SQL
            $columnasPermitidas = ['p.nombre', 'p.precio', 'c.nombre', 'e.estado', 'm.marca']; // Lista de columnas permitidas
            $ordenPermitido = ['ASC', 'DESC']; // Solo permitimos estos valores
    
            if ($orden !== null) {
                $partesOrden = explode(' ', trim($orden));
                if (count($partesOrden) === 2 && in_array($partesOrden[0], $columnasPermitidas) && in_array(strtoupper($partesOrden[1]), $ordenPermitido)) {
                    $sql .= " ORDER BY " . $orden;
                } else {
                    return ["success" => false, "message" => "Parámetro de orden no válido."];
                }
            }
    
            // Agregar LIMIT si se proporciona
            if ($limite !== null) {
                $sql .= " LIMIT :limite";
            }
    
            $stmt = $this->db->prepare($sql);
    
            // Enlazamos los parámetros solo si es necesario
            if ($idCategoria !== null) {
                $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
            }
            
            if ($limite !== null) {
                $stmt->bindParam(':limite', $limite, PDO::PARAM_INT);
            }
    
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function buscarProductos($query) {



        try {
            $sql = "SELECT p.idProducto, p.nombre, p.precio, p.urlPortadaImg, 
                           m.marca AS marca_nombre, e.estado AS estado_nombre, c.nombre AS categoria_nombre
                    FROM productos p
                    LEFT JOIN marcas m ON p.idMarca = m.idMarca
                    LEFT JOIN estadoproducto e ON p.idEstadoProducto = e.idEstadoProducto
                    LEFT JOIN categorias c ON p.idCategoria = c.idCategoria
                    WHERE p.nombre LIKE :query1 
                    LIMIT 10";
            
            $stmt = $this->db->prepare($sql);
            $searchTerm = "%$query%";


            $stmt->bindParam(':query1', $searchTerm, PDO::PARAM_STR);


            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }

        
    }


}
?>