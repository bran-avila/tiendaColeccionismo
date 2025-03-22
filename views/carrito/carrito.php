<?php 
$titulo = "Carrito de Compras";
$css = "carrito.css"; 
$js = "carrito.js";

ob_start(); 
?>

<div class="container carritoContenedor">
        <div class="row  mb-12" >
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/MICHICOLECCION">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Carrito compras</li>
                    </ol>
                </nav>
        </div>

    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-8">
                <div class="p-2">
                    <h1>Carrito de Compras</h1>
                    <div class="d-flex flex-row align-items-center pull-right">
                        <span class="mr-1">Cantidad de productos:</span>
                        <span class="mr-1 font-weight-bold"><?= isset($_SESSION['carrito']) ? $_SESSION['totalProductos'] : 0 ?></span>
                    </div>
                </div>

                <?php if (!empty($_SESSION['carrito'])): ?>
                    <?php foreach ($_SESSION['carrito'] as $producto): ?>
                        <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded">
                            <div class="mr-1">
                                <img class="rounded" src="<?= htmlspecialchars($producto['imagen']) ?>" width="70" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                            </div>
                            <div class="d-flex flex-column align-items-center product-details">
                                <span class="font-weight-bold"><?= htmlspecialchars($producto['nombre']) ?></span>
                                <span class="">Precio unitario:$<?= htmlspecialchars($producto['precio']) ?></span>
                            </div>
                            <div class="d-flex flex-row align-items-center qty">
                                <form action="/MICHICOLECCION/carrito/actualizar" method="post">
                                    <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                                    
                                    <!-- Botón de disminuir cantidad -->
                                    <button type="submit" name="cantidad" value="<?= max(1, $producto['cantidad'] - 1) ?>" 
                                        class="btn btn-sm btn-outline-danger"
                                        <?= $producto['cantidad'] <= 1 ? 'disabled' : '' ?>>
                                        -
                                    </button>

                                    <span class="mx-2"><?= $producto['cantidad'] ?></span>

                                    <!-- Botón de aumentar cantidad -->
                                    <button type="submit" name="cantidad" value="<?= min($producto['cantidad_disponible'], $producto['cantidad'] + 1) ?>" 
                                        class="btn btn-sm btn-outline-success"
                                        <?= $producto['cantidad'] >= $producto['cantidad_disponible'] ? 'disabled' : '' ?>>
                                        +
                                    </button>
                                </form>
                            </div>
                            <div>
                                <h5 class="text-grey">$<?= number_format($producto['precio'] * $producto['cantidad'], 2) ?></h5>
                            </div>
                            <div class="d-flex align-items-center">
                                <form action="/MICHICOLECCION/carrito/eliminar" method="post">
                                    <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <div class="d-flex flex-row align-items-center mt-3 p-2 bg-white rounded">
                        <button class="btn btn-warning btn-block btn-lg ml-2 pay-button" type="button" id="btnPagar"><a href="/MICHICOLECCION/checkout">Pagar productos</a></button>
                    </div>

                <?php else: ?>
                    <div class="alert alert-warning text-center mt-4">
                        <h4>Tu carrito está vacío</h4>
                        <p>Explora nuestra tienda y agrega productos a tu carrito.</p>
                        <a href="/MICHICOLECCION/" class="btn btn-primary">Ir a la tienda</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php 
$contenido = ob_get_clean();
require_once __DIR__ . '/../layouts/layout.php';
?>