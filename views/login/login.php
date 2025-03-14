<?php 
$titulo = "Login";
$css = "login.css"; 
$js = "login.js";

ob_start(); 


?>
<div class="containerlogin">
   <div class="BTNContenedor" > 
      <p><b>Entrar </b> </p>
      <div class="contenedorEfecto">
         <div class="toggle-container">
         <input class="toggle-input" type="checkbox" id="btnCheckBox">
         <div class="toggle-handle-wrapper">
            <div class="toggle-handle">
               <div class="toggle-handle-knob"></div>
               <div class="toggle-handle-bar-wrapper">
               <div class="toggle-handle-bar"></div>
               </div>
               </div>
               </div>
         <div class="toggle-base">
            <div class="toggle-base-inside"></div>
         </div>
         </div>
      </div>
   <p> <b> registrarse </b> </p>
   </div>
<div class="wrapper">
            <div class="flip-card__inner" id="flip-card__inner">
               <div class="flip-card__front">
                  <div class="title">Iniciar sesión</div>
                  <form class="flip-card__form"  action="/MICHICOLECCION/login" method="POST">
                     <input class="flip-card__input" name="Email" placeholder="Email" type="email">
                     <input class="flip-card__input" name="Password" placeholder="Password" type="password">
                     <button class="flip-card__btn"type="submit" >Iniciar sesión</button>
                  </form>
               </div>
               <div class="flip-card__back">
                  <div class="title">Crear una cuenta</div>
                  <form class="flip-card__form" action="/MICHICOLECCION/registrarse"  method="post">
                     <input class="flip-card__input" placeholder="Nombre" name="Nombre" type="Nombre">
                     <input class="flip-card__input" name="Email" placeholder="Email" type="email">
                     <input class="flip-card__input" name="Password" placeholder="Password" type="password">
                     <button class="flip-card__btn" type="submit">Registarte</button>
                  </form>
               </div>
            </div>
        </div>   
</div>




</div>

<?php 
$contenido = ob_get_clean();
require_once __DIR__ . '/../layouts/layout.php';
?>