<?php 
$titulo = "Lista de categoria";
$css = "categoriaAdmin.css"; 
$js = "categoriaAdmin.js";
$activeSection = 'categoríash';
ob_start(); 


?>
<div class="container my-5">
  <h1>Listado de Categorías</h1>
  <a href="/MICHICOLECCION/admin/categoria/crear" class="btn btn-success mb-3">Nueva Categoría</a>
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($categorias)): ?>
        <?php foreach($categorias as $cat): ?>
          <tr>
            <td><?php echo $cat['idCategoria']; ?></td>
            <td><?php echo $cat['nombre']; ?></td>
            <td>
              <a href="/MICHICOLECCION/admin/categoria/editar/<?php echo $cat['idCategoria']; ?>" class="btn btn-primary btn-sm">Editar</a>
              <a href="/MICHICOLECCION/admin/categoria/borrar/<?php echo $cat['idCategoria']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta categoría?');">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="3" class="text-center">No existen categorías registradas.</td>
        </tr>
      <?php endif; ?>
   
<?php 
$contenido = ob_get_clean();
require_once __DIR__ . '/../layouts/layoutAdmin.php';
?>