<?php 
$titulo = "Michicoleccion";
$css = "inicio.css"; 
$js = "inicio.js";

ob_start(); 


?>
<div class="containerinicio">
<?php require_once 'banner.php'; ?>
<?php require_once 'categoria.php'; ?>
<?php require_once 'listaProductos.php'; ?>
</div>

<?php 
$contenido = ob_get_clean();

require_once __DIR__ . '/../layouts/layout.php';
?>