<?php 
$titulo = "Usuario";
$css = "usuario.css"; 
$js = "usuario.js";

ob_start(); 


?>
<div class="container my-5">
<div class="container my-5 usuario">

    <div class="d-flex justify-content-end mb-3">
      <?php if(in_array("administrador", $usuario_roles)): ?>
        <a href="admin" class="btn btn-outline-primary me-2">Panel de Administración</a>
      <?php endif; ?>
      <a href="cerrarsesion" class="btn btn-outline-danger">Cerrar Sesión</a>
    </div>


    <h1 class="mb-4">Bienvenido, <?php echo $usuario['nombre']; ?></h1>
    <ul class="nav nav-tabs" id="miCuentaTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pedidos-tab" data-bs-toggle="tab" data-bs-target="#pedidos" type="button" role="tab" aria-controls="pedidos" aria-selected="true">Mis Pedidos</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="direcciones-tab" data-bs-toggle="tab" data-bs-target="#direcciones" type="button" role="tab" aria-controls="direcciones" aria-selected="false">Mis Direcciones</button>
      </li>
    </ul>
    <div class="tab-content" id="miCuentaTabContent">
      <!-- Sección de Pedidos -->
      <div class="tab-pane fade show active" id="pedidos" role="tabpanel" aria-labelledby="pedidos-tab">
        <div class="table-responsive mt-4">
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th>ID Pedido</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Total Neto</th>
                <th>Ver Detalle</th>
              </tr>
            </thead>
            <tbody>
              <?php if($pedidos): ?>
                <?php foreach($pedidos as $pedido): ?>
                  <tr>
                    <td><?php echo $pedido['idPedido']; ?></td>
                    <td><?php echo $pedido['fecha']; ?></td>
                    <td><?php echo $pedido['estado']; ?></td>
                    <td>$<?php echo number_format($pedido['totalNeto'], 2); ?></td>
                    <td><a href="pedido/<?php echo $pedido['idPedido']; ?>" class="btn btn-sm btn-primary">Detalle</a></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" class="text-center">No tienes pedidos realizados.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Sección de Direcciones -->
      <div class="tab-pane fade" id="direcciones" role="tabpanel" aria-labelledby="direcciones-tab">
        <div class="mt-4">
          <?php if($direcciones): ?>
            <?php foreach($direcciones as $direccion): ?>
              <div class="card mb-3">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $direccion['calle']; ?>, <?php echo $direccion['colonia']; ?></h5>
                  <p class="card-text">
                    <?php echo $direccion['ciudad']; ?>, <?php echo $direccion['estado']; ?>, C.P. <?php echo $direccion['cp']; ?>
                  </p>
                  <p class="card-text"><small class="text-muted">Teléfono: <?php echo $direccion['telefono']; ?></small></p>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="text-center">No tienes direcciones registradas.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
$contenido = ob_get_clean();

require_once __DIR__ . '/../layouts/layout.php';
?>