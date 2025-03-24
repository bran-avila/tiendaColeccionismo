<?php
require_once 'models/categoriaAdmin.php'; 
class categoriaAdmincontroller{

    private $categoriaModel;
    
    public function __construct() {
        $this->categoriaModel = new Categoria(); 
    }
    public function showCategoria(){
        $categorias  = $this->categoriaModel->obtenerTodas();
        require 'views/categoriaAdmin/categoria.php';
    }
  // Muestra el formulario para crear una nueva categoría
  public function create(){
            require_once 'views/categoriaAdmin/crearCategoria.php';
    }   
    
    // Guarda la nueva categoría en la base de datos
    public function store(){
        if(isset($_POST['nombre'])){
            $nombre = $_POST['nombre'];
            $categoria = new Categoria();
            $categoria->insertar($nombre);
        }
        header("Location: /MICHICOLECCION/admin/categoria");
   }

   // Muestra el formulario para editar una categoría existente
   public function edit($id){
        $categoria = new Categoria();
        $cat = $categoria->obtenerPorId($id);
        require_once 'views/categoriaAdmin/actualizarCategoria.php';
   }

   // Actualiza la categoría en la base de datos
   public function update($id){
        if(isset($_POST['nombre'])){
            $nombre = $_POST['nombre'];
            $categoria = new Categoria();
            $categoria->actualizar($id, $nombre);
        }
        header("Location: /MICHICOLECCION/admin/categoria");
   }

   // Elimina una categoría
   public function delete($id){
        $categoria = new Categoria();
        $categoria->eliminar($id);
        header("Location: /MICHICOLECCION/admin/categoria");
   }

   public function apiIndex(){
        $categoria = new Categoria();
        $categorias = $categoria->obtenerTodas();
        header('Content-Type: application/json');
        echo json_encode($categorias);
    }
}
?>