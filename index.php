<?php
//registro de errores en un documento y no mandarlo como respuesta

error_reporting(E_ALL);
ini_set('display_errors', 0); 
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

require_once 'core/autoload.php';
require_once 'core/Router.php';
require_once 'core/Middleware.php';


$router = new Router();

// Página principal 
$router->get('/', function() {
    $inicio = new InicioController();
    $inicio->showInicio();
});

$router->get('buscador', function() {
    $buscador = new BuscadorController();
    $buscador->showBuscador();
});

$router->get('buscar/{dato}', function($dato) {
    $buscar = new BuscadorController();
    $buscar->buscar($dato);
});

$router->get('productos', function() {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $listaProducto = new ProductoAdminController();
    $listaProducto->listarProductos();
});


$router->post('producto/add', function() {
    $producto = new ProductoAdminController();
    $producto->agregarProducto();
});

$router->post('producto/eliminar', function() {
    $idProducto = $_POST['idProducto'];
    $producto = new ProductoAdminController();
    $producto->eliminarProducto($idProducto);
});

$router->post('producto/editar', function() {
    $idProducto = $_POST['idProducto'];
    $producto = new ProductoAdminController();
    $producto->editarProducto($idProducto);
});


$router->get('login', function() {
    Middleware::redirigirSiAutenticado();
    $login = new AuthController();
    $login->showLogin();
});

$router->post('login', function() {
    
    $login = new AuthController();
    $login->login();
});


$router->get('checkout', function() {
    require 'views/checkout/checkout.php';
});

$router->post('registrarse', function() {
    $registrarse = new AuthController();
    $registrarse->register();
});
$router->get('usuario', function() {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('usuario'); 
    echo"ID usuario:". $_SESSION['usuario_id'];
    echo"<br>";
    echo"nombre usuario:". $_SESSION['usuario_nombre'];
    echo"<br>";
    echo"Rol usuario:". $_SESSION['usuario_roles'][0];
});

$router->get('cerrarsesion', function() {
    echo "sesion cerrada";
    $sesion = new AuthController();
    $sesion->logout();
});
$router->get('categoria/{categoria}/pagina/{pagina}', function($categoria,$pagina) {
   $categoriaControlador = new categoriaController();
    $categoriaControlador->showCategoria($categoria,$pagina);
});

$router->get('categoria/{categoria}/pagina/{pagina}/ordenar/{order}', function($categoria,$pagina,$order) {
   $categoriaControlador = new categoriaController();
    $categoriaControlador->showCategoria($categoria,$pagina,$order);
});


// Ruta 404 personalizada
$router->setNotFound(function() {
    header("HTTP/1.0 404 Not Found");
    echo "Lo sentimos, la página que buscas no existe.";
});

// Despachar la solicitud actual
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>