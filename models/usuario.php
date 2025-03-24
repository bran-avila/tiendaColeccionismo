<?php
require_once 'config/database.php';
class UsuarioModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }

    public function registrarUsuario($nombre, $apellidoP, $apellidoM, $correo, $password) {
        try {
            $this->db->beginTransaction();
    
            // Hashear la contraseña
            $hashPassword = password_hash($password, PASSWORD_BCRYPT);
    
            // Insertar usuario
            $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, apellidoP, apellidoM, correo, passwordUser) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $apellidoP, $apellidoM, $correo, $hashPassword]);
    
            // Obtener el ID del usuario recién creado
            $idUsuario = $this->db->lastInsertId();
    
            // Asignar el rol por defecto (1 = user, 2 = admin, ajusta según tu BD)
            $stmt = $this->db->prepare("INSERT INTO usuariosRoles (idUsuario, idRol) VALUES (?, ?)");
            $stmt->execute([$idUsuario, 1]);
    
            $this->db->commit();
            echo "id:".$idUsuario."nombre:".$nombre;
            return ["id"=>$idUsuario,"rol"=>["usuario"],"nombre"=>$nombre,"verificacion"=>true];
        } catch (Exception $e) {
            $this->db->rollBack();
            return ["verificacion"=>false];
        }
    }

    public function obtenerUsuarioPorCorreo($correo) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerRolesUsuario($idUsuario) {
        $stmt = $this->db->prepare("SELECT r.nombreRol FROM usuariosRoles ur JOIN Roles r ON ur.idRol = r.idRol WHERE ur.idUsuario = ?");
        $stmt->execute([$idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


    public function obtenerTodos(){
        $stmt = $this->db->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
}

?>