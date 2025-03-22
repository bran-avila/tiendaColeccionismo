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
               <form action="" id="fromCheckout" method="POST" novalidate>
                  <div class="pagec slide-pagec">
                     <div class="titlec">
                        Informacion de contacto:
                     </div>
                     <div class="fieldc">
                        <div class="labelc">
                           Correo
                        </div>
                        <input type="email" required name="correo" id="correo" >
                        <div class="invalid-feedback">
                           Ingresa un correo válido.
                        </div>
                     </div>
      
                     <div class="fieldc">
                        <button class="firstNextc nextc">Siguiente</button>
                     </div>
                  </div>
                  <div class="pagec envio" id="sc3">
                     <?php 
                        require_once __DIR__ . '/../checkout/selectDirecciones.php';              
                     ?>
                     <div class="titlec">
                        Dirección de envío:
                     </div>

                     <div class="fieldc">
                        <label class="labelc" for="pais">País</label>
                        <input type="text" class="form-control" id="pais" name="pais" required>
                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                     </div>

                     <div class="fieldc">
                        <label class="labelc" for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                        <div class="invalid-feedback">Ingresa un nombre válido.</div>
                     </div>

                     <div class="fieldc">
                        <label class="labelc" for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        <div class="invalid-feedback">Ingresa los apellidos.</div>
                     </div>

                     <div class="fieldc">
                        <label class="labelc" for="calle">Calle, número interior y exterior</label>
                        <input type="text" class="form-control" id="calle" name="calle" required>
                        <div class="invalid-feedback">Ingresa tu dirección.</div>
                     </div>

                     <div class="fieldc">
                        <label class="labelc" for="colonia">Colonia</label>
                        <input type="text" class="form-control" id="colonia" name="colonia" required>
                        <div class="invalid-feedback">Campo obligatorio.</div>
                     </div>

                     <div class="fieldc">
                        <label class="labelc" for="cp">Código Postal</label>
                        <input type="text" class="form-control" id="cp" name="cp" pattern="\d{5}" required>
                        <div class="invalid-feedback">Ingresa un código postal válido de 5 dígitos.</div>
                     </div>

                     <div class="fieldc">
                        <label class="labelc" for="ciudad">Ciudad</label>
                        <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                        <div class="invalid-feedback">Este campo es obligatorio.</div>
                     </div>

                     <div class="fieldc">
                        <label class="labelc" for="estado">Estado</label>
                        <input type="text" class="form-control" id="estado" name="estado" required>
                        <div class="invalid-feedback">Selecciona un estado válido.</div>
                     </div>

                     <div class="fieldc">
                        <label class="labelc" for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" pattern="\d{10}" required>
                        <div class="invalid-feedback">Ingresa un número de teléfono válido de 10 dígitos.</div>
                     </div>

                     <div class="fieldc btnsc">
                        <button class="prev-1c prevc btn btn-secondary">Anterior</button>
                        <button type="submit" class="next-1c nextc btn btn-primary">Siguiente</button>
                     </div>
                  </div>
                  <div class="pagec">
                     <div class="titlec">
                        Envio:
                     </div>


         <?php if (!empty($metodosEnvio)) : ?>
               <?php
               foreach ($metodosEnvio as $index => $envio) :
                  if ($envioGratis) {
                     if( $envio['idMetodoEnvio'] != 1){
                        continue; // Si el total es mayor a $599, solo mostrar el método con id 1
                     }
                  }else{
                     if ($index === 0) {
                      continue; // Omitir la primera opción
                   }
                  }
            ?>
                  <div class="fieldc">
                     <div class="labelc">
                        <?= htmlspecialchars($envio['tipoEnvio']) ?> $<?= htmlspecialchars($envio['precio']) ?>
                     </div>
                     <input type="radio" name="envio" value="<?= htmlspecialchars($envio['idMetodoEnvio']) ?>" data-cantidad="<?= htmlspecialchars($envio['precio']) ?>">
                     <div class="invalid-feedback">
                        seleccione una opcion.
                     </div>
                  </div>
            <?php endforeach; ?>
         <?php endif; ?>

                     <div class="fieldc btns">
                        <button class="prev-2c prevc">Anterior</button>
                        <button class="next-2c nextc" id="pagar" name="enviar">Pagar</button>
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