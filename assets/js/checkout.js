
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
        alert('Pago completado por ' + details.payer.name.given_name);
        console.log(details);  // Puedes procesar los detalles del pago aquí
      });
    }
  }).render('#paypal-button-container');
}

