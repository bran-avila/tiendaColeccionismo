<?php 
$titulo = "Sobre nosotros";
$css = "Politicas.css"; 
$js = "Politicas.js";

ob_start(); 


?>
<div class="container">
<div class="container  text-center">
        <h1 class="display-4">Sobre Nosotros</h1>
        <p class="lead">Bienvenido a MichiColección, tu tienda favorita de coleccionismo en México.</p>

        <h2>Nuestra Historia</h2>
        <p>MichiColección nació del amor por los videojuegos, las cartas y los artículos de colección. Comenzamos como un pequeño proyecto impulsado por la pasión por el coleccionismo y hemos crecido gracias a la confianza de nuestros clientes.</p>

        <h2>¿Qué Ofrecemos?</h2>
        <p>En MichiColección encontrarás videojuegos clásicos, cartas coleccionables, libros, figuras y otros artículos geek, tanto nuevos como usados. Nos especializamos en ofrecer piezas únicas y productos en excelente estado.</p>

        <h2>Nuestra Misión</h2>
        <p>Brindar a los coleccionistas la oportunidad de encontrar piezas únicas y exclusivas a precios accesibles, garantizando siempre la calidad de cada artículo.</p>

        <h2>¿Por Qué Elegirnos?</h2>
        <p>Porque somos apasionados del coleccionismo como tú, y cuidamos cada pieza como si fuera nuestra. Nuestro compromiso es ofrecer productos de calidad y una experiencia de compra segura y satisfactoria.</p>

        <h2>Contáctanos</h2>
        <p>¿Tienes alguna duda o sugerencia? ¡Nos encantaría escucharte! Puedes comunicarte con nosotros a través de nuestras redes sociales o correo electrónico.</p>
        <a href="#" class="btn btn-custom">Regresar al Inicio</a>
    </div>
</div>

<?php 
$contenido = ob_get_clean();

require_once __DIR__ . '/../layouts/layout.php';
?>