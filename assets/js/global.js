// Seleccionamos el checkbox y el div del menu oculto
const checkbox = document.getElementById("check");
const target = document.getElementById("menuOculto");
const categoria = document.getElementById("categoriaM");
const body = document.body;
const MenuCategoria = document.getElementById("subMenu");
// Agregamos el evento de click
checkbox.addEventListener("click", function () {
    target.classList.toggle("activar"); 
    body.classList.toggle("noScroll"); 
});

categoria.addEventListener("click", function () {
    MenuCategoria.classList.toggle("activarM"); 
});