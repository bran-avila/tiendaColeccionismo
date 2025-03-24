<?php 
$titulo = "Pedidos";
$css = "Pedidos.css"; 
$js = "Pedidos.js";
$activeSection = 'pedidosh';
ob_start(); 


?>

<div class="container my-5">
  <h1>Listado de Pedidos</h1>
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Correo</th>
        <th>Total Neto</th>
        <th>Fecha</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($pedidos as $p): ?>
        <tr>
          <td> <a href="/MICHICOLECCION/admin/orden/<?php echo $p['idPedido'];?>"><?php echo $p['idPedido'];?></a></td>
          <td><?php echo $p['nombreUsuario']; ?></td>
          <td><?php echo $p['correo']; ?></td>
          <td><?php echo $p['totalNeto']; ?></td>
          <td><?php echo $p['fecha']; ?></td>
          <td><?php echo $p['estadoVenta']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

   
<?php 
$contenido = ob_get_clean();
require_once __DIR__ . '/../layouts/layoutAdmin.php';
?>