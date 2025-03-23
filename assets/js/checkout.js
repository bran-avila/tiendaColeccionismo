
const slidePage = document.querySelector(".slide-pagec");
const nextBtnFirst = document.querySelector(".firstNextc");
const prevBtnSec = document.querySelector(".prev-1c");
const nextBtnSec = document.querySelector(".next-1c");
const prevBtnThird = document.querySelector(".prev-2c");
const nextBtnThird = document.querySelector(".next-2c");
const prevBtnFourth = document.querySelector(".prev-3c");
const submitBtn = document.querySelector(".submitc");
const progressText = document.querySelectorAll(".stepc p");
const progressCheck = document.querySelectorAll(".stepc .checkc");
const bullet = document.querySelectorAll(".stepc .bulletc");
const form = document.getElementById("fromCheckout");
const btnPagar = document.getElementById("pagar");
const fromCheckout = document.getElementById("fromCheckout");





let current = 1;

function validarInput(input, pattern = null) {
  let validacion = false;
  if (input.value.trim() === "" || (pattern && !pattern.test(input.value))) {
      input.classList.add("is-invalid");
      input.classList.remove("is-valid");
      validacion = true;
  } else {
      input.classList.remove("is-invalid");
      input.classList.add("is-valid");
  }
  return validacion;
}



nextBtnFirst.addEventListener("click", function(event){
  event.preventDefault();
  
  const correoInput = document.getElementById("correo");
  
  if (!correoInput.checkValidity()) {
    correoInput.classList.add("is-invalid");
    correoInput.classList.remove("is-valid");
    // Evita el envío si no es válido    
  } else {
    correoInput.classList.remove("is-invalid");
    correoInput.classList.add("is-valid");
    slidePage.style.marginLeft = "-25%";
    bullet[current - 1].classList.add("activec");
    progressCheck[current - 1].classList.add("activec");
    progressText[current - 1].classList.add("activec");
    current += 1;
    }


});
nextBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  console.log("btn datos direccion");
  let numeroErrores=0;
  form.querySelectorAll("input").forEach(input => {

  const patterns = { cp: /^\d{5}$/, telefono: /^\d{10}$/ };

   if(validarInput(input, patterns[input.name] || null) ){
    numeroErrores++;
   };

  });
  
  if(numeroErrores==0){
   slidePage.style.marginLeft = "-50%";
   bullet[current - 1].classList.add("activec");
   progressCheck[current - 1].classList.add("activec");
   progressText[current - 1].classList.add("activec");
   current += 1;
  }

});

nextBtnThird.addEventListener("click", function(event){
  console.log("btn envios");
});

/*nextBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-75%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});*/
/*submitBtn.addEventListener("click", function(){
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
  setTimeout(function(){
    alert("Your Form Successfully Signed up");
    location.reload();
  },800);
});*/
prevBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "0%";
  bullet[current - 2].classList.remove("activec");
  progressCheck[current - 2].classList.remove("activec");
  progressText[current - 2].classList.remove("activec");
  current -= 1;
});
prevBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  bullet[current - 2].classList.remove("activec");
  progressCheck[current - 2].classList.remove("activec");
  progressText[current - 2].classList.remove("activec");
  current -= 1;
});
prevBtnFourth.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  bullet[current - 2].classList.remove("activec");
  progressCheck[current - 2].classList.remove("activec");
  progressText[current - 2].classList.remove("activec");
  current -= 1;
});
btnPagar.addEventListener("click", function(event){
 /* event.preventDefault();
  pagePago();*/
  event.preventDefault();
  let verificar = validarOpcion();
  if (verificar) {

    slidePage.style.marginLeft = "-75%";
    bullet[current - 1].classList.add("activec");
    progressCheck[current - 1].classList.add("activec");
    progressText[current - 1].classList.add("activec");
    current += 1;
    limpiarAvertencia();
    mandarFormulario();
  } 
});

//verificación envio

function validarOpcion() {
  const radios = document.querySelectorAll('input[name="envio"]');
  let opcionSeleccionada = false;

  radios.forEach(radio => {
    if (!radio.checked) {
      radio.classList.add("is-invalid");
      radio.classList.remove("is-valid");
      // Evita el envío si no es válido    
    } else {
      opcionSeleccionada=true;
      radio.classList.remove("is-invalid");
      radio.classList.add("is-valid");
    }
  });
  return opcionSeleccionada;
}
function limpiarAvertencia(){
  const radios = document.querySelectorAll('input[name="envio"]');
  radios.forEach(radio => { 
    radio.classList.remove("is-invalid");
      radio.classList.add("is-valid");
  });
}

function mandarFormulario(){
    const formData = new FormData(fromCheckout);
    fetch("checkout/datos", { // Ajusta la ruta según tu backend
      method: "POST",
      body: formData
  })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(data.datos);
            activarPaypal();
        } else {
            alert("Error al actualizar producto: " + data.errors);
            console.log(data);
        }
    })
    .catch(error => console.error("Error:", error));
}

//paypal
function activarPaypal(){
  document.getElementById("paypal-button-container").innerHTML = "";
  paypal.Buttons({
    createOrder: function(data, actions) {
      // Hacer la solicitud al backend para crear la orden
      return fetch('checkout/orden', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        }
      })
      .then(function(res) {
        return res.json();
      })
      .then(function(data) {
        console.log("Orden creada con ID:", data.id);
        return data.id;  // Retornar el ID de la orden
      });
    },
    onApprove: function(data, actions) {
      return actions.order.capture().then(function(details) {
            const transaction = details.purchase_units[0].payments.captures[0];
            // Datos de PayPal a enviar
            const paypalData = {
                paypal_order_id: details.id,
                paypal_transaction_id: transaction.id,
                payer_id: details.payer.payer_id,
                payer_email: details.payer.email_address,
                payer_name: `${details.payer.name.given_name} ${details.payer.name.surname}`,
                amount: transaction.amount.value,
                currency: transaction.amount.currency_code,
                status: transaction.status,
                payment_date: transaction.create_time,
                method: details.payment_source ? details.payment_source.type : "PayPal"
            };
            console.log(paypalData);
            alert("Pago completado. Procesando pedido...");
            pedidoFinalizado(paypalData); // Llamar la función enviando los datos de PayP


      });
    }
  }).render('#paypal-button-container');
}


function pedidoFinalizado(paypalData = {}){

  const formData = new FormData(fromCheckout);

  // Agregar los datos de PayPal al FormData si existen
  for (const key in paypalData) {
    formData.append(key, paypalData[key]);
    }


  fetch("checkout/pedidoCompletado", { // Ajusta la ruta según tu backend
    method: "POST",
    body: formData
})
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          console.log(data);
          window.location.href = "pedido/"+data.idPedido;

      } else {
          alert("Error a registrar pedido: " + data.errors);
          console.log(data);
      }
  })
  .catch(error => console.error("Error:", error));

}


//calculo precio de envio

const radiosEnvio = document.querySelectorAll("input[name='envio']");
const totalElement = document.getElementById("Total");
const envioElement = document.getElementById("Envio");
const subtotal = document.getElementById("Subtotal");
       
radiosEnvio.forEach(radio => {
    radio.addEventListener("change", function () {
        let costoEnvio = parseFloat(this.dataset.cantidad); // Obtiene el costo del envío
        let subtotalValor = parseFloat(subtotal.dataset.valor.replace(",", "")) || 0;// quitamos la coma si el numero tiene 1,118 porque parcefloat solo entiene 1118
        envioElement.textContent = `${costoEnvio.toFixed(2)}`; // Muestra el costo de envío
        totalElement.textContent = `${(subtotalValor+costoEnvio).toFixed(2)}`; // Actualiza el total
    });
});

/*evento de select para las direcciones*/

const direccionSelect = document.getElementById("idDireccionExistente");

        direccionSelect.addEventListener("change", function () {
            const selectedOption = direccionSelect.options[direccionSelect.selectedIndex];

            // Si selecciona la opción "Ninguna dirección", limpiar los campos
            if (selectedOption.value === "0") {
                document.getElementById("pais").value = "";
                document.getElementById("nombre").value = "";
                document.getElementById("apellidos").value = "";
                document.getElementById("calle").value = "";
                document.getElementById("colonia").value = "";
                document.getElementById("cp").value = "";
                document.getElementById("ciudad").value = "";
                document.getElementById("estado").value = "";
                document.getElementById("telefono").value = "";
                return;
            }

            // Llenar los campos con los datos seleccionados
            document.getElementById("nombre").value = selectedOption.dataset.nombre;
            document.getElementById("apellidos").value = selectedOption.dataset.apellidoP + " " + selectedOption.dataset.apellidoM;
            document.getElementById("calle").value = selectedOption.dataset.calle + " " + selectedOption.dataset.numExterior + " " + selectedOption.dataset.numInterior;
            document.getElementById("colonia").value = selectedOption.dataset.colonia;
            document.getElementById("cp").value = selectedOption.dataset.cp;
            document.getElementById("ciudad").value = selectedOption.dataset.ciudad;
            document.getElementById("estado").value = selectedOption.dataset.estado;
            document.getElementById("telefono").value = selectedOption.dataset.telefono;
            document.getElementById("pais").value = "México"; // Puedes ajustar el país si lo tienes guardado en tus datos
        });
    