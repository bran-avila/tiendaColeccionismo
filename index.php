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

$router->get('admin', function() {
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
    $checkout = new CheckoutController();
    $checkout->showCheckout();
});

$router->post('checkout/orden', function() {
    $checkout = new CheckoutController();
    $checkout->ordenPagoPaypal();
});

$router->post('checkout/datos', function() {
    $checkout = new CheckoutController();
    $checkout->datosPedido();
});

$router->post('checkout/pedidoCompletado', function() {
    $checkout = new CheckoutController();
    $checkout->procesarCheckout();
});

$router->get('pedido/{idpedido}', function($idpedido) {
    //Middleware::verificarAutenticacion();
    $pedido = new PedidoController();
    $pedido->showPedido($idpedido);
});

$router->post('registrarse', function() {
    $registrarse = new AuthController();
    $registrarse->register();
});
$router->get('usuario', function() {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('usuario');
    $usuario = new UsuarioController(); 
    $usuario->showUserPerfile();
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


$router->get('producto/{producto}', function($producto) {
    $productoControlle = new ProductoController();
    $productoControlle->showProducto($producto);
    
 });

 $router->Post('carrito/agregar', function() {
    $carrito = new CarritoController();
    $carrito->agregarAlCarrito();   
    
 });

 $router->get('carrito', function() {
    $carrito = new CarritoController();
    $carrito->verCarrito();
 
 });

 $router->post('carrito/actualizar', function() {
    $carrito = new CarritoController();
    $carrito->actualizarCantidad();
 
 });

 $router->post('carrito/eliminar', function() {
    $carrito = new CarritoController();
    $carrito->eliminarDelCarrito();
 
 });


/*rutas de categorias*/

$router->get('admin/categoria', function() {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $categoria = new categoriaAdmincontroller();
    $categoria->showCategoria();
});


$router->get('admin/categoria/crear', function() {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $categoria = new categoriaAdmincontroller();
    $categoria->create();
});

$router->post('admin/categoria/crear', function() {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $categoria = new categoriaAdmincontroller();
    $categoria->store();
});

$router->get('admin/categoria/editar/{id}', function($id) {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador');
     
    $categoria = new categoriaAdmincontroller();
    $categoria->edit($id);
});

$router->post('admin/categoria/editar/{id}', function($id) {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $categoria = new categoriaAdmincontroller();
    $categoria->update($id);
});

$router->get('admin/categoria/borrar/{id}', function($id) {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $categoria = new categoriaAdmincontroller();
    $categoria->delete($id);
});

$router->get('admin/categoria/api', function() {
    $categoria = new categoriaAdmincontroller();
    $categoria->apiIndex();
});

/*fin rutas crear categorias */

/*rutas marca*/
$router->get('admin/marca', function() {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $marca = new MarcaAdminController();
    $marca->showMarca();
});

$router->get('admin/marca/crear', function() {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $marca = new MarcaAdminController();
    $marca->create();
});

$router->post('admin/marca/crear', function() {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $marca = new MarcaAdminController();
    $marca->store();
});

$router->get('admin/marca/editar/{id}', function($id) {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador');
    $marca = new MarcaAdminController();
    $marca->edit($id);
});

$router->post('admin/marca/editar/{id}', function($id) {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $marca = new MarcaAdminController();
    $marca->update($id);
});

$router->get('admin/marca/borrar/{id}', function($id) {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $marca = new MarcaAdminController();
    $marca->delete($id);
});

$router->get('admin/marca/api', function() {
    $marca = new MarcaAdminController();
    $marca->apiIndex();
});
/*fin de ruta marca */


// Rutas para Clientes y Pedidos

$router->get('admin/clientes', function() {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $cliente = new ClienteAdminController();
    $cliente->showClientes();
});

$router->get('admin/pedidos', function() {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $pedido = new pedidoController();
    $pedido->showPedidos();
});

$router->get('admin/orden/{id}', function($id) {
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $pedido = new pedidoController();
    $pedido->showPedidoAdmin($id);
});

$router->get('politicasPrivacidad', function() {
    require_once 'views/politicas/politicasPrivacidad.php';
});
$router->get('politicasEnvio', function() {
    require_once 'views/politicas/politicasEnvio.php';
});
$router->get('SobreNosotros', function() {
    require_once 'views/politicas/sobreNosotros.php';
});


$router->post('admin/orden/actualizarEstado', function(){
    Middleware::verificarAutenticacion();  
    Middleware::verificarRol('administrador'); 
    $pedido = new pedidoController();
    $pedido->updateEstado();
});

// Ruta 404 personalizada
$router->setNotFound(function() {
    header("HTTP/1.0 404 Not Found");
    echo "Lo sentimos, la página que buscas no existe.";
});

// Despachar la solicitud actual
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>