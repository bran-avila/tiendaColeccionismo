// Esperamos que el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function() {
    const searchForm = document.getElementById('searchForm');  // El formulario de búsqueda
    const searchInput = document.getElementById('search');  // El campo de búsqueda

    // Añadimos un evento para cuando el usuario escribe en el campo de búsqueda
    searchInput.addEventListener('input', function() {
        // Si el campo de búsqueda no está vacío
        if (searchInput.value.trim() !== '') {
            // Enviar la búsqueda al servidor
            const datos  = searchInput.value.replace(/ /g, "-");

            fetch(`buscar/${encodeURIComponent(datos)}`, {
                method: 'GET',  // Método GET para enviar la consulta
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())  // Convertimos la respuesta a JSON
            .then(data => {
                console.log("Resultados de búsqueda:", data.productos, data.dato);
                // Aquí puedes procesar los resultados
                // Ejemplo: mostrar los productos en el DOM
                mostrarResultados(data.productos);
            })
            .catch(error => {
                console.error('Error al buscar:', error);
            });
        }else{
            mostrarResultados([]);//mandamos un arreglo vacio para que limpie los datos
        }
    });

    // Función para mostrar los resultados de la búsqueda
    function mostrarResultados(resultados) {
        let contenedorResultados = document.getElementById('contenedorProductos');
        console.log(contenedorResultados);
        contenedorResultados.innerHTML = ''; // Limpiar resultados previos
        
        
        resultados.forEach(producto => {
            const divProducto = document.createElement('div');
            divProducto.classList.add('col-12', 'col-lg-3', 'col-md-6'); // Agregar las clases de columnas
            divProducto.innerHTML = `
                <div class="cardProducto">
                    <div class="image_container">
                        <img class="imgProduct" src="${producto.urlPortadaImg}" alt="Logo de la empresa">
                    </div>
                    <div class="title">
                        <span>${producto.nombre}</span>
                    </div>
                    <div class="title">
                        <span>${producto.estado_nombre}</span>
                    </div>
                    <div class="action">
                        <div class="price">
                            <span>$${producto.precio}</span>
                        </div>
                        <button class="cart-button">
                            <svg class="cart-icon" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" stroke-linejoin="round" stroke-linecap="round"></path>
                            </svg>
                            <span>Comprar</span>
                        </button>
                    </div>
                </div>
            `;
            contenedorResultados.appendChild(divProducto);
        });
    }
});