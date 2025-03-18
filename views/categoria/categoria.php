<?php 
$titulo = $categoria;
$css = "categoria.css"; 
$js = "categoria.js";

ob_start(); 


?>
<div class="container mt-4" id="contenedorCategoria">
    <div class="row align-items-center mb-4" >
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst($categoria); ?></li>
                </ol>
            </nav>

            <h1 class="d-inline"><?php echo ucfirst($categoria); ?></h1>
        </div>
        <div class="col-md-4">
            <select class="form-select" id="filtroOrden" onchange="ordenarProductos('<?php echo $categoria; ?>')">
                <option value="">Ordenar por</option>
                <option value="mayor-precio" <?php echo ($orderBy === 'mayor-precio') ? 'selected' : ''; ?>>Mayor Precio</option>
                <option value="menor-precio" <?php echo ($orderBy === 'menor-precio') ? 'selected' : ''; ?>>Menor Precio</option>
                <option value="nombre-abc" <?php echo ($orderBy === 'nombre-abc') ? 'selected' : ''; ?>>Nombre (A-Z)</option>
                <option value="nombre-zyx" <?php echo ($orderBy === 'nombre-zyx') ? 'selected' : ''; ?>>Nombre (Z-A)</option>
            </select>
        </div>
    </div>

    <div class="row">
        <?php if (!empty($productos)) : ?>
            <?php foreach ($productos as $producto) : ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="/MICHICOLECCION/<?= htmlspecialchars($producto['urlPortadaImg']) ?>" class="card-img-top" alt="<?php echo $producto['nombre']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $producto['nombre']; ?></h5>
                            <p class="card-text">Precio: $<?php echo number_format($producto['precio'], 2); ?></p>
                            <p class="card-text">Marca: <?php echo $producto['marca_nombre']; ?></p>
                            <p class="card-text">Estado: <?php echo $producto['estado_nombre']; ?></p>
                            <a href="/producto/<?php echo $producto['idProducto']; ?>" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    No hay productos disponibles en esta categoría.
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Paginación -->
    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $paginacion; $i++) : ?>
                <li class="page-item <?php echo ($i == $paginas) ? 'active' : ''; ?>">
                    <a class="page-link" href="/MICHICOLECCION/categoria/<?php echo $categoria; ?>/pagina/<?php echo $i; ?><?php echo $orderBy ? '/ordenar' . '/'.$orderBy : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php 
$contenido = ob_get_clean();

require_once __DIR__ . '/../layouts/layout.php';
?>