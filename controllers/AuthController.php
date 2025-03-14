<?php
require_once 'usuarioController.php'; 

class AuthController {
    private $usuarioController;



    public function __construct() {
        $this->usuarioController = new UsuarioController();
    }

    // Mostrar el formulario de login
    public function showLogin() {
        require_once 'views/login/login.php';
    }

    // Procesar el login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['Email'];
            $password = $_POST['Password'];
        
            if ($this->usuarioController->login($correo, $password)) {
                header("Location: /MICHICOLECCION/productos"); // Redirige a un panel de control
                exit();
            } else {
                $error="Error autenticacion";
                header("Location: /MICHICOLECCION/login");
                exit();
            }
        }
    }

    // Cerrar sesión
    public function logout() {
        $this->usuarioController->logout();
        header("Location: /MICHICOLECCION/login");
        exit();
    }
    

       // Procesar registro de usuario
       public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['Nombre'];
            $email = $_POST['Email'];
            $password = $_POST['Password'];

            // Validaciones básicas
            if (empty($name) || empty($email) || empty($password)) {
                echo "Todos los campos son obligatorios.";
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Correo no válido.";
                return;
            }

           

            $result = $this->usuarioController->registrarUsuario($name,"","", $email, $password);

            if ($result) {
                header("Location: /MICHICOLECCION/usuario");
            } else {
                echo "Error al registrar usuario. Intenta con otro correo.";
                header("Location: /MICHICOLECCION/login");
            }
        }
    }

}
?>