<?php 
require_once 'models/usuario.php'; 
class ClienteAdminController {
    private $UsuarioModel;
    
    public function __construct() {
        $this->UsuarioModel = new UsuarioModel(); 
    }

    public function showClientes(){
        $clientes = $this->UsuarioModel->obtenerTodos();
        require 'views/clienteAdmin/cliente.php';
    }
}

?>