<div class="container-fluid separador">
    <div class="row">
        <h2 class="col-12 text-center">Algunos videojuegos disponibles:</h2> 
    </div>
    <div class="row" id="listaProductos">

    <?php foreach ($productos as $producto) : ?>
    
            <div class="col-12 col-lg-3 col-md-6">
                <div class="cardProducto">
                    <div class="image_container">
                        <img class="imgProduct" src="<?= htmlspecialchars($producto['urlPortadaImg']) ?>" alt="imagen producto">
                    </div>
                    <div class="title">
                        <span><?= htmlspecialchars($producto['nombre']) ?></span>
                    </div>
                    <div class="title">
                        <span><?= htmlspecialchars($producto['estado_nombre']) ?></span>
                    </div>
                    
                    <div class="action">
                        <div class="price">
                        <span>$<?= htmlspecialchars($producto['precio']) ?></span>
                        </div>
                        <button class="cart-button">
                        <svg
                            class="cart-icon"
                            stroke="currentColor"
                            stroke-width="1.5"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"
                            stroke-linejoin="round"
                            stroke-linecap="round"
                            ></path>
                        </svg>
                        <span><a href="/MICHICOLECCION/producto/<?php echo str_replace(" ", "-",$producto['nombre']);?>">Comprar</a></span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


    </div>
</div>
