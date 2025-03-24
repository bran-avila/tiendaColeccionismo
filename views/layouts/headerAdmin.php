<?php
// Definimos la variable que identifica la sección activa (por ejemplo, obtenida de la URL o definida manualmente)
$activeSection = isset($activeSection) ? $activeSection : '';
?>

<div class='dashboard dashboard-compact'>
    <div class="dashboard-nav">
        <header>
            <a href="#!" class="menu-toggle">
                <i class="fas fa-bars"></i>
            </a>
            <a href="#" class="brand-logo">
                <a class="navbar-brand" href="#">
                    <img src="/MICHICOLECCION/assets/icon/logo.png" alt="Logo de la empresa" class="logo">
                </a>
            </a>
        </header>
        <nav class="dashboard-nav-list">
            <div class="nav-item-divider"></div>
            <a href="/MICHICOLECCION/" class="dashboard-nav-item <?= $activeSection == 'inicioh' ? 'active' : '' ?>">
                <i class="fas fa-home"></i> Inicio
            </a>
            <a href="#" class="dashboard-nav-item <?= $activeSection == 'pedidosh' ? 'active' : '' ?>">
                <i class="fas fa-shopping-cart"></i> Pedidos
            </a>
            <a href="#" class="dashboard-nav-item <?= $activeSection == 'usuariosh' ? 'active' : '' ?>">
                <i class="fas fa-users"></i> Usuarios
            </a>
            <div class='dashboard-nav-dropdown <?= in_array($activeSection, ['productosh', 'categoríash', 'marcash', 'estadoh']) ? 'show' : '' ?>'>
                <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle <?= in_array($activeSection, ['productosh', 'categoríash', 'marcash', 'estadoh']) ? 'active' : '' ?>">
                    <i class="fas fa-store"></i> Productos
                </a>
                <div class='dashboard-nav-dropdown-menu'>
                    <a href="/MICHICOLECCION/admin" class="dashboard-nav-dropdown-item <?= $activeSection == 'productosh' ? 'active' : '' ?>">Productos</a>
                    <a href="/MICHICOLECCION/admin/categoria" class="dashboard-nav-dropdown-item <?= $activeSection == 'categoríash' ? 'active' : '' ?>">Categorías</a>
                    <a href="#" class="dashboard-nav-dropdown-item <?= $activeSection == 'marcash' ? 'active' : '' ?>">Marcas</a>
                </div>
            </div>
            <a href="#" class="dashboard-nav-item <?= $activeSection == 'configuracionh' ? 'active' : '' ?>">
                <i class="fas fa-cogs"></i> Configuración
            </a>
            <div class="nav-item-divider"></div>
            <a href="/MICHICOLECCION/cerrarsesion" class="dashboard-nav-item">
                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
            </a>
        </nav>
    </div>
    <header class='dashboard-toolbar'>
        <a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
    </header>
</div>
<!--
    clase activo para mostrar el activo
<a href="#" class="dashboard-nav-item active"><i class="fas fa-tachometer-alt"></i> Productos </a>
-->