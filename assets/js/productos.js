
const btnAgregar = document.getElementById("btnAgregar");
const formularioContainer = document.getElementById("formularioContainer");
const formProducto = document.getElementById("formProducto");
const menuFlotante = document.querySelector("#menuFlotante");
const btncerrar = document.querySelector("#btncerrar");

    // Mostrar/Ocultar formulario
    btnAgregar.addEventListener("click", function () {
        menuFlotante.classList.remove("closing");
        menuFlotante.classList.add("active");
    });
    btncerrar.addEventListener("click", function () {
        menuFlotante.classList.add("closing");
        setTimeout(() => {
            menuFlotante.classList.remove("active", "closing");
        }, 600);
    });
    // Enviar datos con Fetch API agregar
    formProducto.addEventListener("submit", function (event) {
        event.preventDefault();
        
        // Validación con Bootstrap
        if (!formProducto.checkValidity()) {
            event.stopPropagation();
            formProducto.classList.add("was-validated");
            return; // Detiene el envío si hay errores
        }
    
        const formData = new FormData(formProducto);
        console.log(formData);
        fetch("producto/add", {
            method: "POST",
            body: formData
        })
        .then(response =>{
            if (!response.ok) {
                throw new Error("Error en la solicitud: " + response.status);
            }
            return response.json();
            
            })
        .then(data => {
            console.log("soy el dato"+data);
            if (data.success) {
                alert("Producto agregado con éxito");
                location.reload(); // Recargar la página para ver el nuevo producto
            } else {
                alert("Error al agregar producto: " );
                console.log(data);
            }
        })
        .catch(error => {console.log("Error:", error)});
    });
//eliminar producto 
    // Evento para Eliminar
    document.querySelectorAll(".btn-eliminar").forEach((boton) => {
        boton.addEventListener("click", function () {
            const idProducto = this.dataset.id;
            console.log(idProducto);
    
            if (confirm("¿Seguro que deseas eliminar este producto?")) {
                const formData = new FormData();
                formData.append("idProducto", idProducto);
    
                fetch("producto/eliminar", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("Respuesta del servidor:", data);
                    if (data.success) {
                        console.log("retorna");
                        location.reload();
                        //boton.closest("tr").remove(); // Elimina la fila de la tabla
                    } else {
                        alert("Error al eliminar el producto.");
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });

    //editar Productos

    //abrir formulario editar producto y agregar los datos
    const formularioEditar = document.querySelector("#menuFlotanteEditar");
    const btnCerrarFormEdit = document.querySelector("#btncerrarEdit");
    document.querySelectorAll(".btn-editar").forEach((boton) => {
        boton.addEventListener("click", function () {
            
            const idProducto = this.dataset.id;
            console.log(idProducto);
                    // Obtener referencia al formulario
            const formulario = document.getElementById("formProductoEditar");

            // Obtener datos del producto desde los atributos data-*
            formulario.querySelector("[name='nombre']").value = this.dataset.nombre;
            formulario.querySelector("[name='descripcion']").value = this.dataset.descripcion;
            formulario.querySelector("[name='idMarca']").value = this.dataset.marca;
            formulario.querySelector("[name='idEstadoProducto']").value = this.dataset.estado;
            formulario.querySelector("[name='idCategoria']").value = this.dataset.categoria;
            formulario.querySelector("[name='anio']").value = this.dataset.anio;
            formulario.querySelector("[name='precio']").value = this.dataset.precio;
            formulario.querySelector("[name='ValorComercial']").value = this.dataset.valorComercial;
            formulario.querySelector("[name='largo']").value = this.dataset.largo;
            formulario.querySelector("[name='ancho']").value = this.dataset.ancho;
            formulario.querySelector("[name='alto']").value = this.dataset.alto;
            formulario.querySelector("[name='peso']").value = this.dataset.peso;
            formulario.querySelector("[name='urlPortadaImg']").value = this.dataset.urlImagen;
            formulario.querySelector("[name='cantidad']").value = this.dataset.cantidad;

////////////////////////////////////////////////////////////////////////////////
//agregar imagen editar y parar animacion
            const inputArchivoEditar = document.getElementById('fileEditar');
            const animacionCirculo = inputArchivoEditar.parentElement;
            animacionCirculo.style.animation = 'none';
            const animacionLogo = inputArchivoEditar.nextElementSibling;
            animacionLogo.style.animation = 'none';
            const imgProducto = animacionCirculo.nextElementSibling;
            const urlImagen = this.dataset.urlImagen;
            // Asigna la URL a la propiedad src de la imagen
            imgProducto.src = urlImagen;
            imgProducto.style.display = 'block';
//////////////////////////////////////////////////////////////////




            // Manejo del checkbox 'borrador'
            formulario.querySelector("[name='borrador']").checked = this.dataset.borrador == "1";

            // Almacenar el ID del producto en un campo oculto
            let idHidden = formulario.querySelector("[name='idProducto']");
            if (!idHidden) {
                idHidden = document.createElement("input");
                idHidden.type = "hidden";
                idHidden.name = "idProducto";
                formulario.appendChild(idHidden);
            }
            idHidden.value = this.dataset.id;


            formularioEditar.classList.remove("closing");
            formularioEditar.classList.add("active");

        });
    });

    btnCerrarFormEdit.addEventListener("click", function () {
        formularioEditar.classList.add("closing");
        setTimeout(() => {
            formularioEditar.classList.remove("active", "closing");
        }, 600);
    });


    
    //enviar datos del formulario editar
    let formEditar=document.getElementById("formProductoEditar");
    formEditar.addEventListener("submit", function (event) {
        event.preventDefault();
    
        // Validación con Bootstrap
        if (!formEditar.checkValidity()) {
            event.stopPropagation();
            formEditar.classList.add("was-validated");
            return; // Detiene el envío si hay errores
        }


        const formData = new FormData(this);

        
        fetch("producto/editar", { // Ajusta la ruta según tu backend
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Producto actualizado con éxito");
                location.reload(); // Recargar la página para ver los cambios
            } else {
                alert("Error al actualizar producto: " + data.errors);
                console.log(data);
            }
        })
        .catch(error => console.error("Error:", error));
    });


//detener animacion input file agregar y agregar imagen
const inputArchivoAgregar = document.getElementById('fileAgregar');

inputArchivoAgregar.addEventListener('change', () => {
  // Se ha seleccionado un archivo
  if (inputArchivoAgregar.files.length > 0) {
    // Accede al elemento padre
    const animacionCirculo = inputArchivoAgregar.parentElement;
    animacionCirculo.style.animation = 'none';
    const animacionLogo = inputArchivoAgregar.nextElementSibling;
    animacionLogo.style.animation = 'none';
    const imgProducto = animacionCirculo.nextElementSibling;
    // Obtiene el archivo seleccionado
    const archivoSeleccionado = inputArchivoAgregar.files[0];
    // Crea una URL para el archivo
    const urlImagen = URL.createObjectURL(archivoSeleccionado);
    // Asigna la URL a la propiedad src de la imagen
    imgProducto.src = urlImagen;
    imgProducto.style.display = 'block';
    console.log('Archivo seleccionado, animación detenida');
  }
});


// agregar imagen a formulario editar
const inputArchivoEditar = document.getElementById('fileEditar');

inputArchivoEditar.addEventListener('change', () => {
  // Se ha seleccionado un archivo
  if (inputArchivoEditar.files.length > 0) {
    // Accede al elemento padre
    const imgProducto = inputArchivoEditar.parentElement.nextElementSibling;
    // Obtiene el archivo seleccionado
    const archivoSeleccionado = inputArchivoEditar.files[0];
    // Crea una URL para el archivo
    const urlImagen = URL.createObjectURL(archivoSeleccionado);
    // Asigna la URL a la propiedad src de la imagen
    imgProducto.src = urlImagen;
    imgProducto.style.display = 'block';
    console.log('Archivo seleccionado, animación detenida');
  }
});