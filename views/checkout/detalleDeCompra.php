<div class="container mt-5">
        <h2 class="text-center mb-4">Detalle de Compra</h2>
        
        <?php if (!empty($carrito)): ?>
            <div class="card shadow p-4">
                <table class="table table-bordered  tableProductos">
                    <thead class="table">
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($carrito as $producto): 
                            $subtotal = $producto['precio'] * $producto['cantidad'];
                            $total += $subtotal;
                        ?>
                            <tr>
                               
                               <td>
                               <img src="<?= htmlspecialchars($producto['imagen']) ?>" width="50" height="50" class="rounded">
                                 <?= htmlspecialchars($producto['nombre']) ?>
                              </td>
                                <td>$<?= number_format($producto['precio'], 2) ?></td>
                                <td><?= $producto['cantidad'] ?></td>
                                <td>$<?= number_format($subtotal, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-end mt-3">
                    <h5 class="fw-bold">Subtotal: $ <span id="Subtotal" data-valor="<?=number_format($total, 2)?>"><?= number_format($total, 2) ?></span></h5>
                    <h5 class="fw-bold">Envío: $ <span id="Envio" data-valor="<?=number_format(0, 2)?>"><?= number_format(0, 2) ?></span></h5>
                    <h4 class="fw-bold">Total: $ <span id="Total" data-valor="<?=number_format($total + 0, 2)?>"><?= number_format($total + 0, 2) ?></span></h4>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                No hay productos en el carrito.
            </div>
        <?php endif; ?>
    </div>