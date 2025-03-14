<?php 
$titulo = "Lista de Productos";
$css = "checkout.css"; 
$js = "checkout.js";
ob_start(); 


?>

<div class="containerc bounce-in-left">
            <header>Checkout</header>
            <div class="progress-barc">
               <div class="stepc">
                  <p>
                     Contacto
                  </p>
                  <div class="bulletc">
                     <span>1</span>
                  </div>
                  <div class="checkc fas fa-check"></div>
               </div>
               <div class="stepc">
                  <p>
                     Direccion
                  </p>
                  <div class="bulletc">
                     <span>2</span>
                  </div>
                  <div class="checkc fas fa-check"></div>
               </div>
               <div class="stepc">
                  <p>
                     Envio
                  </p>
                  <div class="bulletc">
                     <span>3</span>
                  </div>
                  <div class="checkc fas fa-check"></div>
               </div>
               <div class="stepc">
                  <p>
                     Pago
                  </p>
                  <div class="bulletc">
                     <span>4</span>
                  </div>
                  <div class="checkc fas fa-check"></div>
               </div>
            </div>
            <div class="form-outerc">
               <form action="" id="fromCheckout" method="POST">
                  <div class="pagec slide-pagec">
                     <div class="titlec">
                        Informacion de contacto:
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Correo
                        </div>
                        <input type="email" required name="correo" >
                     </div>
      
                     <div class="fieldc">
                        <button class="firstNextc nextc">Siguiente</button>
                     </div>
                  </div>
                  <div class="pagec envio" id="sc3">
                     <div class="titlec">
                        Direccion de envio:
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Pais
                        </div>
                        <input type="text" required name="pais"  >
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Nombre
                        </div>
                        <input type="text" required name="nombre" >
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Apellidos
                        </div>
                        <input type="text" required name="apellidos" >
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Calle,numero interior y exterior
                        </div>
                        <input type="text" required name="calle" >
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Colonia
                        </div>
                        <input type="text" required name="colonia" >
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Codigo postal
                        </div>
                        <input type="text" required name="cp" >
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Ciudad
                        </div>
                        <input type="textc" required name="ciudad" >
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Estado
                        </div>
                        <input type="text" required name="estado" >
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Telefono
                        </div>
                        <input type="text" required name="telefono" >
                     </div>
                     <div class="fieldc btnsc">
                        <button class="prev-1c prevc">Anterior</button>
                        <button class="next-1c nextc">Siguiente</button>
                     </div>
                  </div>
                  <div class="pagec">
                     <div class="titlec">
                        Envio:
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Economico (7 a 10 dias) $60
                        </div>
                        <input type="radio" name="envio" value="1"  data-cantidad="60" >
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Normal (2 a 5 dias) $120
                        </div>
                        <input type="radio" name="envio" value="2" data-cantidad="120" >
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Economico (1 a 3 dias) $180
                        </div>
                        <input type="radio" name="envio" value="3" data-cantidad="180" >
                     </div>
                     <div class="fieldc btns">
                        <button class="prev-2c prevc">Anterior</button>
                        <button class="next-2c nextc" type="submit" name="enviar">Pagar</button>
                     </div>
                  </div>
                  <div class="pagec">
                     <div class="titlec">
                        Metodo pago:
                     </div>
                     <div id="paypal-button-container"></div>
                     <div class="fieldc btns">
                        <button class="prev-3c prevc">Anterior</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>


<?php 
$contenido = ob_get_clean();
require_once __DIR__ . '/../layouts/layout.php';
?>