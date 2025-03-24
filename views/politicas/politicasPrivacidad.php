<?php 
$titulo = "Politicas privacidad";
$css = "Politicas.css"; 
$js = "Politicas.js";

ob_start(); 


?>
<div class="container">
<div class="container mt-5 text-center">
        <h1 class="text-center">Políticas de Privacidad</h1>
        <p>Bienvenido a nuestra tienda de coleccionismo en México. Nos comprometemos a proteger tu privacidad y datos personales.</p>
        
        <h2>1. Información Recopilada</h2>
        <p>Podemos recopilar información como nombre, correo electrónico, dirección y detalles de pago al realizar una compra.</p>
        
        <h2>2. Uso de la Información</h2>
        <p>Utilizamos tu información para procesar pedidos, mejorar la experiencia del usuario y cumplir con obligaciones legales.</p>
        
        <h2>3. Protección de Datos</h2>
        <p>Implementamos medidas de seguridad para proteger tu información de accesos no autorizados.</p>
        
        <h2>4. Cookies</h2>
        <p>Utilizamos cookies para mejorar la experiencia de navegación. Puedes desactivarlas en tu navegador si lo deseas.</p>
        
        <h2>5. Compartición de Datos</h2>
        <p>No vendemos ni compartimos tu información con terceros, excepto cuando sea necesario para procesar un pedido.</p>
        
        <h2>6. Derechos del Usuario</h2>
        <p>Puedes solicitar acceso, corrección o eliminación de tus datos en cualquier momento.</p>
        
        <h2>7. Contacto</h2>
        <p>Si tienes preguntas sobre nuestras políticas, contáctanos en <a href="mailto:contacto@tutienda.com">contacto@tutienda.com</a>.</p>
    </div>
</div>

<?php 
$contenido = ob_get_clean();

require_once __DIR__ . '/../layouts/layout.php';
?>