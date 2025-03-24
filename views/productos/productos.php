<?php 
$titulo = "Lista de Productos";
$css = "productos.css"; 
$js = "productos.js";
$activeSection = 'productosh';//AQUI VA EL NOMBRE DEL LINK DEL HEADER al final con una h ver headerAdmin.php para entender
ob_start(); 


?>
<section class="py-4">
    <div class="container-fluid" style="height: 80vh;">
     <div class="row">
         <div class="col-8">
             <h1 class="text mb-4">Lista de Productos</h1>
         </div>
         <div class="col-4">
         <div class="d-flex mt-3" style="justify-content:flex-end;">
                <a class="btn btn-primary" id="btnAgregar">Agregar Producto</a>
            </div>
         </div>
     </div>   
        <div class="row ">
            <div class="table-responsive col-12">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Peso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?= htmlspecialchars($producto['idProducto']) ?></td>
                                <td><?= htmlspecialchars($producto['nombre']) ?></td>
                                <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                                <td>$<?= number_format($producto['precio'], 2) ?></td>
                                <td><?= htmlspecialchars($producto['peso']) ?> kg</td>
                                <td>
                                    <button class="btn btn-info btn-sm btn-editar"  
                                        data-id="<?= $producto['idProducto'] ?>"
                                        data-cantidad="<?= $producto['cantidad'] ?>"
                                        data-marca="<?= $producto['idMarca'] ?>"
                                        data-estado="<?= $producto['idEstadoProducto'] ?>"
                                        data-categoria="<?= $producto['idCategoria'] ?>"
                                        data-nombre="<?= htmlspecialchars($producto['nombre'], ENT_QUOTES) ?>"
                                        data-descripcion="<?= htmlspecialchars($producto['descripcion'], ENT_QUOTES) ?>"
                                        data-borrador="<?= $producto['borrador'] ?>"
                                        data-largo="<?= $producto['largo'] ?>"
                                        data-ancho="<?= $producto['ancho'] ?>"
                                        data-alto="<?= $producto['alto'] ?>"
                                        data-anio="<?= $producto['anio'] ?>"
                                        data-precio="<?= $producto['precio'] ?>"
                                        data-valor-comercial="<?= $producto['ValorComercial'] ?>"
                                        data-url-imagen="<?= htmlspecialchars($producto['urlPortadaImg'], ENT_QUOTES) ?>"
                                        data-peso="<?= $producto['peso'] ?>">
                                        Editar
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-eliminar" data-id="<?= $producto['idProducto'] ?>">Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    
            
        </div>
    </section>
             <?php require_once 'views/productos/formAgregarProductoB.php'; ?>
             <?php require_once 'views/productos/formEditarProductoB.php'; ?>
        </div>

        </div>

<?php 
$contenido = ob_get_clean();
require_once __DIR__ . '/../layouts/layoutAdmin.php';
?>