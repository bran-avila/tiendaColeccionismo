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

/*rellenar las categorias de los headers */

const endpoint = '/MICHICOLECCION/admin/categoria/api';

fetch(endpoint)
  .then(response => {
    /*if (!response.ok) {
      throw new Error('Error en la respuesta del servidor');
    }*/
    return response.json();
  })
  .then(data => {
    // data es un array con las categorías
    const dropdownMenu = document.getElementById('dropdownMenu');
    const subMenu = document.getElementById('subMenu');

    // Limpia los elementos existentes (opcional)
    dropdownMenu.innerHTML = '';
    subMenu.innerHTML = '';

    data.forEach(category => {
      // Crear elemento para dropdown
      const liDropdown = document.createElement('li');
      const aDropdown = document.createElement('a');
      aDropdown.className = 'dropdown-item';
      aDropdown.href = '/MICHICOLECCION/categoria/'+category.nombre+'/pagina/1'; // Puedes ajustar la URL
      aDropdown.textContent = category.nombre;
      liDropdown.appendChild(aDropdown);
      dropdownMenu.appendChild(liDropdown);

      // Crear elemento para subMenu
      const liSub = document.createElement('li');
      const aSub = document.createElement('a');
      aSub.href = '#'; // Ajusta la URL si es necesario
      aSub.textContent = category.nombre;
      liSub.appendChild(aSub);
      subMenu.appendChild(liSub);
    });
  })
  .catch(error => console.error('Error fetching categories:', error));