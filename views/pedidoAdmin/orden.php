<?php 
$titulo = "Orden";
$css = "Pedidos.css"; 
$js = "Pedidos.js";
$activeSection = 'pedidosh';
ob_start(); 


?>

<div class="container my-5">
<div class="card shadow-lg">
            <div class="card-header bg-dark text-white text-center">
                <h2>Orden de Compra</h2>
            </div>
            <div class="card-body">
                <h4>Detalles del Pedido</h4>
                <p><strong>ID Pedido:</strong> <?php echo $pedido['idPedido']; ?></p>
                <p><strong>Fecha:</strong> <?php echo $pedido['fecha']; ?></p>
                <div class="mb-3">
                    <label for="estadoVenta" class="form-label fw-bold">Estado:</label>
                    <select id="estadoVenta" data-id="<?php echo $pedido['idPedido']; ?>" class="form-select">
                        <?php foreach($estatusVenta as $estatus): ?>
                            <option value="<?php echo $estatus['idEstatusventa']; ?>" <?php echo ($pedido['estado'] == $estatus['estado']) ? 'selected' : ''; ?>>
                                <?php echo $estatus['estado']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <p><strong>Método de Pago:</strong> <?php echo $pedido['payment_method']; ?> (<?php echo $pedido['status']; ?>)</p>
                <p><strong>Total Bruto:</strong> $<?php echo number_format($pedido['totalBruto'], 2); ?></p>
                <p><strong>Total Neto:</strong> $<?php echo number_format($pedido['totalNeto'], 2); ?></p>
                
                <h4 class="mt-4">Datos del Comprador</h4>
                <p><strong>Nombre:</strong> <?php echo $usuario['nombre']; ?> <?php echo $usuario['apellidoP']; ?> <?php echo $usuario['apellidoM']; ?></p>
                <p><strong>Correo Electrónico:</strong> <?php echo $usuario['correo']; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $direccion['telefono']; ?></p>
                <p><strong>Dirección:</strong> <?php echo $direccion['calle']; ?>, <?php echo $direccion['colonia']; ?>, <?php echo $direccion['ciudad']; ?>, <?php echo $direccion['estado']; ?>, C.P. <?php echo $direccion['cp']; ?></p>

                <h4 class="mt-4">Productos Comprados</h4>
                <table class="table table-bordered table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalles as $detalle): ?>
                        <tr>
                            <td><?php echo $detalle['nombre']; ?></td>
                            <td><?php echo $detalle['cantidad']; ?></td>
                            <td>$<?php echo number_format($detalle['precioUnitario'], 2); ?></td>
                            <td>$<?php echo number_format($detalle['subtotal'], 2); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="text-center mt-4">
                    <a href="/MICHICOLECCION/admin/pedidos" class="btn btn-primary">Volver a la lista pedidos</a>
                </div>
            </div>
        </div>
</div>

<?php 
$contenido = ob_get_clean();
require_once __DIR__ . '/../layouts/layoutAdmin.php';
?>