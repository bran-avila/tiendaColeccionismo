<?php 
$titulo = "Clientes";
$css = "Clientes.css"; 
$js = "Clientes.js";
$activeSection = 'usuariosh';
ob_start(); 


?>
<div class="container my-5">
  <h1>Listado de Clientes</h1>
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($clientes as $c): ?>
        <tr>
          <td><?php echo $c['idUsuario']; ?></td>
          <td><?php echo $c['nombre']; ?></td>
          <td><?php echo $c['correo']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php 
$contenido = ob_get_clean();
require_once __DIR__ . '/../layouts/layoutAdmin.php';
?>