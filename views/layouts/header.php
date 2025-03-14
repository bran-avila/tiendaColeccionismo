<header class="bg-dark text-light" id="headerPrincipal">
    <nav class="navbar navbar-expand-lg navbar-dark d-flex justify-content-between align-items-center mx-3">
                <div class="d-flex  gap-3 flex-grow-1" id="menuTexto">
                    <label class="barM" for="check">
                        <input type="checkbox" id="check">
                        <span class="top"></span>
                        <span class="middle"></span>
                        <span class="bottom"></span>
                    </label>
                    <a class="nav-link fs-3" href="/MICHICOLECCION/">Inicio</a>
                    <div class="dropdown">
                        <a class="nav-link fs-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">CategorÍas</a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="#">Videojuegos</a></li>
                                <li><a class="dropdown-item" href="#">Libros</a></li>
                                <li><a class="dropdown-item" href="#">Cartas</a></li>
                            </ul>  
                    </div>
                </div>
                <div class="d-flex justify-content-center  align-items-center flex-grow-1 " id="ContenedorLogo">
                    <a class="navbar-brand" href="/MICHICOLECCION/"><img  src="assets/icon/logo.png" alt="Logo de la empresa"></a>
                </div>
                <div class="d-flex  gap-3 flex-grow-1 justify-content-end" id="menuIconos">
                    <a class="nav-link "  href="#"><i class="fa-solid fa-cart-shopping fs-3" style="color:#fdc84b"></i></a>
                    <a class="nav-link" href="/MICHICOLECCION/login"><i class="fa-regular fa-user fs-3" style="color:#fdc84b" ></i></a>
                    <a class="nav-link" href="/MICHICOLECCION/buscador"><i class="fa-solid fa-magnifying-glass fs-3" style="color:#fdc84b" ></i></a>
                </div>  
    </nav>
    <?php require_once 'menuOculto.php'; ?>
</header>
<?php require_once 'bannerAnuncio.php'; ?>
