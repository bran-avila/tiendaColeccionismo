<?php
class Middleware {
    public static function iniciarSesion() {
        if (session_status() === PHP_SESSION_NONE) { // Si la sesión no está activa, la inicia
            session_start();
        }
    }

    public static function verificarAutenticacion() {
        self::iniciarSesion();  // Asegura que la sesión solo se inicie si no está activa

        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /MICHICOLECCION/login");
            exit();
        }
    }

    public static function verificarRol($rol) {
        self::iniciarSesion();

        if (!isset($_SESSION['usuario_roles']) || !in_array($rol, $_SESSION['usuario_roles'])) {
            die("Acceso denegado. No tienes permisos para ver esta página.");
        }
    }

    public static function redirigirSiAutenticado($destino = "/MICHICOLECCION") {
        self::iniciarSesion();

        if (isset($_SESSION['usuario_id'])) {
            header("Location: " . $destino);
            exit();
        }
    }
}
?>