document.addEventListener('DOMContentLoaded', function() {
    function updateCreditCard() {
        var cardNumber = document.getElementById('card-number').value;
        var name = document.getElementById('name').value;
        var expirationDate = document.getElementById('experiation-date').value;
        var cardNumberValue = cardNumberInput.value.replace(/\s+/g, '');
        var formattedCardNumber = formatCardNumber(cardNumberValue);
        cardNumberInput.value = formattedCardNumber;

        var cardNumberElements = document.querySelectorAll('.number');
        cardNumberElements.forEach(function(element) {
            element.textContent = cardNumber;
        });

        var nameElements = document.querySelectorAll('.name');
        nameElements.forEach(function(element) {
            element.textContent = name;
        });

        var expirationDateElements = document.querySelectorAll('.date_8264');
        expirationDateElements.forEach(function(element) {
            element.textContent = expirationDate;
        });

    }

    var formInputs = document.querySelectorAll('input');
    formInputs.forEach(function(input) {
        input.addEventListener('input', updateCreditCard);
    });

    function formatCardNumber(cardNumber) {
        var formattedNumber = cardNumber.replace(/(\d{4})/g, '$1 ');
        return formattedNumber.trim();
    }

    var cardNumberInput = document.getElementById('card-number');
    cardNumberInput.addEventListener('input', updateCreditCard);

    updateCreditCard();
});
