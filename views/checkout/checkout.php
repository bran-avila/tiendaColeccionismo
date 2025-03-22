<?php 
$titulo = "Lista de Productos";
$css = "checkout.css"; 
$js = "checkout.js";
ob_start(); 


?>
<?php
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
$total = 0;
?>
<script src="https://www.paypal.com/sdk/js?client-id=AYmkW-I_J63Cz7gRXzAspoEJzI_Tl0otpRCK2fTPa2JaFOD-Y9G9s5vhTEwmFOPqqxDvytuROEiCJLNu&currency=USD"></script>
<div class="container">
   <div class="row">
      <div class="col-md-6 col-12 contenedorHijos">
         <?php 
         require_once __DIR__ . '/../checkout/detalleDeCompra.php';              
         ?>
      </div>
      <div class="col-md-6 col-12  contenedorHijos">
         <?php 
         require_once __DIR__ . '/../checkout/formularioCheckout.php';              
         ?>
      </div>
   </div>
</div>



<?php 
$contenido = ob_get_clean();
require_once __DIR__ . '/../layouts/layout.php';
?>