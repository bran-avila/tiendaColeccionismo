<?php
require_once 'models/usuario.php';
require_once 'models/pedido.php';
class UsuarioController {
    private $usuarioModel;
    private $pedidoModel;

    public function __construct() {
        $this->usuarioModel = new UsuarioModel();
        $this->pedidoModel = new Pedido(); 
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login($correo, $password) {
        $usuario = $this->usuarioModel->obtenerUsuarioPorCorreo($correo);
        if ($usuario && password_verify($password, $usuario['passwordUser'])) {
            $_SESSION['usuario_id'] = $usuario['idUsuario'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_roles'] = $this->usuarioModel->obtenerRolesUsuario($usuario['idUsuario']);
            
            session_regenerate_id(true);
            return true;
        }
        return false;
    }

    public function logout() {
        session_unset();
        session_destroy();
    }

    public function verificarRol($rol) {
        if (!isset($_SESSION['usuario_roles']) || empty($_SESSION['usuario_roles'])) {
            return false;
        }

        return array_intersect($_SESSION['usuario_roles'], (array)$rolesPermitidos);
    }

    public function registrarUsuario($name,$apellidoP,$apellidoM, $email, $password){
       $registrado = $this->usuarioModel->registrarUsuario($name,$apellidoP,$apellidoM, $email, $password);
       
        if($registrado["verificacion"]){
            $_SESSION['usuario_id'] = $registrado["id"];
            $_SESSION['usuario_nombre'] = $registrado["nombre"];
            $_SESSION['usuario_roles'] = $registrado["rol"];
            session_regenerate_id(true);
            return true;
       }else{
        return  false;
       }

    }

    public function showUserPerfile(){

        $usuarioId = $_SESSION['usuario_id'];
        $usuario = $this->pedidoModel->obtenerUsuarioPorId($usuarioId);
        $pedidos = $this->pedidoModel->obtenerPedidosPorUsuario($usuarioId);
        $direcciones = $this->pedidoModel->obtenerDireccionesPorUsuario($usuarioId);
        $usuario_roles = $_SESSION['usuario_roles'];
        require_once "views/usuario/usuario.php";
    }
}




?>