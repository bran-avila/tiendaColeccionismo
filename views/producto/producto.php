<?php 
$titulo = $NombreProducto;
$css = "producto.css"; 
$js = "producto.js";

ob_start(); 


?>
<div class="container mt-4" id="contenedorProducto">

</div>

<?php 
$contenido = ob_get_clean();

require_once __DIR__ . '/../layouts/layout.php';
?>