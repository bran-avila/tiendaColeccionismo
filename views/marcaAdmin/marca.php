<?php 
$titulo = "Lista de Marca";
$css = "marcaAdmin.css"; 
$js = "marcaAdmin.js";
$activeSection = 'marcash';
ob_start(); 


?>


<div class="container my-5">
  <h1>Listado de Marcas</h1>
  <a href="/MICHICOLECCION/admin/marca/crear" class="btn btn-success mb-3">Nueva Marca</a>
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($marcas)): ?>
        <?php foreach($marcas as $m): ?>
          <tr>
            <td><?php echo $m['idMarca']; ?></td>
            <td><?php echo $m['marca']; ?></td>
            <td>
              <a href="/MICHICOLECCION/admin/marca/editar/<?php echo $m['idMarca']; ?>" class="btn btn-primary btn-sm">Editar</a>
              <a href="/MICHICOLECCION/admin/marca/borrar/<?php echo $m['idMarca']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta marca?');">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="3" class="text-center">No existen marcas registradas.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

   
<?php 
$contenido = ob_get_clean();
require_once __DIR__ . '/../layouts/layoutAdmin.php';
?>