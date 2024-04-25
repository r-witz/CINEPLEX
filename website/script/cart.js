const cardNumber = document.querySelector("#card-number");
const cardName = document.querySelector("#name");
const expirationDate = document.querySelector("#expiration-date");
const cvc = document.querySelector("#cvc-nb");

const number = document.querySelector(".number");
const nameElement = document.querySelector(".name");
const date = document.querySelector(".date_8264");
const code = document.querySelector(".code");

cardNumber.addEventListener("input", () => {
    var cardNumberFormat = cardNumber.value.replace(/\s/g, '').replace(/(\d{4})/g, '$1 ').trim();
    cardNumber.value = cardNumberFormat;
    number.textContent = cardNumberFormat;
});

cardName.addEventListener("input", () => {
    nameElement.textContent = cardName.value;
});

expirationDate.addEventListener("input", () => {
    var expirationDateFormat = expirationDate.value.replace(/\s/g, '').replace(/(\d{2})(\d{2})/, '$1/$2').trim();
    expirationDate.value = expirationDateFormat;
    date.textContent = expirationDateFormat;
});

cvc.addEventListener("input", () => {
    console.log(cvc.value);
    var cvcFormat = cvc.value.replace(/\d/g, '*');
    code.textContent = cvcFormat;
});