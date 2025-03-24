<?php 
$titulo = "Politicas envio";
$css = "Politicas.css"; 
$js = "Politicas.js";

ob_start(); 


?>
<div class="container">
<div class="container  text-center">
        <h1 class="display-4">Políticas de Envío</h1>
        <p class="lead">Bienvenido a MichiColección. A continuación, encontrarás nuestras políticas de envío para garantizar una experiencia de compra segura y confiable.</p>

        <h2>1. Proceso de Envío</h2>
        <p>Todos los pedidos se procesan en un plazo de 1 a 3 días hábiles después de recibir el pago. Los envíos se realizan a través de mensajerías reconocidas en México (como DHL, FedEx y Estafeta) para asegurar la llegada en óptimas condiciones.</p>

        <h2>2. Costos de Envío</h2>
        <p>Los costos de envío varían según el tamaño, el peso del artículo y la ubicación del comprador. Al realizar la compra, se calcularán automáticamente los costos.</p>

        <h2>3. Tiempos de Entrega</h2>
        <p>El tiempo de entrega puede variar dependiendo de la ubicación del cliente. Por lo general, el tiempo estimado es de 3 a 7 días hábiles dentro de México.</p>

        <h2>4. Artículos Usados y Nuevos</h2>
        <p>Algunos productos pueden ser artículos usados, en cuyo caso se especificará en la descripción. Nos aseguramos de que todos los productos estén en buen estado antes del envío.</p>

        <h2>5. Rastreo del Pedido</h2>
        <p>Una vez enviado el pedido, recibirás un número de rastreo para monitorear el paquete en tiempo real.</p>

        <h2>6. Devoluciones y Reembolsos</h2>
        <p>No se aceptan devoluciones ni reembolsos para artículos usados. Para productos nuevos, las devoluciones se aceptan en un plazo de 7 días después de la entrega, siempre y cuando el producto esté en su empaque original y sin usar.</p>

        <h2>Contacto</h2>
        <p>Si tienes alguna duda o inquietud sobre tu envío, contáctanos a través de nuestro correo electrónico o redes sociales.</p>
        <a href="#" class="btn btn-custom">Regresar al Inicio</a>
    </div>
</div>

<?php 
$contenido = ob_get_clean();

require_once __DIR__ . '/../layouts/layout.php';
?>