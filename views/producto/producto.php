<?php 
$titulo = $NombreProducto;
$css = "producto.css"; 
$js = "producto.js";

ob_start(); 


?>
<div class="container mt-4" id="contenedorProducto">
    <div class="row col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/MICHICOLECCION/">Inicio</a></li>
                <li class="breadcrumb-item"><a href="/MICHICOLECCION/categoria/<?php echo $producto['categoria_nombre']; ?>/pagina/1"><?php echo $producto['categoria_nombre']; ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst($NombreProducto); ?></li>
            </ol>
        </nav>
        <h1 class="d-inline"><?php echo ucfirst($NombreProducto); ?></h1>
    </div>
<div class="row">
    <div class="col-md-6">
        <div class="ContenedorImg">
            <img src="/MICHICOLECCION/<?= htmlspecialchars($producto['urlPortadaImg']) ?>
            " class="card-img-top img-fluid" alt="<?php echo $producto['nombre']; ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="card contenedorDatos">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                    <form action="/MICHICOLECCION/carrito/agregar" method="post">
                    
                        <input type="hidden" id="id" name="id" value="<?php echo $producto['idProducto']; ?>">
                        <input type="hidden" name="nombre" value="<?php echo $producto['nombre']; ?>">
                        <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
                        <input type="hidden" name="cantidad_disponible" value="<?php echo $producto['cantidad']; ?>">
                        <input type="hidden" name="imagen" value="<?php echo $producto['urlPortadaImg']; ?>">                  
                        
                    
                        <p class="card-text fs-2">Descripción: <?php echo $producto['descripcion']; ?></p>
                        <p class="card-text fs-2">Precio: $<?php echo number_format($producto['precio'], 2); ?></p>
                        <p class="card-text fs-2">Marca: <?php echo $producto['marca_nombre']; ?></p>
                        <p class="card-text fs-2">Estado: <?php echo $producto['estado_nombre']; ?></p>
                        <div class="contenedorNumer">
                            <p class="card-text fs-2">Cantidad:</p>
                            <div class="number-control ">
                                <div class="number-left"></div>
                                <input type="number" id="cantidad" name="cantidad" min="1" class="number-quantity"
                                max="<?php echo  number_format($producto['cantidad'], 2); ?>" step="1" value="1">
                                <div class="number-right"></div>
                            </div>
                        </div>
                        <button class="button"  type="submit">
                            <div><span>Agregar al carrito </span></div>
                        </button>
                    </form>

                    <!--
                    <a href="/MICHICOLECCION//carrito/<?php// echo $producto['idProducto']; ?>" class="btn btn-primary">agregar carrito</a>
                    -->
            </div>
        </div>
    </div>
</div>
</div>

<?php 
$contenido = ob_get_clean();

require_once __DIR__ . '/../layouts/layout.php';
?>