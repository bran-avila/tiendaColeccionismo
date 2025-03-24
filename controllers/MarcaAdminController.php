<?php
require_once 'models/marcaAdmin.php'; 

class MarcaAdminController {
    private $marcaModel;
    
    public function __construct() {
        $this->marcaModel = new Marca(); 
    }

    public function showMarca(){
        $marcas = $this->marcaModel->obtenerTodas();
        require 'views/marcaAdmin/marca.php';
    }

    public function create(){
        require_once 'views/marcaAdmin/crearMarca.php';
    }
    
    public function store(){
        if(isset($_POST['marca'])){
            $nombre = $_POST['marca'];
            $marca = new Marca();
            $marca->insertar($nombre);
        }
        header("Location: /MICHICOLECCION/admin/marca");
    }

    public function edit($id){
        $marca = new Marca();
        $m = $marca->obtenerPorId($id);
        require_once 'views/marcaAdmin/actualizarMarca.php';
    }

    public function update($id){
        if(isset($_POST['marca'])){
            $nombre = $_POST['marca'];
            $marca = new Marca();
            $marca->actualizar($id, $nombre);
        }
        header("Location: /MICHICOLECCION/admin/marca");
    }

    public function delete($id){
        $marca = new Marca();
        $marca->eliminar($id);
        header("Location: /MICHICOLECCION/admin/marca");
    }

    public function apiIndex(){
        $marca = new Marca();
        $marcas = $marca->obtenerTodas();
        header('Content-Type: application/json');
        echo json_encode($marcas);
    }
}