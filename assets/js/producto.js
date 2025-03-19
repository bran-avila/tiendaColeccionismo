document.addEventListener("DOMContentLoaded", function () {
    const minusButton = document.querySelector(".number-left");
    const plusButton = document.querySelector(".number-right");
    const inputField = document.querySelector("#cantidad");

    minusButton.addEventListener("click", function () {
        let currentValue = parseInt(inputField.value, 10);
        let minValue = parseInt(inputField.min, 10);
        if (!isNaN(currentValue) && currentValue > minValue) {
            inputField.value = currentValue - 1;
        }
    });

    plusButton.addEventListener("click", function () {
        let currentValue = parseInt(inputField.value, 10);
        let maxValue = parseInt(inputField.max, 10);
        if (!isNaN(currentValue) && currentValue < maxValue) {
            inputField.value = currentValue + 1;
        }
    });
});
