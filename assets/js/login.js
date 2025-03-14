let btn = document.querySelector("#btnCheckBox");
let cardInner =document.querySelector(".flip-card__inner");
let cardFront =document.querySelector(".flip-card__front");
let cont = 0;
btn.addEventListener("click", function (){
    if(cont == 0){
        cont++;
        cardInner.classList.add("effectRotate");
        cardFront.classList.add("effectShadow");
    }else{
        cont=0;
        cardInner.classList.remove("effectRotate");
        cardFront.classList.remove("effectShadow");
    }

});