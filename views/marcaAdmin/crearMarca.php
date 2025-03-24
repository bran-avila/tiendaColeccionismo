<?php 
$titulo = "Crear Marca";
$css = "marcaAdmin.css"; 
$js = "marcaAdmin.js";
$activeSection = 'marcash';
ob_start(); 


?>

<div class="container my-5">
  <h1>Crear Nueva Marca</h1>
  <form action="/MICHICOLECCION/admin/marca/crear" method="post">
    <div class="mb-3">
      <label for="marca" class="form-label">Nombre de la Marca</label>
      <input type="text" name="marca" id="marca" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="/MICHICOLECCION/admin/marca" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
   
<?php 
$contenido = ob_get_clean();
require_once __DIR__ . '/../layouts/layoutAdmin.php';
?>