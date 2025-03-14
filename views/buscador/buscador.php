<?php 
$titulo = "Buscador";
$css = "buscador.css"; 
$js = "buscador.js";

ob_start(); 


?>
<div class="container">
    <div class="row" id="contenedorBuscador">
        <h2 class="text-center col-12" >Busca tu producto:</h2>
        <div class="contenedorBuscador">
            <form >
                <label class="label" for="search">Search</label>
                <input required="" pattern=".*\S.*" type="search" class="input" id="search">
                <span class="caret"></span>
            </form>
        </div>
            <div class="row" id="contenedorProductos">
            
            </div>
    </div>
</div>

<?php 
$contenido = ob_get_clean();

require_once __DIR__ . '/../layouts/layout.php';
?>