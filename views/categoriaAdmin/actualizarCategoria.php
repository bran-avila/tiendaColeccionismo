<?php 
$titulo = "Lista de categoria";
$css = "categoriaAdmin.css"; 
$js = "categoriaAdmin.js";
$activeSection = 'categoríash';
ob_start(); 


?>
<div class="container my-5">
  <h1>Editar Categoría</h1>
  <form action="/MICHICOLECCION/admin/categoria/editar/<?php echo $cat['idCategoria']; ?>" method="post">
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre de la Categoría</label>
      <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $cat['nombre']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="/MICHICOLECCION/admin/categoria" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
   
<?php 
$contenido = ob_get_clean();
require_once __DIR__ . '/../layouts/layoutAdmin.php';
?>