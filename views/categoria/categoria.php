<?php 
$titulo = $categoria;
$css = "categoria.css"; 
$js = "categoria.js";

ob_start(); 


?>
<div class="container">
   
</div>

<?php 
$contenido = ob_get_clean();

require_once __DIR__ . '/../layouts/layout.php';
?>